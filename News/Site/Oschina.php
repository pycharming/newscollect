<?php
class News_Site_Oschina extends News_Base {
public $site_title = '开源中国';
public $base_url = 'http://www.oschina.net';
public $list_url = 'http://www.oschina.net/news/list?show=';
public $list_pattern = array('news'=>'<h2><a href="(.*?)" target="_blank">(.*?)</a></h2>');
public $content_pattern = array(
//'news'=>"class=\'Body NewsContent TextContent\'>(.*?)</div>.*?<div class=\'NewsLinks\'>",
);
public $category_list = array(array('fid'=>'all','title'=>'全部资讯'), array('fid'=>'industry','title'=>'综合资讯'), array('fid'=>'project','title'=>'软件资讯'));
public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$s = file_get_contents($this->list_url . $fid . '&p=' . $page);
return $s;
}

//end class
}
