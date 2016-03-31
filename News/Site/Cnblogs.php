<?php
class News_Site_Cnblogs extends News_Base {
public $site_title = '博客园';
public $base_url = array('news'=>'http://news.cnblogs.com/m','blog'=>'http://m.cnblogs.com');
public $list_url = array('news'=>'http://news.cnblogs.com/m?','blog'=>'http://m.cnblogs.com/mobile.aspx?list=all&');
public $list_pattern = array('news'=>'<div class="list_item">\s+<a href="/m(.*?)">(.*?)</a>','blog'=>'<div class="list_item"><a href="(.*?)">(.*?)</a>');
public $title_pattern = array('news'=>'<title>(.*?) - 博客园新闻手机版',
'blog'=>'<title>博客园手机版-(.*?)</title>');
public $date_pattern = array();
public $content_pattern = array(
'news'=>'<div>下一篇：<a href.*?</a></div>(.*?)<div id="google_ad">', //上一篇：<a href',
'blog' => '返回</a></span>(.*?)<a href=\'/mobileAddComment');
public $category_list = array(0 => array('fid'=>'news','title'=>'新闻'),1=>array('fid'=>'blog','title'=>'博文'));

public function get_list($fid='',$page = 1) {
$fid = empty($fid) ? 'news' : $fid;
$s = file_get_contents($this->list_url[$fid] . 'page=' . $page);
preg_match_all('#'.$this->list_pattern[$fid].'#',$s,$list);
$arr = array();
for($i = 0;$i < count($list[1]);$i++) {
$arr[] = array('url'=>$this->base_url[$fid].$list[1][$i],'title'=>$list[2][$i]);
}
$title = '';
foreach($this->category_list as $c) {
if($c['fid'] == $fid) {
$title = $c['title'];
break;
}
}
$title = empty($title) ? $this->site_title : $title . ' - ' . $this->site_title;
return array('title'=>$title,'list'=>$arr);
}

//end class
}
