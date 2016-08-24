<?php

class Dashboard extends MY_Controller {
	
	
	function Dashboard() {
		parent::__construct ();
		$this->load->library('Adminlayout');
		check_login_admin();
	}
	
	function index() {
		$data = array();
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();

		$html .= $this->load->view($this->template_f . 'admin/dashboard/dashboard_view', $data, true);
		$html .= $this->adminlayout->loadFooter();

		$this->layout->title('Dashboard');		
		$this->layout->view($html);		
	}
	
}
