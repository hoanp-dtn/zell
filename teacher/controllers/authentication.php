<?php
/**
* AnhProduction
*/
class Authentication extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher_model');
	}

	function login()
	{

		$auth = $this->session->userdata('authentication');
		if (isset($auth)&&!empty($auth))
		{
			$myuser = json_decode($auth);
			if (isset($myuser)&&!empty($myuser)) {
				redirect('profile','refresh');
			}
		} 

		$data = array();
		if (isset($_POST['slogin'])&&!empty($_POST['slogin']))
		{
			$user = strip_tags($this->input->post('user'));
			$pass = strip_tags($this->input->post('pwd'));
			$ok = $this->teacher_model->login($user,$pass);
			if ($ok)
			{
				unset($ok['about']);
				$this->session->set_userdata('authentication',json_encode($ok));
				$this->session->set_flashdata('message_flashdata',array('type'=>'successful','message'=>'Đăng nhập thành công'));
				redirect('profile','refresh');
			}
			else {
					$this->session->set_flashdata('message_error_login','Đăng nhập thất bại<br>Sai tên đăng nhập hoặc mật khẩu!');
					redirect('login','refresh');
				}
		}
		$html = $this->load->view('layout/login');
		$this->layout->view($html);
	}

	function logout()
	{
		$this->session->unset_userdata('authentication');
		redirect('login','refresh');
	}
}

?>