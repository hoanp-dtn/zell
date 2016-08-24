<?php
/**
* AnhProduction
*/
class Question extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher_model');
	}

	function index($id='')
	{
		$id = (int)$id;
		$cid = $this->teacher_model->CheckIDGV($id);
		if ($cid)
		{
			$data = array();
			$teacher = $this->teacher_model->profile($id);
			$questiondata = $this->teacher_model->getQuestion($id,'0','1','6');
			$data['questionanswer'] = $this->teacher_model->getListQuestion($questiondata);
			$datateacher['teacher'] = !empty($teacher)?$teacher[0]:array();
			$html = $this->tlayout->header($datateacher);
			$html .= $this->load->view('question_view',$data,true);
			$html .= $this->tlayout->right();
			$html .= $this->tlayout->footer();
			$this->layout->css(base_url().'publics/teacher/css/toastr.min.css');
			$this->layout->js(base_url().'publics/teacher/js/toastr.min.js');
			$this->layout->js(base_url().'publics/teacher/js/jquery.blockUI.js');
			$this->layout->title('Hỏi Đáp'.(isset($datateacher['teacher']['fullname'])?' - '.$datateacher['teacher']['fullname']:null));
			$this->layout->view($html);
		} else redirect('home','refresh');
	}

	function loadmore($uid='')
	{
		$uid = (int)$uid;
		$page = (int)$this->input->post('page');
		$page = ((int)$page <=1)?1:$page;
		$num = $this->teacher_model->numQuestion($uid);
		$maxpage = ceil(($num/6));
		$page = ($page > $maxpage)?$maxpage:$page;
		$questiondata = $this->teacher_model->getQuestion($uid,'0',$page,'6');
		$questionanswer = $this->teacher_model->getListQuestion($questiondata);
		if(!empty($questionanswer)){
			foreach($questionanswer as $key => $val){
				displayQuestion($val);
			}
		}
		echo "<script>$('.sub-text.reply').click(function(event) {
	  	var rid = $(this).attr('reply-for');
	  	var rname = $(this).attr('reply-name');
	  	$('#reply-for').val(rid);
	  	$('#qvalue').html('@'+rname+': ');
	  	$('#qvalue').focus();
	  	$('body').scrollTo('#qvalue');
	  	});</script>";

	}
	
	function changeStatus($qid='')
	{
		$auth = $this->session->userdata('auth_teacher');
		if (isset($auth)&&!empty($auth))
		{
			$myuser = json_decode($auth,true);
			if (isset($myuser)&&!empty($myuser)) {
				$res = $this->teacher_model->qStatus($qid);
				if ($res) $this->session->set_flashdata('notification',array('success'=>'Thay đổi trạng thái thành công!'));
				else $this->session->set_flashdata('notification',array('error'=>'Thay đổi trạng thái thất bại!'));
				redirect('question/manager','refresh');
			}
			else redirect('login','refresh');
		} else redirect('login','refresh');
	}

	function send($id='')
	{
		$teacher = (int)$id;
		$cid = $this->teacher_model->CheckIDGV($id);
		if ($cid)
		{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$question = $this->input->post('question');
			$captcha = $this->input->post('captcha');
			$parent_id = (int)$this->input->post('reply');
			$captchasave = $this->session->userdata('captcha_code_teacher');
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
			if (isset($captcha)&&!empty($captcha))
			{
				if ($captcha<>$captchasave) $error[] = "Captcha chưa đúng!";
			} else $error[] = "Chưa nhập captcha!";
			if (!isset($error)&&empty($error))
			{
				$time = time();
				$data = array('name'=>$name,
							  'email'=>$email,
							  'value'=>$question,
							  'time_create'=>$time,
							  'parent_id'=>$parent_id,
							  'teacher_id'=>$teacher);
				$result = $this->teacher_model->question($data);
				echo json_encode($result, JSON_PRETTY_PRINT);
			} else 
			{
				$result = array('error'=>$error);
				echo json_encode($result, JSON_PRETTY_PRINT);
			}
		} else echo "Lỗi! Giảng viên này không tồn tại";
	}

	function captcha()
	{
	 $md5_hash = md5(rand(0,999));
	 $security_code = substr($md5_hash, 15, 5);
	 $_SESSION["security_code"] = $security_code;
	 $this->session->set_userdata('captcha_code_teacher', $security_code);
	 $width = 60;
	 $height = 30;
	 $image = ImageCreate($width, $height);
	 $fontcolor = ImageColorAllocate($image, 255, 255, 255);
	 $bgcolor = ImageColorAllocate($image, 0, 0, 0);
	 ImageFill($image, 0, 0, $bgcolor);
	 ImageString($image, 5, 8, 6, $security_code, $fontcolor);
	 for($i=0;$i<20;$i++) imageline ($image , rand(0,80), rand(0,80), rand(0,80), rand(0,80), ImageColorAllocate($image, rand(0,255), rand(0,255), rand(0,255)));
	 header("Content-Type: image/jpeg");
	 ImageJpeg($image);
	 ImageDestroy($image);
	}
}
?>