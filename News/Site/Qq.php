<?php
class News_Site_Qq extends News_Base {
public $site_title = '腾讯新闻';
public $list_url = 'http://roll.news.qq.com/interface/roll.php?site=news&date=&mode=1&of=json';
public $referer = 'http://roll.news.qq.com/';
public $list_pattern  = array('<a target="_blank" href="(.*?)">(.*?)</a>');

public function __construct() {
$this->category_list = News_Site_Qq_NewsCategories::get();
}

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$curl = new Curl();
$curl->setReferrer($this->referer);
$curl->get($this->list_url . '&cata=' . $fid . '&page=' . $page);
$s = mb_convert_encoding($curl->response,"UTF-8","gbk");
$s = json_decode($s,true);
$s = $s['data']['article_info'];
return $s;
}

//end class
}
