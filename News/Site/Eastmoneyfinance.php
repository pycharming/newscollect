<?php
class News_Site_Eastmoneyfinance extends News_Base {
public $site_title = '东方财富';
public $base_url = '';
public $list_url = 'http://finance.eastmoney.com/';
public $list_pattern = array(
	'<li><span>.*?</span><a href="(.*?)" title=".*?" target="_blank">(.*?)</a></li>',
	'<p class="title"><a href="(.*?)">(.*?)</a></p>',
);
public $content_pattern = array(
//'news'=>"class=\'Body NewsContent TextContent\'>(.*?)</div>.*?<div class=\'NewsLinks\'>",
);
public $category_list = array(
array('fid'=>'news-ccjdd', 'title'=>'财经导读'),
array('fid'=>'news-ccjxw', 'title'=>'产经新闻'),
array('fid'=>'news-cssgs', 'title'=>'深度阅读'),
array('fid'=>'news-crdsm', 'title'=>'热点扫描'),
array('fid'=>'news-cywjh', 'title'=>'要闻精华'),
array('fid'=>'news-chgjj', 'title'=>'宏观经济'),
array('fid'=>'news-cjrzb', 'title'=>'金融资本'),
array('fid'=>'news-ccyjj', 'title'=>'产业经济'),
array('fid'=>'news-cssgs', 'title'=>'上市公司'),
array('fid'=>'news-cgnjj', 'title'=>'国内经济'),
array('fid'=>'news-cgjjj', 'title'=>'国际经济'),
array('fid'=>'news-czqyw', 'title'=>'证券要闻'),
array('fid'=>'news-ccjxw', 'title'=>'产经新闻'),
array('fid'=>'news-cpljh', 'title'=>'评论精华'),
array('fid'=>'news-cjjsp', 'title'=>'经济时评'),
array('fid'=>'news-ccyts', 'title'=>'产业透视'),
array('fid'=>'news-csygc', 'title'=>'商业观察'),
array('fid'=>'news-cgspl', 'title'=>'股市评论'),
array('fid'=>'news-czfgy', 'title'=>'政府官员'),
array('fid'=>'news-csyjy', 'title'=>'商界精英'),
array('fid'=>'news-cjjxr', 'title'=>'经济学人'),
array('fid'=>'news-ctzmj', 'title'=>'投资名家'),
array('fid'=>'news-csxy', 'title'=>'商学院'),
);
public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$fid = str_replace('-', '/', $fid);
$s = file_get_contents($this->list_url . $fid . '_' . $page . '.html');
$s = mb_convert_encoding($s,"UTF-8","gb2312");
return $s;
}

//end class
}
