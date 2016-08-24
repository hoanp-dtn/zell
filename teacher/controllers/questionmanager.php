<?php
/**
* AnhProduction
*/
class Questionmanager extends CI_Controller
{
	private $tid = null, $datateacher = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher_model');
		$auth = $this->session->userdata('authentication');
		if (isset($auth)&&!empty($auth))
		{
			$myuser = json_decode($auth,true);
			if (isset($myuser)&&!empty($myuser))
			{
				$this->tid = $myuser['id'];
				$profile = $this->teacher_model->profile($this->tid);
				$this->datateacher['teacher'] = !empty($profile)?$profile[0]:array();
			} else redirect('login','refresh');
		} else redirect('login','refresh');
	}

	function index()
	{
		$page = (isset($_GET['page']) && $_GET['page'] > 0) ?  $_GET['page']: 1;
		$data['num_row'] = $this->teacher_model->countcmt($this->tid);
		$data['page'] = $page;
		$data['question'] = $this->teacher_model->mQuestion($this->tid,$page);
		$html = $this->tlayout->header($this->datateacher);
		$html .= $this->load->view('question_manager',$data,true);
		//$html .= $this->tlayout->right();
		$html .= $this->tlayout->footer();
		$this->layout->js('publics/admin/bootstrap/js/bootstrap.min.js');
		$this->layout->title('Quản Lý Hỏi Đáp');
		$this->layout->view($html);
	}

	function reply()
	{
		if(isset($_POST)&&!empty($_POST))
		{
			$qid = (int)$this->input->post('rfor');
			$teacher_id = (int)$this->input->post('rfrom');
			$reply = $this->input->post('rvalue');
			if(!empty($qid)&&!empty($teacher_id)&&!empty($reply))
			{
				$data = array('value'=>$reply,
							  'teacher_id'=>$teacher_id,
							  'user_type'=>'1',
							  'time_create'=>time(),
							  'status'=>'1',
							  'parent_id'=>$qid);
				$res = $this->teacher_model->answer($data);
				$this->session->set_flashdata('notification',$res);
				redirect('questionmanager','refresh');
			} else 
			{
				$this->session->set_flashdata('notification',array('error'=>'Lỗi dữ liệu nhập vào!'));
				redirect('questionmanager','refresh');
			}
		} else redirect('questionmanager','refresh');
		
	}

	function changeStatus($qid='')
	{
		$res = $this->teacher_model->qStatus($qid,$this->tid);
		if ($res) $this->session->set_flashdata('notification',array('success'=>'Thay đổi trạng thái thành công!'));
		else $this->session->set_flashdata('notification',array('error'=>'Thay đổi trạng thái thất bại!'));
		redirect('questionmanager','refresh');
	}

	function del($qid='')
	{
		$res = $this->teacher_model->qDel($qid,$this->tid);
		if ($res) $this->session->set_flashdata('notification',array('success'=>'Xóa thành công!'));
		else $this->session->set_flashdata('notification',array('error'=>'Xóa thất bại!'));
		redirect('questionmanager','refresh');
	}

	function edit($qid='')
	{
		$qid = (int)$qid;
		$data['cmt'] = $this->teacher_model->getqEdit($qid,$this->tid);
		if ($data['cmt'])
		{
			if(isset($_POST)&&!empty($_POST))
			{
				$name = $this->input->post('qname');
				$email = $this->input->post('qemail');
				$question = $this->input->post('qvalue');
				if (!isset($name)||empty($name))
				{
					$error[] = "Chưa nhập tên!";
				}
				
				if (!isset($email)||empty($email))
				{
					$error[] = "Chưa nhập địa chỉ email!";
				}
				elseif(!filter_var(isset($email)?$email:null, FILTER_VALIDATE_EMAIL))
				{
					$error[] = "Email không hợp lệ";
				}

				if (!isset($question)||empty($question))
				{
					$error[] = "Chưa nhập câu hỏi!";
				}
				if (!isset($error)&&empty($error))
				{
					$data = array('name'=>$name,
								  'email'=>$email,
								  'value'=>$question);
					$result = $this->teacher_model->qupdate($qid, $data, $this->tid);
					if ($result) $data['notification'] = array('success'=>'Cập nhật thành công!');
					else $data['notification'] = array('error'=>'Cập nhật thất bại!');
				} else 
				{
					$data['listerror'] = $error;
				}
			}

			$data['cmt'] = $this->teacher_model->getqEdit($qid,$this->tid);
			$html = $this->tlayout->header($this->datateacher);
			$html .= $this->load->view('questionedit',$data,true);
			$html .= $this->tlayout->right();
			$html .= $this->tlayout->footer();
			$this->layout->title('Quản Lý Hỏi Đáp - Sửa Câu Hỏi/Trả Lời');
			$this->layout->view($html);
		} else
		{
			$this->session->set_flashdata('notification',array('error'=>'Không thể thực hiện thao tác này!'));
			redirect('questionmanager','refresh');
		}
	}
}
?>