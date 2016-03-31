<?php
class News_Site_Segmentfault extends News_Base {
public $site_title = 'SegmentFault';
public $base_url = 'http://segmentfault.com';
public $list_url = 'http://segmentfault.com/blogs/';
public $list_pattern = array('<h2 class="title"><a href="(.*?)">(.*?)</a>');
public $title_pattern = array('<title>(.*?) - SegmentFault');
public $content_pattern = array('<div class="col-xs-12 col-md-9 main">(.*?)<div class="clearfix">');
public $category_list = array(
array('fid'=>'', 'title'=>'推荐文章'),
array('fid'=>'newest', 'title'=>'最新文章'),
array('fid'=>'hottest', 'title'=>'热门文章'),
);


public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$s = file_get_contents($this->list_url . $fid . '?page=' . $page);
return $s;
}

//end class
}
