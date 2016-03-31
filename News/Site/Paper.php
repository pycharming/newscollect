<?php
class News_Site_Paper extends News_Base {
public $site_title = '澎湃新闻';
public $base_url = 'http://www.thepaper.cn/';
public $list_url = 'http://www.thepaper.cn/load_index.jsp';
public $list_pattern  = array('<h2><a href="(.*?)" id="clk\d+" target="_blank">(.*?)</a></h2>'); //'<a href="(.*?)" target="_blank" id="clk\d+">(.*?)</a>');
public $title_pattern = array('<title>(.*?)_澎湃新闻-The Paper');
public $content_pattern = array('<div class="news_txt" data-size="standard">(.*?)<script>',
);
public $category_list = array();
public function __construct() {
$this->category_list = News_Site_Paper_Categories::get();
}

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$s = file_get_contents($this->list_url . '?nodeids=' . $fid . '&pageidx=' . $page);
return $s;
}

public function get_content($url) {
$data = parent::get_content($url);
$data['content'] = substr($data['content'], 0, -7);
return $data;
}


//end class
}
