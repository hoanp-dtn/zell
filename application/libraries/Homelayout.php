<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homelayout {
    private $_template_f;
    private $CI;
    public function __construct() {
        $this->CI = & get_instance();
        $this->_template_f = $this->CI->config->item('template_f');
        $this->CI->load->library('Layout');
        $this->CI->layout->css('publics/'.$this->_template_f.'front/css/bootstrap.css');
        $this->CI->layout->css('publics/'.$this->_template_f.'front/css/common.css');
        $this->CI->layout->css('publics/'.$this->_template_f.'front/css/form.css');
        $this->CI->layout->css('publics/'.$this->_template_f.'front/css/style.css');
        $this->CI->layout->css('publics/'.$this->_template_f.'front/css/menu.css');
        $this->CI->layout->css('publics/'.$this->_template_f.'front/css/jquery.mCustomScrollbar.css');
        $this->CI->layout->js('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
        $this->CI->layout->js('publics/'.$this->_template_f.'front/js/bootstrap.min.js');
        $this->CI->layout->js('http://cufon.shoqolate.com/js/cufon-yui.js');
        $this->CI->layout->js('publics/'.$this->_template_f.'front/js/UTM_Avo_400-UTM_Avo_700-UTM_Avo_italic_400-UTM_Avo_italic_700.font.js');
        $this->CI->layout->js('publics/'.$this->_template_f.'front/js/jquery.mCustomScrollbar.concat.min.js');
        $this->CI->layout->js('publics/'.$this->_template_f.'front/js/handle.js', true);
        $this->CI->layout->js('publics/'.$this->_template_f.'front/js/noty/packaged/jquery.noty.packaged.min.js');
    }

    public function loadTop($viewFile = 'common/top_view', $data = array()){
        return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
    }

    function loadRight($viewFile = 'common/right_view',  $data = array()){
        $right =  $this->CI->load->view($this->_template_f . $viewFile, $data, true);
        return $right;
    }
    function loadRightDasboard($moduleSelect=''){
        $data = array();
        $this->CI->layout->addReplace($moduleSelect, 'menu-right-active');
        $right =  $this->CI->load->view($this->_template_f . 'common/dashboard_right_view', $data, true);
        return $right;
    }

    function loadFooter($viewFile = 'common/footer_view', $data = array()){
        return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
    }

    function loadSlide($viewFile = 'common/slide_view', $data = array()){
        return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
    }
    function loadTopicPath( $data = array(), $viewFile = 'common/topic_path_view'){
        return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
    }

    function loadCenter($html = ''){
        $viewFile = 'common/center_view';
        $data['html'] = $html;
        $html =  $this->CI->load->view($this->_template_f . $viewFile, $data, true);
        return $html;

    }

}
