<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $template_f;
    public $template;
    public $site = array();

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->template_f = $this->config->item('template_f');
        $this->template   = $this->config->item('template_default');
        $this->load->model('model_site');
        $isLangCookie = $this->config->item('lang_ignore');
    }

    function uri_array($i){
        $aryUri = explode('/', $this->uri->uri_string());
        return (isset($aryUri[$i])) ? $aryUri[$i] : false;
    }

    /**
     * @param $data
     */
    function setInformationSite (&$data) {
        $data['title_for_layout'] = 'Trường đại học Công nghệ giao thông vận tải';
        $data['desc_for_layout'] = 'Trường Đại học Công nghệ Giao thông vận tải - Số 54 Triều Khúc, Thanh Xuân, Hà Nội - Điện thoại: 043 854 4264 - Website: http://utt.edu.vn';
        $data['keyword_for_layout'] = 'đại học công nghệ gtvt, tuyển sinh đại học, đhcngtvt, đh công nghệ gtvt, tuyển sinh 2015, tuyển sinh liên thông, tư vấn tuyển sinh, đh công nghệ gtvt';

        $data['title_for_layout'] = '';
        $data['desc_for_layout'] = '';
        $data['keyword_for_layout'] = '';
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