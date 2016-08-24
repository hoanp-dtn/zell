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

function getCurrentUrl() {
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
function printText($text){
    return htmlspecialchars_decode(stripslashes(myNl2br(($text))));
}
function cutnchar($str=NULL,$n=0) {
		if(strlen($str)<$n) return $str;
		$html = substr($str,0,$n);
		$html = substr($html,0,strrpos($html,' '));
		return $html.'...';
	}

	function trimgach($str)
	{
    	while (strpos($str,"--") != false)
    	{
        	$str = str_replace("--","-",$str);
    	}
		$str=str_replace("'","",$str);
		$str=str_replace("\"","",$str);
		$str=str_replace(",","",$str);
		$str = htmlentities($str);
	    return $str;
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
    function rwlink($str)
    {
    	$str = removeVietChars($str);
    	$str = trimgach($str);
    	$str = strtolower($str);
    	//$str = preg_replace('/[^a-z0-9/-]/','',$str);
    	return $str;
    }

    function vi2en($str)
    {
        $coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ","ê","ù","à");
        $khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
        ,"a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o"
        ,"o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A"
        ,"A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O"
        ,"O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","e","u","a");
        return str_replace($coDau,$khongDau,$str);
    }

function displayQuestion($value,$name=''){
                echo '<li id="pid'.$value['id'].'" name="pid'.$value['id'].'" >
                        <div class="commenterImage">
                            <img style="width:32px; height:32px;" src="'.(($value['user_type']==1)?(imgExist(base_url().'uploads/images/avatar/'.$value['avatar'])):imgExist('')).'">
                        </div>
                        <div class="commentText">
                            <cite class="user blog-author">
                                    '.(($value['user_type']==1)?('<strong><a href="teacher.php/'.rwlink(isset($value['tname'])?$value['tname']:null).'-gv'.$value['teacher_id'].'.html">'.$value['tname'].'</strong></a>'):('<strong><a style="cursor: pointer;" name="'.$value['id'].'">'.$value['name'].'</strong>(<i>'.$value['email'].'</i>)</a>')).'
                                </cite>';
                                if ($value['parent_id']!=0)
                                {
                                    echo '<span> trả lời <a href="'.curPageURL().'#pid'.$value['parent_id'].'" style="cursor: pointer;"><i>'.$name.'</i></a></span>';
                                }
                            echo '
                            <p class="message">'.$value['value'].'</p>
                            <span class="datetime secondary-text">
                                <span class="date sub-text">'.date('H:i:s d/m/Y',$value['time_create']).'</span>&nbsp;&nbsp;
                                <a class="sub-text reply" reply-name="'.((isset($value['tname'])&&!empty($value['tname'])&&($value['user_type']==1))?($value['tname']):$value['name']).'" reply-for="'.$value['id'].'" href="javascript:;"><i class="fa fa-comments"></i> Trả lời</a>
                            </span>
                        </div>';
                        if (isset($value['questionreply'])&&!empty($value['questionreply']))
                        {
                            echo '<ul class="commentList">';
                            foreach ($value['questionreply'] as $key => $val) {
                                displayQuestion($val,((isset($value['tname'])&&!empty($value['tname'])&&($value['user_type']==1))?($value['tname']):$value['name']));
                             }
                            echo '</ul>';
                        }
                echo '</li>';
            }
            
?>
