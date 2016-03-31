<?php
class News_Site_Ifengmil extends News_Base {
public $site_title = '凤凰军事';
public $list_url = 'http://news.ifeng.com/listpage/';
public $list_pattern  = array('<li><h4>.*?</h4><a href="(.*?)".*?>(.*?)</a></li>',
'<h2><a href="(.*?)".*?>(.*?)</a></h2>'
);
public $category_list = array(
array('fid'=>'4550','title'=>'最新滚动'),
array('fid'=>'7105','title'=>'防务原创'),
array('fid'=>'7106','title'=>'臺海風雲'),
array('fid'=>'7128','title'=>'鄰邦掃描'),
array('fid'=>'7130','title'=>'環球軍情'),
array('fid'=>'7131','title'=>'防務觀察'),
array('fid'=>'51750','title'=>'防务短评'),
array('fid'=>'7104','title'=>'戰爭歷史'),
array('fid'=>'7134','title'=>'精彩图片'),
array('fid'=>'17667','title'=>'高清大图'),
array('fid'=>'19143','title'=>'军情观察室'),
);

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
if(empty($fid)) $fid = 4550;
$s = file_get_contents($this->list_url . $fid . '/' . $page .'/list.shtml');
return $s;
}

//end class
}
