<?php
$starttime = microtime(1);
/** 设置包含路径 */
@set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . PATH_SEPARATOR . __DIR__ . DIRECTORY_SEPARATOR . "lib");

/** 载入API支持 */
require_once 'Qt.php';

Qt::init();
