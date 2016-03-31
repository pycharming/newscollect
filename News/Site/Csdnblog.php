<?php
class News_Site_Csdnblog extends News_Base {
public $site_title = 'CSDN博客';
public $list_url = "http://blog.csdn.net/";
public $list_pattern  = '<a name="\d+" href="(.*?)" target="_blank">(.*?)</a>';
public $title_pattern = array('<title>(.*?)$');
public $date_pattern = array();
public $content_pattern = array('<div id="article_content" class="article_content">(.*?)<!-- Baidu Button BEGIN -->');
public $category_list = array();

public function __construct() {
$this->category_list =  News_Site_Csdnblog_Categories::get();
}

public function get_list($fid='',$page = 1) {
$title = '';
foreach($this->category_list as $c) {
if($c['fid'] == $fid) {
$title = $c['title'];
break;
}
}
$title = empty($title) ? $this->site_title : $title . ' - ' . $this->site_title;
$fid = empty($fid) ? '' : $fid.'/';
$s = file_get_contents($this->list_url . $fid . 'newest.html?&page=' . $page);
preg_match_all('#'.$this->list_pattern.'#',$s,$list);
$arr = array();
for($i = 0;$i < count($list[1]);$i++) {
$arr[] = array('url'=>$this->base_url.$list[1][$i],'title'=>$list[2][$i]);
}
return array('title'=>$title,'list'=>$arr);
}

public function get_content($url) {
$data = parent::get_content($url);
$data['content'] = substr($data['content'], 0, -16);
return $data;
}

//end class
}
