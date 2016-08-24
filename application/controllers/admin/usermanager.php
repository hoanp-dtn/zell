<?php
/**
* AnhProduction
*/
class Usermanager extends CI_Controller
{
	private $myinfo;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Adminlayout');
		$this->load->helper(array('form', 'url'));
		$this->load->model('admin/usermanager_model');
		$this->permit->authentication();
		//$this->permit->getCheckPermit();
		$this->permit->checkRedirect('admin');
	}

	function index()
	{
		$page = (isset($_GET['page']) && $_GET['page'] > 0) ?  $_GET['page']: 1;
		$data['num_row'] = $this->usermanager_model->count();
		$data['maxpage'] = ceil(($data['num_row']/15));
		$data['page'] = ($page > $data['maxpage'])?$data['maxpage']:$page;
		$data['active'] = array('admin','admin/view');
		$data['usermanager'] = $this->usermanager_model->getAcc($data['page']);
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/admin/usermanager/index',$data,true);
		$html .= $this->adminlayout->loadFooter();
		//Show Layout
		$this->layout->title('Quản Lý Tài Khoản');	
		$this->layout->view($html);
	}

	function addaccount()
	{//filter_var(isset($mailto)?$mailto:null, FILTER_VALIDATE_EMAIL)
		$data = array();
		if (isset($_POST)&&!empty($_POST))
		{
			$user = $this->input->post('username');
			$email = $this->input->post('email');
			$name = getSaveSqlStr(strip_tags($this->input->post('fullname')));
			$city = getSaveSqlStr(strip_tags($this->input->post('city')));
			$address = getSaveSqlStr(strip_tags($this->input->post('address')));
			$phone = $this->input->post('phone');
			$permit = (int)$this->input->post('permit');
			$role = getSaveSqlStr(strip_tags($this->input->post('role')));
			$p = $permit;

			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$salt = substr( str_shuffle( $chars ), 0, 16 );
			$pass = md5(md5(md5('password').md5($salt)));
			//Check select permit
			if (in_array($permit, array('1', '2', '3','4')))
			{
				$p = ($permit==1)?'-1':$p;
				$p = ($permit==2)?'1':$p;
				$p = ($permit==3)?'2':$p;
				$p = ($permit==4)?'0':$p;
			} else 
			{
				$error['permit'] = 'Chưa chọn phân quyền!';
			}
			//Check mail
			if (filter_var(isset($email)?$email:null, FILTER_VALIDATE_EMAIL))
			{
				$cemail = $this->usermanager_model->checkmail($email);
				if (!$cemail)
				{
					$error['email'] = "Địa chỉ email <i>".$email."</i> đã tồn tại!";
				}
			} else $error['email'] = "Địa chỉ email <i>".$email."</i> không hợp lệ!";
			//Check user
			if (strlen($user) < 4 )
			{
				$error['user'] = "Tên Tài Khoản quá ngắn! Tối thiểu 4 kí tự";
			} else
			{
				$cuser = $this->usermanager_model->checkuser($user);
				if (!$cuser)
				{
					$error['user'] = "Tên tài khoản <i>".$user."</i> đã tồn tại!";
				}
			}
			//Check name
			if (strlen($name) < 6 )
			{
				$error['name'] = "Họ Tên quá ngắn! Tối thiểu 6 kí tự";
			}
			//Run
			if (!isset($error)&&empty($error))
			{
				$insert = array('username' => $user,
								'email' => $email,
								'password' => $pass,
								'salt' => $salt,
								'fullname' => $name,
								'time_create' => time(),
								'permit' => $p,
								'city' => $city,
								'role' => $role,
								'address' => $address,
								'phone' => $phone,
								'status'=> 1);
				$cok = $this->usermanager_model->add($insert);
				if ($cok) $data['message_success'] = "Thêm tài khoản thành công";
				else $data['message_add_error'] = "Thêm tài khoản thất bại";
				$this->session->set_flashdata('msg_success','Thêm tài khoản thành công');
				redirect('admin/usermanager');
			} else $data['message_error'] = $error;
		}
		$data['active'] = array('admin','admin/add');
		$data['brch'] = $this->usermanager_model->loadbr();
		$data['depart'] = $this->usermanager_model->loaddep();
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/admin/usermanager/add_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		//Show Layout
		$this->layout->title('Quản lí tài khoản');	
		$this->layout->view($html);
	}

	function permit()
	{
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/usermanager';
		$id = (int)$this->input->get('id');
		$stt = (int)$this->input->get('stt');
		$cok = $this->usermanager_model->checkAcc($id);
		$p = 0;
		if (in_array($stt, array('1', '2', '3','4')) && $cok )
		{
			$p = ($stt==1)?'-1':$p;
			$p = ($stt==2)?'1':$p;
			$p = ($stt==3)?'2':$p;
			$p = ($stt==4)?'0':$p;
			$this->usermanager_model->changePermit($id, $p);
			$this->session->set_flashdata('msg_success', "Thay đổi quyền thành công");
			redirect($redirect);
		} else 
		{
			$this->session->set_flashdata('msg_error', "Có lỗi xảy ra! Vui lòng kiểm tra lại");
			redirect($redirect);
		}
	}

	function status()
	{
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/usermanager';
		$id = (int)$this->input->get('id');
		$stt = (int)$this->input->get('stt');
		$cok = $this->usermanager_model->checkAcc($id);
		if (in_array($stt, array('1', '2', '3')) && $cok)
		{
			$this->usermanager_model->changeStatus($id, $stt);
			$this->session->set_flashdata('msg_success', "Thay đổi trạng thái thành công");
			redirect($redirect);
		} else 
		{
			$this->session->set_flashdata('msg_error', "Có lỗi xảy ra! Vui lòng kiểm tra lại");
			redirect($redirect);
		}
	}

	function changepass($email, $newpass)
	{
		if (!empty($email))
		{
			$salt = md5(time('Y').time('m').time('d').time('s'));
			$password = md5(md5(md5($newpass).md5($salt)));
			$this->db->where('email', $email);
			$this->db->update('utt_users', array('password' => $password, 'salt' => $salt)); 
			return true;
		} return false;
	}

	function resetpass($uid="")
	{
		//$regex = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$";
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/usermanager';
		$uid = (int)$uid;
		$cAcc = $this->usermanager_model->checkAcc($uid);
		if (!$cAcc)
		{
			$this->session->set_flashdata('msg_error', "Không thể khôi phục mật khẩu cho tài khoản này!");
			redirect($redirect);
		}
		$mailto = $this->usermanager_model->getEmail($uid);

		if (filter_var(isset($mailto)?$mailto:null, FILTER_VALIDATE_EMAIL))
		{
			$length = 12;
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			$newpass = substr( str_shuffle( $chars ), 0, $length );
			$cok = $this->usermanager_model->changepass($mailto, $newpass);

			if ($cok)
			{
				$config = array('protocol' => 'smtp',
							    'smtp_host' => 'ssl://smtp.googlemail.com',
							    'smtp_port' => 465,
							    'smtp_user' => 'uttteams@gmail.com',
							    'smtp_pass' => 'UTTTeamAHLPT',
							    'useragent' => 'UTT TEAM',
							    'mailtype'  => 'html',
							    'charset'   => 'utf-8');
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");

				$this->email->from('uttteams@gmail.com', 'UTT Team');
			    
			    $this->email->to($mailto);
			    $htmlMessage = "Mật khẩu của bạn vừa được khôi phục!\n Mật khẩu mới là <b>".$newpass."</b>";
			    $this->email->subject('Khôi phục lại mật khẩu');
			    $this->email->message($htmlMessage);



			    if ($this->email->send()) {
			        $this->session->set_flashdata('msg_success', "Khôi phục mật khẩu cho Email \"<i>".$mailto."</i>\" thành công! Mật khẩu mới là <b><samp>".$newpass."</samp></b> .");
					redirect($redirect);
			    } else {
			        //show_error($this->email->print_debugger());
			        $this->session->set_flashdata('msg_error', "Có lỗi xảy ra! Email chưa được gửi đi");
					redirect($redirect);
			    }
			} else
			{
				$this->session->set_flashdata('msg_error', "Có lỗi xảy ra! Không thể khôi phục mật khẩu.<br>Vui lòng kiểm tra lại thông tin!");
				redirect($redirect);
			}
		} else
		{
			$this->session->set_flashdata('msg_error', "Chưa có địa chỉ mail hoặc địa chỉ mail không đúng");
			redirect($redirect);
		}
	}
}
?>