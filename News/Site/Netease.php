<?php
class News_Site_Netease extends News_Base {
public $site_title = '网易新闻';
public $list_url = 'http://news.163.com/special/0001220O/news_json.js';
public $category_list = array(
array('fid'=>'0','title'=>'国内'),
array('fid'=>'1','title'=>'国际'),
array('fid'=>'2','title'=>'社会'),
array('fid'=>'3','title'=>'评论'),
array('fid'=>'4','title'=>'探索'),
array('fid'=>'5','title'=>'军事'),
array('fid'=>'6','title'=>'图片'),
);

public function get_list($fid,$page) {
$s = file_get_contents('http://news.163.com/special/0001220O/news_json.js');
$s = mb_convert_encoding($s,"UTF-8","gbk");
$p = stripos($s,'{');
$s = substr($s,$p);
$p = strripos($s,';');
$s = substr($s,0,$p);
$s = json_decode($s,true);
$s = $s['news'];
$fid = intval($fid);
$list = array();
foreach($s[$fid] as $n) {
$list[] = array('url'=>$n['l'],'title'=>$n['t']);
}
$title = '';
foreach($this->category_list as $c) {
if($c['fid'] == $fid) {
$title = $c['title'];
break;
}
}
$title = empty($title) ? $this->site_title : $title . ' - ' . $this->site_title;
return array('title'=>$title,'list'=>$list);
}

//end class
}
