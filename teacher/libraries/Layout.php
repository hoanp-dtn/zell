<?php
/**
 * CodeIgnighter layout support library
 *  with Twig like inheritance blocks
 *
 * v 1.0
 *
 *
 * @author Constantin Bosneaga
 * @email  constantin@bosneaga.com
 * @url    http://a32.me/
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {
    private $obj;
    private $layout_view;
    private $title = '';
    private $desc = '';
    private $_template_f = '';
    private $css_list = array(), $js_list = array(), $js_footer = array();
    private $block_list, $block_new, $block_replace = false;
    public $replace = array();


    function Layout() {
        $this->obj =& get_instance();
        $this->_template_f = $this->obj->config->item('template_f');
        $this->layout_view = $this->_template_f."layout/default";
        // Grab layout from called controller
        if (isset($this->obj->layout_view)) $this->layout_view = $this->obj->layout_view;
        
    }

    function view($html = null, $return = false){
        // Render template
        $data['content_for_layout'] = $html;
        $data['title_for_layout'] = $this->title;
        $data['desc_for_layout'] = $this->desc;

        // Render resources
        $data['js_for_layout'] = '';
        foreach ($this->js_list as $file){
            if (!preg_match("~^(?:f|ht)tps?://~i", $file)){
                $fileTime = filemtime($file);
                $file = base_url().$file;
                $file .= '?t='.$fileTime;
            }
            $data['js_for_layout'] .= sprintf('<script type="text/javascript" src="%s"></script>', $file)."\n";
        }

        $data['css_for_layout'] = '';
        foreach ($this->css_list as $file){
            if (!preg_match("~^(?:f|ht)tps?://~i", $file)){
                $fileTime = filemtime($file);
                $file = base_url().$file;
                $file .= '?t='.$fileTime;
            }
            $data['css_for_layout'] .= sprintf('<link rel="stylesheet" type="text/css"  href="%s" />', $file)."\n";
        }

        $data['js_for_footer'] = '';
        foreach ($this->js_footer as $file){
            if (!preg_match("~^(?:f|ht)tps?://~i", $file)){
                $fileTime = filemtime($file);
                $file = base_url().$file;
                $file .= '?t='.$fileTime;
            }
            $data['js_for_footer'] .= sprintf('<script type="text/javascript" src="%s"></script>', $file)."\n";
        }

        $data['sesionMsg'] = $this->obj->message->getAndReset();
        // Render template
        $this->block_replace = true;
        $output = $this->obj->load->view($this->layout_view, $data, true);
        foreach ($this->replace as $key => $val){
            $output = str_replace('[:'.$key.':]', $val, $output);
        }
        $output = preg_replace('/\[\:([a-z A-Z 0-9]+)\:\]/', '' ,$output);
        if($return)
            return $output;
        else
            echo $output;
    }

    /**
     * Set page title
     *
     * @param $title
     */
    function title($title) {
        $this->title = $title;
    }
    function desc($desc) {
        $this->desc = $desc;
    }
    function addReplace($key, $val){
        $this->replace[$key] = $val;
    }

    /**
     * Adds Javascript resource to current page
     * @param $item
     */
    function js($item, $inFooter = false) {
        if($inFooter)
            $this->js_footer[] = $item;
        else
            $this->js_list[] = $item;
    }

    /**
     * Adds CSS resource to current page
     * @param $item
     */
    function css($item) {
        $this->css_list[] = $item;
    }

    /**
     * Twig like template inheritance
     *
     * @param string $name
     */
    function block($name = '') {
        if ($name != '') {
            $this->block_new = $name;
            ob_start();
        } else {
            if ($this->block_replace) {
                // If block was overriden in template, replace it in layout
                if (!empty($this->block_list[$this->block_new])) {
                    ob_end_clean();
                    echo $this->block_list[$this->block_new];
                }
            } else {
                $this->block_list[$this->block_new] = ob_get_clean();
            }
        }
    }

}