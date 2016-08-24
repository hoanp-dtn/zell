<?php
/**
* AnhProduction
*/

class Post extends CI_Controller
{
	private $datalogged = null;
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('teacher_model');
		$this->load->library('image_CRUD');
		$this->load->helper('form');
		$auth = $this->session->userdata('authentication');
		

		if (isset($auth)&&!empty($auth))
		{
			$myuser = json_decode($auth,true);
			if (isset($myuser)&&!empty($myuser))
			{
				$this->datalogged = $myuser;
			}
		}
	}

	function index()
	{
		redirect('','refresh');
	}
	function detail($id = '',$t='',$c='')
	{
		$id = (int)$id;
		$tid = (int)$t;
		$cate_id = (int)$c;
		$cID = $this->teacher_model->CheckPostID($id,$tid,$cate_id);
		if ($cID)
		{
			$data = $this->teacher_model->getDetail($id);
			$data['list_comment'] = $this->teacher_model->getListComment($id);
			if (!empty($data))
			{
				$teacher = $this->teacher_model->profile($data['user_id']);
				$datateacher['teacher'] = !empty($teacher)?$teacher[0]:array();
				$data['post_next'] = $this->teacher_model->getNextID($id,isset($datateacher['teacher'])?($datateacher['teacher']['id']):null);
				$data['post_prev'] = $this->teacher_model->getPrevID($id,isset($datateacher['teacher'])?($datateacher['teacher']['id']):null);
			} 
			$html = $this->tlayout->Header($datateacher);
			$html .= $this->load->view('news/detail',$data,true);
			$html .= $this->tlayout->Right();
			$html .= $this->tlayout->Footer();
			//$this->layout->js(base_url().'publics/template/default/js/comment.js');
			$this->layout->title(isset($data['title'])?$data['title']:null);
			$this->layout->view($html);
		} else 
		{
			$html = $this->tlayout->Header();
			$html .= $this->load->view('404',null,true);
			$html .= $this->tlayout->Footer();
			$this->layout->title('404 Not Found - Không Tìm Thấy Trang');
			$this->layout->view($html);
		}

	}
	
	function add(){
		$data = null;
		if(!isset($this->uri->rsegments[3])){
			$current_file = unserialize(base64_decode($this->input->post('current_file')));
			if (!(strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest')) {
				$this->teacher_model->delete_files($current_file);
			}
		}
		
		if (empty($this->datalogged['id'])) redirect('login','refresh');
		if(isset($_POST) && !empty($_POST)){
			$title = getSaveSqlStr(strip_tags($this->input->post('title')));
			$description = getSaveSqlStr(strip_tags($this->input->post('description')));
			$detail = (htmlspecialchars($this->input->post('detail')));
			$status = (int)$this->input->post('status');
			$cate = (int)$this->input->post('cate');
			if($cate > 2 || $cate <1){
				$error[] = "Danh mục tin không hợp lệ.";
			}
			if(trim($title) == ""){
				$error[] = "Chưa nhập tiêu đề bài viết.";
			}
			if(trim($description) == ""){
				$error[] = "Chưa nhập mô tả bài viết.";
			}
			if(trim($detail) == ""){
				$error[] = "Chưa nhập nội dung bài viết.";
			}
			
			if($status > 2 || $status <1){
				$error[] = "Trạng thái hiển thị không hợp lệ.";
			}

			if(!isset($error)&&empty($error)){
				$flag = $this->teacher_model->add($this->datalogged['id'],$current_file);
				$data['message_success'] = $flag;
			} else $data['message_error'] = $error;
		}
		
		
		
		$image_crud = new image_CRUD();
		$image_crud->set_url_field('value');
		$image_crud->set_primary_key_field('id');
		$image_crud->set_type_feild('key');
		$image_crud->set_status_feild('post_id');
		$image_crud->set_status_value(0);
		$image_crud->set_library_view_file('list_file.php');
		$image_crud->set_photo_where(array('post_id'=>0,'key'=>'file_teacher'));
		$image_crud->set_type_feild_value('file_teacher');
		$image_crud->set_table('utt_postmeta')
		->set_image_path('uploads/files');
			
		$output = $image_crud->render();
		$data['output'] = $output->output;
		$data['js_files'] = $output->js_files;
		$data['css_files'] = $output->css_files;
		
		
		
		$teacher = $this->teacher_model->profile($this->datalogged['id']);
		$datateacher['teacher'] = !empty($teacher)?$teacher[0]:array();
		$html = $this->tlayout->Header($datateacher);
		$html .= $this->load->view('news/add_view',$data,true);
		$html .= $this->tlayout->Right();
		$html .= $this->tlayout->Footer();
		$this->layout->js(base_url().'publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->title('Thêm Bài Viết Mới');
		$this->layout->view($html);
	}

	function edit($id='')
	{
		if (empty($this->datalogged['id'])) redirect('login','refresh');
		$cID = $this->teacher_model->CheckPostID($id, $this->datalogged['id'], '', '2');
		
		$image_crud = new image_CRUD();
		$image_crud->set_url_field('value');
		$image_crud->set_primary_key_field('id');
		$image_crud->set_type_feild('key');
		$image_crud->set_type_feild_value('file_teacher');
		$image_crud->set_relation_field('post_id');
		$image_crud->set_library_view_file('list_file.php');
		$image_crud->set_table('utt_postmeta')
		->set_image_path('uploads/files');
			
		$output = $image_crud->render();
		$data['output'] = $output->output;
		$data['js_files'] = $output->js_files;
		$data['css_files'] = $output->css_files;
		
		
		if ($cID)
		{
			$data['post'] = $this->teacher_model->getDetail($id);
			if(isset($_POST) && !empty($_POST)){
				$imageup = $this->upload('image_file');
				$imageold = $this->teacher_model->getImage($id);
				$image = ($imageup['success'])?$imageup['upload_data']['file_name']:($imageold);
			    if ($imageup['success'])
			    {
			    	if (file_exists('./uploads/images/avatar/'.$imageold)) unlink('./uploads/images/avatar/'.$imageold);
			    }
				$title = getSaveSqlStr(strip_tags($this->input->post('title')));
				$description = getSaveSqlStr(strip_tags($this->input->post('description')));
				$detail = (htmlspecialchars($this->input->post('detail')));
				$status = (int)$this->input->post('status');
				$cate = (int)$this->input->post('cate');
				if($cate > 2 || $cate <1){
					$error[] = "Danh mục tin không hợp lệ.";
				}
				if(trim($title) == ""){
					$error[] = "Chưa nhập tiêu đề bài viết.";
				}
				if(trim($description) == ""){
					$error[] = "Chưa nhập mô tả bài viết.";
				}
				if(trim($detail) == ""){
					$error[] = "Chưa nhập nội dung bài viết.";
				}
				
				if($status > 2 || $status <1){
					$error[] = "Trạng thái hiển thị không hợp lệ.";
				}

				$cate_id = ($cate == 1)?'998':'999';
				$update = array('status'=> $status,
								'cate_id' => $cate_id,
								'title' => $title,
								'description' => $description,
								'detail'=>$detail,
								'image' => $image);
				if(!isset($error)&&empty($error)){
					$flag = $this->teacher_model->edit($id, $update);
					$data['message_success'] = $flag;
				} else 
				{
					$data['message_error'] = $error;
					$data['post'] = $update;
				}
			}
			
		
			$teacher = $this->teacher_model->profile($this->datalogged['id']);
			$datateacher['teacher'] = !empty($teacher)?$teacher[0]:array();
			$html = $this->tlayout->Header($datateacher);
			$html .= $this->load->view('news/edit_view',$data,true);
			$html .= $this->tlayout->Right();
			$html .= $this->tlayout->Footer();
			$this->layout->js(base_url().'publics/admin/plugins/ckeditor/ckeditor.js',true);
			$this->layout->title('Thêm Bài Viết Mới');
			$this->layout->view($html);
		}
		else
		{
			$teacher = $this->teacher_model->profile($this->datalogged['id']);
			$datateacher['teacher'] = !empty($teacher)?$teacher[0]:array();
			$html = $this->tlayout->Header($datateacher);
			$html .= $this->load->view('404','',true);
			$html .= $this->tlayout->Footer();
			$this->layout->js(base_url().'publics/admin/plugins/ckeditor/ckeditor.js',true);
			$this->layout->title('Thêm Bài Viết Mới');
			$this->layout->view($html);
		}
	}

	function del($id='')
	{
		if (empty($this->datalogged['id'])) redirect('login','refresh');
		$red = $this->input->get('redirect');
		$cID = $this->teacher_model->CheckPostID($id, $this->datalogged['id'], '', '2');
		if ($cID)
		{
			//Del
			$res = $this->teacher_model->deletepost($id);
			$this->session->set_flashdata('notification',$res);
			redirect(!empty($red)?$red:null,'refresh');
		}
		else
		{
			$this->session->set_flashdata('notification', array('type'=>'error', 'message' => 'Không thể thực hiện thao tác này.'));
			redirect(!empty($red)?$red:null,'refresh');
		}
	}

	function upload($name){
		$this->load->library('upload');
	    $config = array(
	        'upload_path' =>'uploads/images/news',
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