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
