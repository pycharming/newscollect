<?php
class Qt {
    /**
     * 自动载入类
     *
     * @param $className
     */
    public static function __autoLoad($className)
    {
        @include_once str_replace(array('\\', '_'), '/', $className) . '.php';
    }

    /**
     * 程序初始化方法
     *
     * @access public
     * @return void
     */
    public static function init()
    {
        /** 设置自动载入函数 */
        if (function_exists('spl_autoload_register')) {
            spl_autoload_register(array('Qt', '__autoLoad'));
        } else {
            function __autoLoad($className) {
                Qt::__autoLoad($className);
            }
        }
    }

    /**
    * 字符串截取方法
    * @param $str 字符串（必须）
    * @param $start 起始字符串
    * @param $end 结束字符串
    * @param $flag 是否保留起始和结束字符串
    */
    public static function str_intercept($str,$start= null,$end=null,$flag=false) {
        $s = empty($start) ? $str : stristr($str,$start);
        $s = empty($s) ? $s : substr($s,strlen($start));
        $s = empty($end) ? $s : substr($s,0,stripos($s,$end));
        return $flag ? $start . $s . $end : $s;
    }

//end class
}

function xn_urlencode($s) {
	$s = base64_encode($s);
	$s = str_replace('-', '_2d', $s);
	$s = str_replace('.', '_2e', $s);
	$s = str_replace('+', '_2b', $s);
	$s = str_replace('=', '_3d', $s);
	$s = urlencode($s);
	$s = str_replace('%', '_', $s);
	return $s;
}

function xn_urldecode($s) {
	$s = str_replace('_', '%', $s);
	$s = urldecode($s);
	$s = base64_decode($s);
	return $s;
}

function humansize($num) {
	if($num > 1073741824) {
		return number_format($num / 1073741824, 2, '.', '').'G';
	} elseif($num > 1048576) {
		return number_format($num / 1048576, 2, '.', '').'M';
	} elseif($num > 1024) {
		return number_format($num / 1024, 2, '.', '').'K';
	} else {
		return $num.'B';
	}
}

function message($errcode, $errmsg, $message='') {
$arr = array('errcode'=>$errcode, 'errmsg'=>$errmsg);
if(!empty($message)) {
$arr += (array)$message;
}
header("Content-Type: application/json; charset=utf-8",true);

		echo json_encode($arr);
	exit;
}

function qt_strip_tags($s) {
$s = str_replace("p><p","p>\n<p",$s);
$s = strip_tags($s);
$s = trim($s);
$s = str_replace("&nbsp;","",$s);
$s = str_replace("&ldquo;","“",$s);
$s = str_replace("&rdquo;","”",$s);
$s = str_replace("\r","\n",$s);
$s = str_replace("\n\n","\n",$s);
$s = str_replace("\n\n","\n",$s);
$s = str_replace("\n","\r\n",$s);
return $s;
}
