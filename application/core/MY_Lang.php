<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Language Identifier
 *
 * Adds a language identifier prefix to all site_url links
 *
 * @copyright     Copyright (c) 2011 Wiredesignz
 * @version         0.29
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
class MY_Lang extends CI_Lang
{
    private $index_page;
    private $lang_ignore;
    private $default_abbr;
    private $lang_uri_abbr;
    private $uri_abbr;
    private $config;
    private $uri;
    function __construct() {

        global $URI, $CFG, $IN;

        $this->config =& $CFG->config;

        $this->index_page    = $this->config['index_page'];
        $this->lang_ignore   = $this->config['lang_ignore'];
        $this->default_abbr  = $this->config['language_abbr'];
        $this->lang_uri_abbr = $this->config['lang_uri_abbr'];

        /* get the language abbreviation from uri */
        $this->uri_abbr = $URI->segment(1);


        /* adjust the uri string leading slash */
        $URI->uri_string = preg_replace("|^\/?|", '/', $URI->uri_string);
        $this->uri = $URI->uri_string;
        if ($this->lang_ignore) {

            if (isset($this->lang_uri_abbr[$this->uri_abbr])) {

                /* set the language_abbreviation cookie */
                $IN->set_cookie('user_lang', $this->uri_abbr, $this->config['sess_expiration']);

            } else {
                /* get the language_abbreviation from cookie */
                $lang_abbr = $IN->cookie($this->config['cookie_prefix'].'user_lang');

            }

            if (strlen($this->uri_abbr) == 2) {

                /* reset the uri identifier */
                $this->index_page .= empty($this->index_page) ? '' : '/';

                /* remove the invalid abbreviation */
                $URI->uri_string = preg_replace("|^\/?$this->uri_abbr\/?|", '', $URI->uri_string);

                /* redirect */
                header('Location: '.$this->config['base_url'].$this->index_page.$URI->uri_string);
                exit;
            }

        } else {

            /* set the language abbreviation */
            $lang_abbr = $this->uri_abbr;
        }

        /* check validity against config array */
        if (isset($this->lang_uri_abbr[$lang_abbr])) {

            /* reset uri segments and uri string */
            $URI->segment(array_shift($URI->segments));
            $URI->uri_string = preg_replace("|^\/?$lang_abbr|", '', $URI->uri_string);

            /* set config language values to match the user language */
            $this->config['language'] = $this->lang_uri_abbr[$lang_abbr];
            $this->config['language_abbr'] = $lang_abbr;

            /* if abbreviation is not ignored */
            if ( ! $this->lang_ignore) {

                /* check and set the uri identifier */
                $this->index_page .= empty($this->index_page) ? $lang_abbr : "/$lang_abbr";

                /* reset the index_page value */
                $this->config['index_page'] = $this->index_page;
            }

            /* set the language_abbreviation cookie */
            $IN->set_cookie('user_lang', $lang_abbr, $this->config['sess_expiration']);

        } else {

            /* if abbreviation is not ignored */
            if ( ! $this->lang_ignore) {

                /* check and set the uri identifier to the default value */
                $this->index_page .= empty($this->index_page) ? $this->default_abbr : "/$this->default_abbr";

                if (strlen($lang_abbr) == 2) {

                    /* remove invalid abbreviation */
                    $URI->uri_string = preg_replace("|^\/?$lang_abbr|", '', $URI->uri_string);
                }

                /* redirect */
                header('Location: '.$this->config['base_url'].$this->index_page.$URI->uri_string);
                exit;
            }

            /* set the language_abbreviation cookie */
            $IN->set_cookie('user_lang', $this->default_abbr, $this->config['sess_expiration']);
        }

        log_message('debug', "Language_Identifier Class Initialized");
    }

    function lang() {
        global $IN;
        $lang_abbr = $this->default_abbr;
        if ($this->lang_ignore) {
            $lang = $IN->cookie($this->config['cookie_prefix'].'user_lang');
            if($lang) {
                $lang_abbr = $lang;
            }
        } elseif(strlen($this->uri_abbr) == 2) {
            $lang_abbr = $this->uri_abbr;
        }

        return $lang_abbr;
    }


    function switch_uri($lang)
    {

        $uri = $lang . $this->uri;

        return $uri;
    }

    // add language segment to $uri (if appropriate)
    function localized($uri)
    {
        if (!$this->lang_ignore) {
            if (!empty($uri)) {
                $uri_segment = $this->get_uri_lang($uri);
                if (!$uri_segment['lang']) {

                    if ((!$this->is_special($uri_segment['parts'][0])) && (!preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri))) {
                        $uri = $this->lang() . '/' . $uri;
                    }
                }
            }
        }
        return $uri;
    }

}

/* translate helper */
function t($line) {
    global $LANG;
    return ($t = $LANG->line($line)) ? $t : $line;
}