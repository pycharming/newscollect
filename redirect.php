<?php
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
define('APP_NAME', 'qtnews');
include 'config.inc.php';
$url = isset($_GET['url']) ? $_GET['url'] : '';
empty($url) and exit;
header("Location: " .  xn_urldecode($url));
exit;
