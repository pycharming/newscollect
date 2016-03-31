<?php
defined('APP_NAME') or exit('access denied');

$sites = glob('News/Site/*.php');

$sl= array();
foreach($sites as $site) {
$site = substr(basename($site),0,-4);
$cate = News_Site::get_category_list($site);
$sl[] = array('sid'=>$site, 'site_title'=>$cate['site_title'], 'category_list'=>$cate['category_list']);
}
$format == 'json' and message(0,'',array('sitelist'=>$sl));
$pagetitle = '新闻 - qt news';
include 'view/index.htm';
