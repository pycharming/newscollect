<?php
class News_Site_Ifenghistory extends News_Base {
public $site_title = '凤凰历史';
public $list_url = 'http://news.ifeng.com/listpage/';
public $list_pattern  = array('<li><h4>.*?</h4><a href="(.*?)".*?>(.*?)</a></li>',
'<h2><a href="(.*?)".*?>(.*?)</a></h2>',
'<h3>.*?<a href="(.*?)\n.*?".*?>(.*?)</a>.*?</h3>',
);
public $category_list = array(
array('fid'=>'41708','title'=>'观世变'),
array('fid'=>'41708','title'=>'名家名言'),
array('fid'=>'41708','title'=>'历史热词'),
array('fid'=>'4772','title'=>'轶闻秘档'),
array('fid'=>'4771','title'=>'视频'),
array('fid'=>'4731','title'=>'考古'),
array('fid'=>'4770','title'=>'历史上的今天'),
array('fid'=>'4768','title'=>'专家论史'),
array('fid'=>'4769','title'=>'民间说史'),
array('fid'=>'4762','title'=>'中国现代史'),
array('fid'=>'4763','title'=>'中国近代史'),
array('fid'=>'4764','title'=>'中国古代史'),
array('fid'=>'4765','title'=>'世界史'),
array('fid'=>'4766','title'=>'史学苑'),
);

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
if(empty($fid)) $fid = 4770;
$s = file_get_contents($this->list_url . $fid . '/' . $page .'/list.shtml');
return $s;
}

//end class
}
