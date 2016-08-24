<?php
/**
* AnhProduction
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher_model');
	}

	function index()
	{
		$data['listGV'] = $this->teacher_model->getTeachers();
		$html = $this->tlayout->Header();
		$html .= $this->load->view('home',$data,true);
		$html .= $this->tlayout->Footer();
		$this->layout->title('Danh sách giảng viên');
		$this->layout->view($html);

	}

	function view($user ='', $page = '')
	{
		$user = (int)$user;
		$cUser = $this->teacher_model->CheckIDGV($user);
		if ($cUser)
		{
			$page = ((int)$page>0)?(int)$page:1;
			$post_in_page = 6;
			$data['num_row'] = $this->teacher_model->CountPost($user);
			$maxpage = ceil(($data['num_row']/6));
			$page = ($page > $maxpage)?$maxpage:$page;
			$data['page'] = $page;
			$data['post'] = $this->teacher_model->getView($user, $page, $post_in_page);
			$data['post_in_page'] = $post_in_page;
			$data['user_post'] = $this->teacher_model->profile($user);
			$datateacher['teacher'] = $data['user_post'][0];
			$data['user_post'] = $data['user_post'][0];
			$html = $this->tlayout->Header($datateacher);
			$html .= $this->load->view('news/home',$data,true);
			$html .= $this->tlayout->Right();
			$html .= $this->tlayout->Footer();
			$this->layout->title('Danh Sách Bài Đăng'.(isset($datateacher['teacher']['fullname'])?' - '.$datateacher['teacher']['fullname']:null));
			$this->layout->view($html);
		}
		else 
		{
			$html = $this->tlayout->Header();
			$html .= $this->load->view('404',null,true);
			$html .= $this->tlayout->Footer();
			$this->layout->title('Không tìm thấy trang');
			$this->layout->view($html);
		}
	}

	function khoahoc($user='', $page='')
	{
		$user = (int)$user;
		$cUser = $this->teacher_model->CheckIDGV($user);
		if ($cUser)
		{
			$page = ((int)$page>0)?(int)$page:1;
			$post_in_page = 6;
			$data['num_row'] = $this->teacher_model->CountPostKH($user);
			$maxpage = ceil(($data['num_row']/6));
			$page = ($page > $maxpage)?$maxpage:$page;
			$data['page'] = $page;
			$data['post'] = $this->teacher_model->getKhoahoc($user, $page, $post_in_page);
			$data['post_in_page'] = $post_in_page;
			$data['user_post'] = $this->teacher_model->profile($user);
			$datateacher['teacher'] = $data['user_post'][0];
			$data['user_post'] = $data['user_post'][0];
			$html = $this->tlayout->Header($datateacher);
			$html .= $this->load->view('news/baocaokhoahoc',$data,true);
			$html .= $this->tlayout->Right();
			$html .= $this->tlayout->Footer();
			$this->layout->title('Báo Cáo Khoa Khọc'.(isset($datateacher['teacher']['fullname'])?' - '.$datateacher['teacher']['fullname']:null));
			$this->layout->view($html);
		}
		else 
		{
			$html = $this->tlayout->Header();
			$html .= $this->load->view('404',null,true);
			$html .= $this->tlayout->Footer();
			$this->layout->title('Không tìm thấy trang');
			$this->layout->view($html);
		}
	}

	function tailieu($user='', $page='')
	{
		$user = (int)$user;
		$cUser = $this->teacher_model->CheckIDGV($user);
		if ($cUser)
		{
			$page = ((int)$page>0)?(int)$page:1;
			$post_in_page = 6;
			$data['num_row'] = $this->teacher_model->CountPostTL($user);
			$maxpage = ceil(($data['num_row']/6));
			$page = ($page > $maxpage)?$maxpage:$page;
			$data['page'] = $page;
			$data['post'] = $this->teacher_model->getTailieu($user, $page, $post_in_page);
			$data['user_post'] = $this->teacher_model->profile($user);
			$datateacher['teacher'] = $data['user_post'][0];
			$data['user_post'] = $data['user_post'][0];
			$data['post_in_page'] = $post_in_page;
			$html = $this->tlayout->Header($datateacher);
			$html .= $this->load->view('news/tailieu',$data,true);
			$html .= $this->tlayout->Right();
			$html .= $this->tlayout->Footer();
			$this->layout->title('Tài Liệu Sinh Viên'.(isset($datateacher['teacher']['fullname'])?' - '.$datateacher['teacher']['fullname']:null));
			$this->layout->view($html);
		}
		else 
		{
			$html = $this->tlayout->Header();
			$html .= $this->load->view('404',null,true);
			$html .= $this->tlayout->Footer();
			$this->layout->title('Không tìm thấy trang');
			$this->layout->view($html);
		}
	}
}
?>