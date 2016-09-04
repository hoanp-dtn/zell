<?php

class Partner extends MY_Controller {
	
	
	function __construct() {
		parent::__construct ();
		$this->load->library('Adminlayout');
		$this->load->library('form_validation');
		$this->load->helper(array('form','My_string','url'));
		$this->load->model('admin/model_user');
		$this->load->model('admin/Model_partner');
		$this->permit->authentication();
		$this->load->model('admin/permit_model');
	}
	
	
	public function del($id = 0){
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/partner/view';
		$flag=$this->Model_partner->del($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect($redirect);
	}
	
	public function view($page=1){
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/partner/view');
		$config['total_rows'] = $this->Model_partner->total(array());
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1; 
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['list_partner'] = $this->Model_partner->view(($page*$config['per_page']),$config['per_page'],array());
		}
		$data['active'] = array('partner','partner/view');
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/partner/partner_view',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí đối tác');
		$this->layout->view($html);	
	}
	
	public function add(){
		if(isset($_POST)&& !empty($_POST)){
			$this->form_validation->set_rules('name','Tên đối tác ','trim|required');
			$this->form_validation->set_rules('link','Trang chủ đối tác ','trim|required');
			$this->form_validation->set_rules('phonenumber','Số điện thoại','trim|required|is_natural');
			$this->form_validation->set_rules('email','Email','trim|required');
			if($this->form_validation->run()){
				$flag = $this->Model_partner->add();
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/partner/view');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$data['active'] = array('partner','partner/add');
		$data['base']= $this->config->item('base_url');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/partner/partner_add',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí đối tác');
		$this->layout->js('publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->view($html);
	}
	
	public function edit($id=0){
		$partner = $this->Model_partner->total(array('id'=>(int)$id));
		if(!isset($partner) || $partner ==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Đối tác này không tồn tại'));
			redirect('admin/partner/view');
		}
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/partner/view';
		if(isset($_POST)&& !empty($_POST)){
			$this->form_validation->set_rules('name','Tên đối tác ','trim|required');
			$this->form_validation->set_rules('link','Trang chủ đối tác ','trim|required');
			$this->form_validation->set_rules('phonenumber','Số điện thoại','trim|required|is_natural');
			$this->form_validation->set_rules('email','Email','trim|required');
			if($this->form_validation->run()){
				$flag = $this->Model_partner->edit($id);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect($redirect);
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$tmp = $this->Model_partner->view(NULL,NULL,array('utt_post.id' => $id));
		$data['list_partner'] = $tmp[$id];
		$data['base']= $this->config->item('base_url');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/partner/partner_edit',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí đối tác');
		$this->layout->js('publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->view($html);
	}
}
