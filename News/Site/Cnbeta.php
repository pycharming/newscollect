<?php
class News_Site_Cnbeta extends News_Base {
public $site_title = 'cnbeta';
public $base_url = "http://m.cnbeta.com";
public $list_url = "http://m.cnbeta.com/wap/index.htm";
public $list_pattern  = array('<div class="list"><a href="(.*?)">(.*?)</a></div>');
public $title_pattern = array('<title>(.*?)_移动版\(WAP\)_');
public $content_pattern = array('</b></div>(.*?)<a href="/wap/hotcomments.htm');


public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$s = file_get_contents($this->list_url . '?page=' . $page);
return $s;
}
public function get_content($url) {
$data = parent::get_content($url);
$data['content'] = str_replace("    ", "", $data['content']);
return $data;
}

//end class
}
