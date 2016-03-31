<?php
class News_Site_Leiphone extends News_Base {
public $site_title = '雷锋网';
public $list_url = 'http://www.leiphone.com/';
public $list_pattern  = array('<div class="word">.*?<a href="(.*?)".*?>.*?<div class="tit">(.*?)</div>.*?</a>');
public $category_list = array(
array('fid'=>'all','title'=>'全部资讯'),
array('fid'=>'zixun','title'=>'新鲜'),
array('fid'=>'naodong','title'=>'脑洞'),
array('fid'=>'texie','title'=>'特写'),
array('fid'=>'weiwu','title'=>'唯物'),
array('fid'=>'chuangye','title'=>'创业'),
array('fid'=>'qiku','title'=>'奇酷'),
array('fid'=>'sponsor" class="','title'=>'发现'),
);
public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
if(empty($fid)) $fid = 'all';
$fid = $fid == 'all' ? 'page/' : 'category/' . $fid . '/page/';
$s = file_get_contents($this->list_url . $fid . $page);
return $s;
}

//end class
}
