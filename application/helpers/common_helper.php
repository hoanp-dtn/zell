<?php

function curPageURL() {
    $pageURL = 'http';

    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function isFullLink($link) {
    return filter_var($link, FILTER_VALIDATE_URL);
}

function debug($value, $label = null) {
    $label = get_tracelog(debug_backtrace(), $label);
    echo getdebug($value, $label);
    exit();
}

function getdebug($value, $label = null) {
    $value = htmlentities(print_r($value, true));
    return "<pre>$label$value</pre>";
}

function get_tracelog($trace, $label = null) {
    $line = $trace[0]['line'];
    $file = is_set($trace[1]['file']);
    $func = $trace[1]['function'];
    $class = is_set($trace[1]['class']);
    $log = "<span style='color:#FF3300'>-- $file - line:$line - $class-$func()</span><br/>";
    if ($label)
        $log .= "<span style='color:#FF99CC'>$label</span> ";
    return $log;
}

function is_set(&$var, $substitute = null) {
    return isset($var) ? $var : $substitute;
}

function getSaveSqlStr($str) {
    if (get_magic_quotes_gpc()) {
        return $str;
    } else {
        $CI = &get_instance();
        return mysqli_real_escape_string($CI->db->conn_id, $str);
    }
}

function getCurrentUrl(){
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    $pageURL .= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
    return $pageURL;
}

function isUrl($url) {
    return (preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) ? true : false;
}



function getDomainFromUrl($strUrl) {
    $strUrl = trim($strUrl);
    if (trim($strUrl) == '')
        return '';
    $parse = parse_url($strUrl);
    $rel = '';
    if (isset($parse['host'])) {
        $host = mb_strtolower($parse['host']);
        $pos = strpos($host, 'www.');
        if ($pos !== false) {
            $rel = substr($host, $pos + 4);
        } else {
            $rel = $host;
        }
    }
    return $rel;
}

function validEmail($email) {
    if (preg_match("/[a-zA-Z0-9-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0)
        return true;
    else
        return false;
}
function validPhone($phone){
    if(preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phone)) {
        return true;
    }
    return false;
}

function validUsername($str) {
    return preg_match('/^[a-z0-9_]+$/', $str);
}

function show_custom_error($mess = '') {
    $CI = & get_instance();
    if (class_exists('CI_DB') AND isset($CI->db)) {
        $CI->db->close();
    }
    $label = get_tracelog(debug_backtrace(), '');
    $mess .= '===='.$label;
    if ( ENVIRONMENT == 'development') {
        show_error($mess);
    } else {
        log_message('error', $mess);
        show_error('');
    }
}

function arr_column($arr, $key){
    $newArr = array();
    foreach($arr as $item){
        if(isset($item[$key]) && $item[$key] != ''){
            $newArr[$item[$key]] = $item;
        }
    }
    return $newArr;
}

function remove_non_numerics($str)
{
    $temp       = trim($str);
    $result  = "";
    $result     = str_replace(',','',$str);

    return $result;
}

function number_format_unlimited_precision($number,$decimal = '.')
{
    if($number == 0 || !$number) return $number;
    $broken_number = explode($decimal,$number);
    return number_format($broken_number[0]).$decimal.$broken_number[1];
}
function myNl2br($Text){
    $Result = str_replace( '\r\n', '<br />', $Text );
    return $Result;
}

function imgExist($url='',$isNexist ='')     
{
    if (!isset($isNexist)||empty($isNexist)) $isNexist ='data:image/jpeg;base64,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';
    if (@getimagesize($url)) return $url;
    else return $isNexist;
}

function truncate($string,$length=100,$append="...") {
    $string = trim($string);

    if(strlen($string) > $length) {
        $string = wordwrap($string, $length);
        $string = explode("\n", $string, 2);
        $string = $string[0] . $append;
    }

    return $string;
}

function printText($text){
    return htmlspecialchars_decode(stripslashes(myNl2br(($text))));
}
if(!function_exists('cutnchar')) {
		function cutnchar($str=NULL,$n=0) {
			if(strlen($str)<$n) return $str;
			$html = substr($str,0,$n);
			$html = substr($html,0,strrpos($html,' '));
			return $html.'...';
		}
	}

	function chuanhoa($string){
        $string = trim($string);
        while(strpos($string,"  ")!=false){
            $string=str_replace("  "," ",$string);
        }
		$string=str_replace("'","&apos;",$string);
		$string = htmlentities($string);
        return $string;
    }
	function slug($str=''){
		$str=removeVietChars($str);
		$str=strtolower($str);
		$str= preg_replace('/[^a-z0-9 ]+/i','',$str);
		$str=chuanhoa($str);
		$str= preg_replace('/ /','-',$str);
		return $str;
	}
?>
