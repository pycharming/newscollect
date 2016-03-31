<?php 
class News_Site {

public static function get_category_list($site) {
$classname = "News_Site_{$site}";
$t = new $classname();
return $t->get_category_list();
}

public static function get_list($site,$category_id,$page) {
$classname = "News_Site_{$site}";
$t = new $classname();
return $t->get_list($category_id,$page);
}
public static function get_content($site,$url) {
$classname = "News_Site_{$site}";
$t = new $classname();
return $t->get_content($url);
}
//end class
}