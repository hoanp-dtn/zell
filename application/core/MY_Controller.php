<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $template_f;
    public $template;
    public $site = array();
    public $siteName = 'utt';

	function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->template_f = $this->config->item('template_f');
        $this->template   = $this->config->item('template_default');
        $this->load->model('model_site');
        $isLangCookie = $this->config->item('lang_ignore');

        if(!$isLangCookie) {
            $siteName = $this->uri_array(2);
        } else {
            $siteName = $this->uri_array(1);
        }

        if($siteName) {
            $dataSite = $this->model_site->isSite($siteName);
            if(is_array($dataSite)) {
                $this->siteName = $siteName;
                $this->site = $dataSite;
            }
        }
        if(empty($this->site)) {
            $dataSite = $this->model_site->isSite($this->siteName);
            $this->site = $dataSite;
        }
    }

    function uri_array($i){
        $aryUri = explode('/', $this->uri->uri_string());
        return (isset($aryUri[$i])) ? $aryUri[$i] : false;
    }

    /**
     * @param $data
     */
    function setInformationSite (&$data) {
        $dataSite = $this->site;
        $data['title_for_layout'] = 'Trường đại học Công nghệ giao thông vận tải';
        $data['desc_for_layout'] = 'Trường Đại học Công nghệ Giao thông vận tải - Số 54 Triều Khúc, Thanh Xuân, Hà Nội - Điện thoại: 043 854 4264 - Website: http://utt.edu.vn';
        $data['keyword_for_layout'] = 'đại học công nghệ gtvt, tuyển sinh đại học, đhcngtvt, đh công nghệ gtvt, tuyển sinh 2015, tuyển sinh liên thông, tư vấn tuyển sinh, đh công nghệ gtvt';
        $data['lstCsdt'] = $this->model_site->getDepartSiteByType('csdt');

        if(!empty($dataSite)) {
            $data['title_for_layout'] = isset($this->site['title']) ? $this->site['title'] : '';
            $data['desc_for_layout'] = isset($this->site['desc']) ? $this->site['desc'] : '';
            $data['keyword_for_layout'] = isset($this->site['keyword']) ? $this->site['keyword'] : '';
			$data['logo_for_site'] = isset($this->site['logo']) ? $this->site['logo'] : '';
			//$data['name_for_header'] = isset($this->site[''])
        }
    }
    /**
     * @param $view
     * @param array $params
     * @param bool $return
     */
    public function render($view, $params = array(), $return = false) {
        $aryTemplate = $this->model_site->getTemplateBySite($this->siteName);
        if(is_array($aryTemplate)) {
            $this->template = 'template/' . $aryTemplate['name'] . '/';
        }
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