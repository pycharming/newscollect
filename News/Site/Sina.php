<?php
class News_Site_Sina extends News_Base {
public $site_title = '新浪新闻';
public $list_url = 'http://roll.news.sina.com.cn/interface/rollnews_ch_out_interface.php?spec=&type=&ch=01&k=&offset_page=0&offset_num=0&num=60&asc=&';
public $list_pattern = ',title : "(.*?)",url : "(.*?)"';
public $category_list = array(
array('fid'=> 89, 'title'=> '全部'),
array('fid'=> 90, 'title'=> '国内'),
array('fid'=> 91, 'title'=> '国际'),
array('fid'=> 92, 'title'=> '社会'),
array('fid'=> 93, 'title'=> '军事'),
array('fid'=> 94, 'title'=> '体育'),
array('fid'=> 95, 'title'=> '娱乐'),
array('fid'=> 96, 'title'=> '科技'),
array('fid'=> 97, 'title'=> '财经'),
array('fid'=> 98, 'title'=> '股市'),
array('fid'=> 99, 'title'=> '美股'),
);

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
if(empty($fid)) $fid = 89;
$curl = new Curl();
$curl->get($this->list_url . '&col=' . $fid . '&page=' . $page);
$s = mb_convert_encoding($curl->response,"UTF-8","gb2312");
return $s;
}
public function _get_list($source,$pattern) {
preg_match_all('#'.$this->list_pattern.'#',$source,$list);
$arr = array();
for($i = 0;$i < count($list[1]);$i++) {
$arr[] = array('url'=>$this->base_url.$list[2][$i],'title'=>$list[1][$i]);
}
return $arr;
}

//end class
}
