<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function lang($line, $id = '')
{
    $CI =& get_instance();
    $line = $CI->lang->line($line);
    $args = func_get_args();
    if(is_array($args)) array_shift($args);

    if(is_array($args) && count($args))
    {
        foreach($args as $arg)
        {
            $line = str_replace_first('%s', $arg, $line);
        }
    }

    if ($id != '')
    {
        $line = '<label for="'.$id.'">'.$line."</label>";
    }

    return $line;
}

function str_replace_first($search_for, $replace_with, $in)
{
    $pos = strpos($in, $search_for);
    if($pos === false)
    {
        return $in;
    }
    else
    {
        return substr($in, 0, $pos) . $replace_with . substr($in, $pos + strlen($search_for), strlen($in));
    }
}
function lang_url($uri = '')
{
    global $CFG;
    if (!$CFG->item('lang_ignore')) {
        if ($uri != '') {
            $uri = '/' . $uri;
        }
        $lang = get_lang_code();
        $CI =& get_instance();
        return $CI->config->base_url() . $lang . $uri;
    } else {
        return $uri;
    }
}

function get_lang_code() {
    global $CFG, $URI, $IN;
    $language = $CFG->item('language_abbr');
    if ($CFG->item('lang_ignore'))
    {
        $language = $IN->cookie($CFG->item('cookie_prefix').'user_lang');
    } elseif(strlen($URI->segment(1)) == 2) {
        $language = $URI->segment(1);
    }
    return $language;
}