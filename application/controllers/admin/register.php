<?php

class Register extends MY_Controller {
	
	function __construct() {
		parent:: __construct();
		$this->load->library('Adminlayout');
		$this->load->model('admin/model_user');
		$this->load->library('form_validation');
		$this->load->model('Model_site');
	}
	
	public function index(){
		if(isset($_POST)&&!empty($_POST)){
			$config = array(
				array(
					'field'   => 'username', 
					'label'   => 'Tên tài khoản', 
					'rules'   => 'required|max_length[50]|min_length[8]'
                 ),
				array(
                    'field'   => 'password', 
                    'label'   => 'Password', 
                    'rules'   => 'required|max_length[50]|min_length[8]'
                ),
				array(
                    'field'   => 'passconf', 
                    'label'   => 'Password Confirmation', 
                    'rules'   => 'trim|required|callback_checkPassConfirm'
                ),   
				array(
                    'field'   => 'email', 
                    'label'   => 'Email', 
                    'rules'   => 'required|valid_email|callback__checkAccount'
                ),
				array(
					'field'=>'fullname',
					'label'=>'Họ tên',
					'rules'=>'required|min_length[8]'
				),
				array(
					'field'=>'telephone',
					'label'=>'Số điện thoại',
					'rules'=>'required|min_length[10]|is_natural'
				),
            );

			$this->form_validation->set_rules($config);
			$this->form_validation->set_rules('permit','quyền truy cập','trim|callback_checkSelected');
			$this->form_validation->set_rules('utt_site','trang công tác','trim|callback_checkSelected');
			if($this->form_validation->run()){
				$this->model_user->register();
				$this->session->set_flashdata('message_flashdata',array('type'=>'successful','message'=>'Thêm thành công'));
				redirect('admin/home');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$data['dropdown_site'] = $this->Model_site->dropdown();
		$html = $this->load->view($this->template_f . 'backend/register/register', isset($data)?$data:'', true);

		$this->layout->title('Thêm quản trị viên');		
		$this->layout->view($html);		
	}
	
	public function checkPassConfirm($str)
	{
		$password = $this->input->post('password');
		if ($str != $password)
		{
			$this->form_validation->set_message('checkPassConfirm', 'Xác nhận mật khẩu không đúng');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function checkSelected($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('checkSelected', 'Bạn phải chọn %s.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function _checkAccount($email){
		if(isset($email)||count($email)){
			$count = $this->model_user->getcount(array('email'=>$email));
			if($count>=1){
				$this->form_validation->set_message('_checkAccount','%s đã tồn tại');
				return false;
			}
		}
		return true;
	}
}
