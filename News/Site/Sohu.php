<?php
class News_Site_Sohu extends News_Base {
public $site_title = '搜狐新闻';
public $list_url = "http://roll.sohu.com/";
public $list_pattern  = array('em><a href="(.*?)" target="_blank">(.*?)</a><span');

public function __construct() {
$this->category_list = News_Site_Sohu_Categories::get();
}

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$fid = empty($fid) ? '' : $fid . '/';
$page = intval($page);
$curl = new Curl();
if($page > 1) {
$curl->get($this->list_url . $fid);
$s = mb_convert_encoding($curl->response,"UTF-8","gb2312");
preg_match('#index_(\d+)\.shtml\'>下一页</a>#',$s,$p);
$rp = isset($p[1]) ? $p[1] + 2 : 0;
$page = $rp > $page ? $rp - $page : $page;
}
$page = $page <= 1 ? '' : '_'.$page;
$url = $this->list_url . $fid . 'index' . $page . '.shtml';
$curl->get($url);
$s = $curl->response;
$s = mb_convert_encoding($s,"UTF-8","gb2312");
return $s;
}

//end class
}
