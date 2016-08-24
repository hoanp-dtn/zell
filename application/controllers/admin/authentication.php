<?php

class Authentication extends MY_Controller {
	
	function __construct() {
		parent:: __construct();
		$this->load->library('Adminlayout');
		$this->load->model('admin/model_user');
		$this->load->model('admin/site_model');
		$this->load->library('form_validation');
	}
	
	public function index(){
		$authentication = $this->session->userdata('authentication');
		if(isset($authentication) && !empty($authentication)){
			$user = json_decode($authentication,TRUE);
			$count = $this->model_user->total(array(
				'email'=>$user['email'],
				'password' => $user['password'],
				'salt' => $user['salt'],
				'id' => $user['id']
			));
			if($count == 0){
				redirect('admin/authentication');
			}else{
				redirect('admin/home');
			}
		}
		if(isset($_POST)&&!empty($_POST)){
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('password','Password','trim|required|callback__validData');
			if($this->form_validation->run()){
				$email = trim($this->input->post('email'));
				$user = $this->model_user->get('*',array('email'=>$email));
				$this->session->set_userdata('authentication',json_encode($user));
				$this->session->set_flashdata('message_flashdata',array('type'=>'successful','message'=>'Đăng nhập thành công'));
				redirect('admin/home');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$html = $this->load->view($this->template_f . 'backend/login/login_view', isset($data)?$data:'', true);

		$this->layout->title('Đăng nhập vào hệ thống');		
		$this->layout->view($html);		
	}
	public function _validData($password='',$email=''){
		$email = $this->input->post('email');
		$count = $this->model_user->total(array('email'=>$email,'permit !='=>0));
		if($count==0){
			$this->form_validation->set_message('_validData','Tài khoản không tồn tại');
			return false;
		}
		$user= $this->model_user->get('id,email,password,salt,permit',array('email'=>$email));
		$password_encode = md5(md5(md5($password).md5($user['salt'])));
		if($user['password']!=$password_encode) {
			$this->form_validation->set_message('_validData','Mật khẩu không đúng');
			return false;
		}
		if ($user['permit'] ==2){
			$yoursite = $this->site_model->getByID($user['id']);
			if(is_array($yoursite) && count($yoursite) == 0){
				$this->form_validation->set_message('_validData','Bạn không đủ quyền để đăng nhập vào quản trị site');
				return false;
			}
		}
		return true;
    }
	public function logout(){
		$this->session->unset_userdata('authentication');
		$this->session->unset_userdata('site_select');
		$this->session->unset_userdata('userinfo');
		redirect( admin_link('authentication'), 'refresh');
	}
	
}
