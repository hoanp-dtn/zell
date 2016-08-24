<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $template_f;
    public $template;
	function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->template_f = $this->config->item('template_f');
        $this->template   = $this->config->item('template_default');
        // $this->load->model('model_site');
    }

    /**
     * @param $view
     * @param array $params
     * @param bool $return
     */
    // public function render($view, $params = array(), $return = false) {
        // $siteName = $this->uri->segment(1);
        // if($siteName) {
            // $aryTemplate = $this->model_site->getTemplateBySite($siteName);
            // if(is_array($aryTemplate)) {
                // $this->template = 'template/' . $aryTemplate['name'] . '/';
            // }
        // }
        // $this->config->set_item('path_js', $this->template);
        // $this->config->set_item('path_css', $this->template);
        // $this->config->set_item('path_img', $this->template);
        // $this->config->set_item('path_base_url', $this->template);
        // if($return)
            // return $this->load->view($this->template . $view, $params, $return);
        // $this->load->view($this->template . $view, $params, $return);
    // }

}