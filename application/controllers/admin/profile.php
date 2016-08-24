<?php
/**
* AnhProduction
*/
class Profile extends CI_Controller
{
	private $uid;
	function __construct()
	{
		parent::__construct();
		$this->load->library('Adminlayout');
		$this->load->model('profile_model');
		$this->authentication = $this->session->userdata('authentication');
		if(isset($this->authentication) && !empty($this->authentication)){
			$user = json_decode($this->authentication,TRUE);
			$count = $this->model_user->total(array(
				'email'=>$user['email'],
				'password' => $user['password'],
				'salt' => $user['salt'],
				'id' => $user['id']
			));	
			$this->uid = $user['id'];
			if($count == 0){
				redirect('admin/authentication');
			}
		}else{
			redirect('admin/authentication');
		}
	}

	function index()
	{
		$profile = $this->profile_model->profile($this->uid);
		$data['profile'] = !empty($profile)?$profile[0]:array();
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/profile/profile_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		//Show Layout
		$this->layout->title('Thông tin tài khoản');	
		$this->layout->view($html);
	}

	function changepass()
	{

		$data = array();
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		if (isset($_POST)&&!empty($_POST)) 
		{
			$old = $this->input->post('oldpass');
			$new = $this->input->post('newpass');
			$repass = $this->input->post('renewpass');
			$isok = $this->profile_model->checkoldpass($this->uid, $old);
			if (!$isok) 
			{
				$error[] = "Mật khẩu cũ không đúng";
			}
			if (!preg_match('/[!@#$%*a-zA-Z0-9]{8,}/',$new))
			{
				$error[] = "Mật khẩu mới phải lớn hơn hoặc bằng 8 ký tự và chỉ bao gồm chữ, số và một số ký tự đặc biệt !@#$%*";
			}
			if ($repass != $new) 
			{
				$error[] = "Nhập lại mật khẩu không khớp";
			}
			if (!isset($error) && empty($error))
			{
				$status = $this->profile_model->changepass($this->uid, $new);
				if ($status) $data['message_success'] = "Thay đổi mật khẩu thành công";
				else $data['message_error'] = array('error',"Thay đổi mật khẩu thất bại");
			} else $data['message_error'] = $error;

		}
		$html .= $this->load->view('backend/profile/changepass_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		//Show Layout
		$this->layout->title('Đổi mật khẩu');	
		$this->layout->view($html);
	}

	function edit()
	{
		if (isset($_POST)&&!empty($_POST))
		{
			$email = $this->input->post('email');
			$name = $this->input->post('fullname');
			$city = $this->input->post('city');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			//Check mail
			$cemail = $this->profile_model->checkmail($this->uid, $email);
			if (!$cemail)
			{
				$error['email'] = "Địa chỉ email ".$email." đã tồn tại!";
			}
			//Check name
			if (strlen($name) < 6 )
			{
				$error['name'] = "Tên quá ngắn! Tối thiểu 6 kí tự";
			}
			//Run
			if (!isset($error)&&empty($error))
			{
				$update = array('email' => $email,
								'fullname' => $name,
								'city' => $city,
								'address' => $address,
								'phone' => $phone);
				$cok = $this->profile_model->update($this->uid, $update);
				if ($cok) $data['message_success'] = "Thay đôi thông tin thành công";
				else $data['message_success'] = "Thay đôi thông tin thất bại";
			} else $data['message_error'] = $error;
		}

		$profile = $this->profile_model->profile($this->uid);
		$data['profile'] = !empty($profile)?$profile[0]:array();
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/profile/changeinfo_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		//Show Layout
		$this->layout->title('Thay đổi thông tin cá nhân');	
		$this->layout->view($html);
	}
}
?>