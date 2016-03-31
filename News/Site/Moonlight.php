<?php
class News_Site_Moonlight extends News_Base {
public $site_title = '月光博客';
public $list_url = 'http://www.williamlong.info/';
public $list_pattern = array('<h2 class="post-title"><a href="(.*?)" rel="bookmark">(.*?)</a></h2>');
public $title_pattern = array('<title>(.*?)-月光博客');
public $content_pattern = array('<div id="artibody">(.*?)<p style="display:none;" class="cloudreamHelperLink" codetype="post"');

public function get_source($fid="",$page=1,$type="fso",$charset="utf-8") {
$s = file_get_contents($this->list_url);

return $s;
}


//end class
}
