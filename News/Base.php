<?php 
class News_Base {
public $site_title = '';
public $base_url = '';
public $list_pattern = array();
public $title_pattern = array();
public $date_pattern = array();
public $content_pattern = array();
public $category_list = array();

public function __construct() {
}

public function get_category_list() {
return array('site_title'=> $this->site_title,'category_list'=>$this->category_list);
}

public function get_list($fid,$page) {
$s = $this->get_source($fid,$page);
$title = '';
foreach($this->category_list as $c) {
if($c['fid'] == $fid) {
$title = $c['title'];
break;
}
}
$title = empty($title) ? $this->site_title : $title . ' - ' . $this->site_title;
$list = $this->_get_list($s,$this->list_pattern);
$data = array('title'=>$title,'list'=>$list);
return $data;
}

public function get_content($url) {
//global $starttime;
//echo substr(microtime(1) - $starttime, 0, 5), '<br />';
$curl = new Curl();
$s = $curl->get($url);
//$s = file_get_contents($url);
//echo substr(microtime(1) - $starttime, 0, 5), '<br />';
$content = $this->get_data($s,$this->content_pattern);;
$title = $this->get_data($s,$this->title_pattern);
$date = $this->get_data($s,$this->date_pattern);
$data = array();
$data['title'] = $title;
$data['date'] = $date;
$data['content'] = $content;
$data['original_url'] = $url;
if(empty($content)) {
$rdata = $this->readability($s);
if($rdata) {
$data['content'] = $rdata['content'];
$data['title'] = $rdata['title'];
}
}
//echo substr(microtime(1) - $starttime, 0, 5), '<br />';
return $data;
}

public function _get_list($source,$patterns) {
$list = array();
foreach($patterns as $pattern) {
preg_match_all('#'.$pattern.'#is',$source,$l);
if(empty($l)) continue;
$cnt = count($l[1]);
for($i = 0;$i < $cnt;$i++) {
$list[] = array('url'=>substr($l[1][$i],0,4) == 'http' ? $l[1][$i] : $this->base_url.$l[1][$i],'title'=>$l[2][$i]);
}
if(!empty($list)) break;
}
return $list;
}

public function get_data($source,$patterns) {
$data = "";
foreach($patterns as $pattern) {
preg_match('#'.$pattern.'#ism',$source,$d);
isset($d[1]) && $data = $d[1];
if(!empty($data)) break;
}
return $data;
}

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$url = $this->list_url . $fid . "&page=" . $page;
$s = file_get_contents($url);
return $s;
}

public function readability($s) {
preg_match("/charset=\"?([\w|\-]+)[;\"]?/", $s, $match);
$charset = isset($match[1]) ? $match[1] : 'utf-8';
$ra = new Readability($s,$charset);
$data = $ra->getcontent();
return $data;
}

//end class
}