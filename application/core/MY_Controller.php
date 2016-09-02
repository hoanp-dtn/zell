<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $template_f;
    public $template;
    public $language;
    public $site = array();

    function __construct() {
        parent::__construct();
        $this->load->helper(array('language', 'cookie'));
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->template_f = $this->config->item('template_f');
        $this->template   = $this->config->item('template_default');
        $this->load->model('model_site');
        $this->language = get_cookie('language') ? get_cookie('language') : $this->config->item('language');
        $this->language = 'english';
    }

    function uri_array($i){
        $aryUri = explode('/', $this->uri->uri_string());
        return (isset($aryUri[$i])) ? $aryUri[$i] : false;
    }

    /**
     * @param $data
     */
    function setInformationSite (&$data) {

        $data['title_for_layout'] = 'Zell-V | Nhau thai cừu - Đẹp mãi tuổi 25';
        $data['desc_for_layout'] = 'Zell-V là sản phẩm tốt nhất mà tôi đã từng sử dụng. Do da của tôi khô, có nhiều mụn và có vảy.';
        $data['keyword_for_layout'] = 'Zell-V, nhau thai cừu';
        $data['logo_for_site'] = '';
    }
    /**
     * @param $view
     * @param array $params
     * @param bool $return
     */
    public function render($view, $params = array(), $return = false) {
        $this->template =  $this->template . '/';
        $this->config->set_item('path_js', $this->template);
        $this->config->set_item('path_css', $this->template);
        $this->config->set_item('path_img', $this->template);
        $this->config->set_item('path_base_url', $this->template);
        
        $output = $this->load->view($this->template . $view, $params, true);
        $output = str_replace('http://localhost/utt/', site_url(), $output);
        if($return) return $output;
        else echo $output;
    }

}