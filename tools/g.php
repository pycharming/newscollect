<?php
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
$s = file_get_contents('http://news.ifeng.com/history/');
preg_match_all('#<a href="http://news.ifeng.com/listpage/(\d+)/1/list\.shtml".*?>(.*?)</a>#is',$s,$rs);
//echo count($rs[1]);
$cnt = count($rs[1]);
$c = 'public $category_list = array('."\n";
for($i = 0;$i < $cnt;$i++) {
if($rs[2][$i] == '更多') continue;
$c.= "array('fid'=>'".$rs[1][$i]."','title'=".$rs[2][$i]."'),\n";
//echo $rs[1][$i],',',$rs[2][$i],'<br />';
}
$c.=");\n";
echo $c;
