<?php
class News_Site_Jiemian extends News_Base {
public $site_title = '界面新闻';
public $list_url = 'http://a.jiemian.com/index.php?m=lists&a=ajaxlist&callback=jQuery11020270376792446776263&cid='; //"http://www.jiemian.com/index.php?m=lists&a=ajaxlist&cid=";
public $list_pattern  = array('<h3>.*?<a href="(.*?)" target="_blank" title="(.*?)">\2</a></h3>');

public $title_pattern = array('<div class="article-header"><h1>(.*?)</h1>');


public function __construct() {
$this->category_list = News_Site_Jiemian_Categories::get();
}

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
if(empty($fid)) $fid = 32;
$s = file_get_contents($this->list_url . $fid . '&page=' . $page);
$p = stripos($s,'{');
$s = substr($s,$p);
$p = strripos($s,')');
$s = substr($s,0,$p);
$s = json_decode($s,true);
$s = $s['rst'];
return $s;
}

//end class
}
