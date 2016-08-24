<?php
/**
* AnhProduction
*/
class Profile extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('teacher_model');
	}

	function index()
	{
		$auth = $this->session->userdata('authentication');
		if (isset($auth)&&!empty($auth))
		{
			$myuser = json_decode($auth,true);
			if (isset($myuser)&&!empty($myuser)) {
				$data['profile'] = $this->teacher_model->profile($myuser['id']);
				$data['profile'] = !empty($data['profile'])?$data['profile'][0]:array();
				$datateacher['teacher'] = $data['profile'];
				$html = $this->tlayout->header($datateacher);
				$html .= $this->load->view('profile',$data,true);
				//$html .= $this->tlayout->right();
				$html .= $this->tlayout->footer();
				$this->layout->title(isset($myuser)?'Thông tin giảng viên - '.$myuser['fullname']:'Thông tin giảng viên');
				$this->layout->view($html);
			}
			else
			{
				$html = $this->tlayout->Header();
				$html .= $this->load->view('404',null,true);
				$html .= $this->tlayout->Footer();
				$this->layout->title('404 - Page Not Found');
				$this->layout->view($html);
			}
		} else
		{
			$html = $this->tlayout->Header();
			$html .= $this->load->view('404',null,true);
			$html .= $this->tlayout->Footer();
			$this->layout->title('404 - Page Not Found');
			$this->layout->view($html);
		}
	}

	function giangvien($id="")
	{
		$id = (int)$id;
		$data['profile'] = $this->teacher_model->profile($id);
		if (!empty($data['profile'])) 
		{
			$data['profile'] = !empty($data['profile'])?$data['profile'][0]:array();
			$datateacher['teacher'] = $data['profile'];
			$html = $this->tlayout->header($datateacher);
			$html .= $this->load->view('profile',$data,true);
			//$html .= $this->tlayout->right();
			$html .= $this->tlayout->footer();
			$this->layout->title(isset($data['profile'])?'Thông tin giảng viên - '.$data['profile']['fullname']:'Thông tin giảng viên');
			$this->layout->view($html);
		}
		else 
		{
			redirect('home','refresh');
		}
	}

	function edit()
	{
		$auth = $this->session->userdata('authentication');
		if (isset($auth)&&!empty($auth))
		{
			$myuser = json_decode($auth,true);
			if (!isset($myuser)||empty($myuser))
			{
				redirect('login','refresh');
			}
		} else
		{
			redirect('login','refresh');
		}
		//Thay đổi
		if (isset($_POST['sedit'])&&!empty($_POST['sedit']))
		{
			$name = getSaveSqlStr(strip_tags($this->input->post('fullname')));
			$city = getSaveSqlStr(strip_tags($this->input->post('city')));
			$address = getSaveSqlStr(strip_tags($this->input->post('address')));
			$phone = getSaveSqlStr(strip_tags($this->input->post('phone')));
			$about = ($this->input->post('about'));

			$avatarup = $this->upload('avatar');
		    $avatar = ($avatarup['success'])?$avatarup['upload_data']['file_name']:($this->teacher_model->getAvatar($myuser['id']));
		    if ($avatarup['success'])
		    {
		    	if (file_exists('./uploads/images/avatar/'.($this->teacher_model->getAvatar($myuser['id'])))) unlink('./uploads/images/avatar/'.($this->teacher_model->getAvatar($myuser['id'])));
		    }
			//Check mail
			// if (filter_var(isset($email)?$email:null, FILTER_VALIDATE_EMAIL))
			// {
			// 	$cemail = $this->profile_model->checkmail($this->uid, $email);
			// 	if (!$cemail)
			// 	{
			// 		$error['email'] = "Địa chỉ email ".$email." đã tồn tại!";
			// 	}
			// } else $error['email'] = "Địa chỉ email không đúng!";
			//Check name
			if (strlen($name) < 6 )
			{
				$error['name'] = "Tên quá ngắn! Tối thiểu 6 kí tự";
			}
			//Run
			if (!isset($error)&&empty($error))
			{
				$update = array('fullname' => $name,
								'avatar' => $avatar,
								'city' => $city,
								'address' => $address,
								'phone' => $phone,
								'about' => $about);
				$cok = $this->teacher_model->update($myuser['id'], $update);
				if ($cok) $data['message_success'] = "Thay đôi thông tin thành công";
				else $data['message_success'] = "Thay đôi thông tin thất bại";
			} else $data['message_error'] = $error;
		}

		$profile = $this->teacher_model->profile($myuser['id']);
		$data['profile'] = !empty($profile)?$profile[0]:array();
		$datateacher['teacher'] = $data['profile'];
		$html = $this->tlayout->header($datateacher);
		$html .= $this->load->view('profile_edit',$data,true);
		$html .= $this->tlayout->footer();
		$this->layout->js(base_url().'publics/admin/plugins/ckeditor/ckeditor.js',true);
		//Show Layout
		$this->layout->title('Thay đổi thông tin cá nhân');	
		$this->layout->view($html);
	}

	function upload($name){
		$this->load->library('upload');
	    $config = array(
	        'upload_path' =>'uploads/images/avatar',
	        'allowed_types' => "gif|jpg|png|jpeg",
	        'overwrite' => TRUE,
	        'max_size' => "1024000",
	        'encrypt_name' => true,
	    );
	    $new_name = time().$_FILES[$name]['name'];
	    $config['file_name'] = $new_name;
	    $data = array();
	    $data['success'] = false;
	    $this->upload->initialize($config);
	    if($this->upload->do_upload($name))
	    {
	        $dataUpload = $this->upload->data();
	        $data['upload_data'] = $dataUpload;
	        //$data['urlImg'] = $dataUpload['file_name'];
	        $data['success'] = true;
	    }
	    else
	    {
	        $data['error'] = array('error' => $this->upload->display_errors());
	    }
	    @unlink($_FILES['tmp_name']);
	    //die(json_encode($data));
	    return $data;
    }
}
?>