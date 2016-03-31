<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
header("Expires: 0");
header("Cache-Control: No-cache");
header("Cache-Control: No-store");
header("Pragma: no-cache");
header("Access-Control-Allow-Origin: *");
define('APP_NAME', 'qtnews');
include 'config.inc.php';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';
$format = isset($_GET['format']) ? $_GET['format'] : "html";
$site = isset($_GET['sid']) ? $_GET['sid'] : '';
$fid = isset($_GET['fid']) ? $_GET['fid'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$url = isset($_GET['url']) ? $_GET['url'] : '';
$strip = isset($_GET['strip']) ? $_GET['strip'] : '';
$site = ucfirst(strtolower($site));
$fid = empty($fid) ? ($site == "Paper" ? 25428 : "") : $fid;
switch($action) {
case 'index':
$sites = glob('News/Site/*.php');
$sl= array();
foreach($sites as $site) {
$site = substr(basename($site),0,-4);
$cate = News_Site::get_category_list($site);
$sl[] = array('sid'=>$site, 'site_title'=>$cate['site_title'], 'category_list'=>$cate['category_list']);
}
$format == 'json' and message(0,'',array('sitelist'=>$sl));
$pagetitle = '新闻';
include 'view/index.htm';
break;
case 'category':
$sl= array();
$cate = News_Site::get_category_list($site);
$sl[] = array('sid'=>$site, 'site_title'=>$cate['site_title'], 'category_list'=>$cate['category_list']);
$format == 'json' and message(0,'',array('sitelist'=>$sl));
$pagetitle = $cate['site_title'] . ' - 新闻';
include 'view/index.htm';
break;
case 'read':
if(!empty($url)) {
$data = News_Site::get_content($site,xn_urldecode($url));
!empty($strip) && $data['content'] = qt_strip_tags($data['content']);
$format == "json" && message(0,'',$data);
if(empty($data['content'])) exit(header("Location: {$data['original_url']}"));
$pagetitle = strip_tags($data['title']) . ' - 新闻';
include 'view/content.htm';
exit;
}
break;
case 'list':
$list = News_Site::get_list($site,$fid,$page);
$prev_page = $page -1;
$next_page = $page +1;
foreach($list['list'] as &$l) {
$l['url'] = xn_urlencode($l['url']);
}
$format == "json" && message(0,'',$list);
$pagetitle = $list['title'] . ' - 新闻';
include 'view/list.htm';
break;
case 'redirect':
empty($url) and exit;
header("Location: " .  xn_urldecode($url));
exit;
break;
default:
echo 'aaa';
break;
}
