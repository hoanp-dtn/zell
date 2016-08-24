<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tlayout {

	private $_template_f, $checklog;
	private $CI,$userinfo,$yoursite, $site_selected;

	public function __construct() {
		$this->CI = & get_instance();
		$this->_template_f = $this->CI->config->item('template_f');
		$base_url = $this->CI->config->item('base_url_template');
		$this->CI->load->library('Layout');
		$this->CI->layout->css($base_url.'publics/admin/bootstrap/css/bootstrap.min.css');
		$this->CI->layout->css($base_url.'publics/teacher/css/style.css');
		
		$this->CI->layout->js($base_url.'publics/admin/plugins/jQuery/jQuery-2.1.3.min.js');
		// $this->CI->layout->js($base_url.'publics/teacher/js/sahifa.js');
		// $this->CI->layout->js($base_url.'publics/teacher/js/sahifa2.js');

	    $ss = $this->CI->session->userdata('authentication');
	    if (isset($ss)&&!empty($ss))
	    {
	    	$userdata = json_decode($ss);
	    	if(isset($userdata)&&!empty($userdata))
	    	{
	    		$this->checklog = $userdata;
	    	} else $this->checklog = false;
	    } else $this->checklog = false;
	}

	public function Header($data = array(), $viewFile = 'layout/Header'){
		$data['checklog'] = isset($this->checklog)?($this->checklog):null;
		return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
	}

	// function loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data = array()){
	// 	$menu =  $this->CI->load->view($this->_template_f . $viewFile, $data, true);
	// 	$menu = str_replace('class_'.$current, 'active', $menu);
	// 	return $menu;
	// }
	function Right($data = array(), $viewFile = 'layout/Right')
	{
		return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
	}

	function Footer($data = array(), $viewFile = 'layout/Footer'){
		return $this->CI->load->view($this->_template_f . $viewFile, $data, true);
	}

}
