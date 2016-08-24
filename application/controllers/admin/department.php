<?php

class Department extends MY_Controller {
	private $site_id,$lang_code;
	
	function __construct() {
		parent::__construct ();
		$this->site_id = $this->session->userdata('site_select');
		$this->lang_code = $this->session->userdata('lang_select');
		$this->load->config('config_data');
		$this->load->library('Adminlayout');
		$this->load->library('form_validation');
		$this->load->model('admin/Model_lang');
		$this->load->helper(array('form','My_string','url'));
		$this->load->model('admin/model_user');
		$this->load->model('admin/model_department');
		$this->permit->authentication();
		$site_select = (int)$this->input->post('site_select');
		$lang_select = $this->input->post('lang_select');
			if(isset($site_select) && $site_select !=0 && isset($lang_select) && !empty($lang_select)){
				$this->session->set_userdata('site_select',$site_select);
				$this->session->set_userdata('lang_select',$lang_select);
				redirect(curPageURL());
			}
		$this->permit->checkRedirect('admin');
	}
	
	public function del($id = 0){
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/department/view';
		$flag=$this->model_department->del($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect($redirect);
	}
	
	public function view($page=1){
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/department/view');
		$config['total_rows'] = $this->model_department->total();
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1; 
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['list_department'] = $this->model_department->view(($page*$config['per_page']),$config['per_page']);
		}
		$data['departTypeLst'] = $this->config->item('departLstType');
		$data['active'] = array('department','department/view');
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/department/view',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí phòng ban');
		$this->layout->view($html);	
	}
	
	public function add(){
		if(isset($_POST)&& !empty($_POST)){
			$this->form_validation->set_rules('name_vn','Tên tiếng việt','trim|required|callback__checkName');
			$this->form_validation->set_rules('name_en','Tên tiếng anh','trim|required|callback__checkName');
			if($this->form_validation->run()){
				$flag = $this->model_department->add();
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/department/view');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$data['departTypeLst'] = $this->config->item('departLstType');
		$data['active'] = array('department','department/add');
		$data['base']= $this->config->item('base_url');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/department/add',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí phòng ban');
		$this->layout->js('publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->view($html);
	}
	
	public function _checkName($value = '')
	{
		$data = $this->model_department->checkName(NULL);
		foreach($data as $key => $val)
		{
			if(in_array($value,$val)) {
			$this->form_validation->set_message('_checkName','Đã tồn tại tên phòng ban này.');
			return FALSE;
			break;
			}
		}
		return true;
	}
	
	public function _checkNameEdit($value = '', $id)
	{
		$data = $this->model_department->checkName($id);
		foreach($data as $key => $val)
		{
			if(in_array($value,$val)) {
			$this->form_validation->set_message('_checkName','Đã tồn tại tên phòng ban này.');
			return FALSE;
			break;
			}
		}
		return true;
	}
	
	public function edit($id=0){
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/department/view';
		if(isset($_POST)&& !empty($_POST)){
			$this->form_validation->set_rules('name_vn','Tên tiếng việt','trim|required|callback__checkNameEdit['.$id.']');
			$this->form_validation->set_rules('name_en','Tên tiếng anh','trim|required|callback__checkNameEdit['.$id.']');
			if($this->form_validation->run()){
				$flag = $this->model_department->edit($id);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect($redirect);
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$data['departTypeLst'] = $this->config->item('departLstType');
		$data['list_department'] = $this->model_department->get($id);
		$data['base']= $this->config->item('base_url');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/department/edit',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí phòng ban');
		$this->layout->js('publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->view($html);
	}
}
