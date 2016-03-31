<?php
class News_Site_Ifeng extends News_Base {
public $site_title = '凤凰资讯';
public $list_url = 'http://news.ifeng.com/listpage/';
public $list_pattern  = array('<li><h4>.*?</h4><a href="(.*?)".*?>(.*?)</a></li>',
'<h2><a href="(.*?)".*?>(.*?)</a></h2>'
);
public $category_list = array(
array('fid'=>'11502','title'=>'综合'),
array('fid'=>'11528', 'title'=>'大陆'),
array('fid'=>'11574','title'=>'国际'),
array('fid'=>'11490','title'=>'台湾'),
array('fid'=>'7609','title'=>'港澳'),
);

public function __construct() {
$this->category_list = array_merge($this->category_list,News_Site_Ifeng_Categories::get());
}

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
if(empty($fid)) $fid = 11502;
$s = file_get_contents($this->list_url . $fid . '/' . $page .'/list.shtml');
return $s;
}

//end class
}
