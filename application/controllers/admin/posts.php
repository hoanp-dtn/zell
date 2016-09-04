<?php

class Posts extends MY_Controller {
	
	
	function __construct() {
		parent::__construct ();
		$this->load->library('Adminlayout');
		$this->load->library('form_validation');
		$this->load->library('image_CRUD');
		$this->load->model('admin/model_posts');
		$this->load->helper(array('form','My_string','url'));
		$this->load->model('admin/model_user');
		$this->load->model('admin/category_model');
		$this->permit->authentication();
		$this->load->model('admin/permit_model');
		$this->load->model('posts_home_model');
		$this->load->model('category_home_model');
	}
	
	public function changeStatus($id = 0){
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/posts/view';
		$flag=$this->model_posts->changeStatus($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect($redirect);
	}
	
	public function del($id = 0){
		$flag=$this->model_posts->del($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect('admin/posts/recycle');
	}
	
	public function recyle($id = 0){
		$flag=$this->model_posts->recyle($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect('admin/posts/view');
	}
	
	function view($page=1){
		$this->load->config('pagination');
		$this->load->library('pagination');
		$search = getSaveSqlStr($this->input->get('s'));
		$cate = $this->input->get('cate');
		$config = $this->config->item('pagination');
		if(!is_bool($cate)&&!empty($cate)){
			$config['total_rows'] = $this->model_posts->total(array('cate_id' => $cate,'status !=' => 3, 'post_type'=>'news'),$search);
		}else{
			$config['total_rows'] = $this->model_posts->total(array('status !=' => 3, 'post_type'=>'news'),$search);
		}
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1;
		$data['search'] = $search;
		$data['cate'] = $cate;
		if($config['total_rows']>0){
			$config['base_url']	= $this->config->base_url().'admin/posts/view'.'?s='.$search.(((int)$cate!=0)?'&cate='.(int)$cate:'');
			$data['list_posts'] = $this->model_posts->view(($page*$config['per_page']),$config['per_page'],$search,null,$cate,'news');
		}
		// nhìn debug cho xem
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		$data['active'] = array('post','post/view');
		$data['department_mail'] = $this->model_posts->getDepartment();
		$data['cateTitle'] = $this->category_model->getTitle(null, array());
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/posts/posts_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->css(base_url().'publics/teacher/css/toastr.min.css');
		$this->layout->js(base_url().'publics/teacher/js/toastr.min.js');
		$this->layout->title('Quản lí bài viết');
		$this->layout->view($html);	
	}
	
	function recycle($page=1){
	    $this->load->config('pagination');
		$this->load->library('pagination');
		$search = getSaveSqlStr($this->input->get('s'));
		$cate = $this->input->get('cate');
		$config = $this->config->item('pagination');
		if(!is_bool($cate)&&!empty($cate)){
			$config['total_rows'] = $this->model_posts->count_recycle(array('cate_id' => $cate, 'post_type' => 'news'),$search);
		}else{
			$config['total_rows'] = $this->model_posts->count_recycle(array( 'post_type' => 'news'),$search);
		}
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1;
		$data['search'] = $search;
		$data['cate'] = $cate;
		if($config['total_rows']>0){
			$config['base_url']	= $this->config->base_url().'admin/posts/recycle'.'?s='.$search.(((int)$cate!=0)?'&cate='.(int)$cate:'');
			$data['list_posts'] = $this->model_posts->view_recycle(($page*$config['per_page']),$config['per_page'],$search,null,$cate);
		}
		// nhìn debug cho xem
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		$data['active'] = array('post','post/recycle');
		$data['department_mail'] = $this->model_posts->getDepartment();
		$data['cateTitle'] = $this->category_model->getTitle(null, array());
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/posts/recycle',$data,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->css(base_url().'publics/teacher/css/toastr.min.css');
		$this->layout->js(base_url().'publics/teacher/js/toastr.min.js');
		$this->layout->title('Quản lí bài viết');
		$this->layout->view($html);	
	}
	
	function add(){
		if(!isset($this->uri->rsegments[3])){
			$current_file = unserialize(base64_decode($this->input->post('current_file')));
			if (!(strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest')) {
				$this->model_posts->delete_files($current_file);
			}
		}
		if(isset($_POST) && !empty($_POST)){
            $this->form_validation->set_rules('title','Tiêu đề','trim|required');
			$this->form_validation->set_rules('description','Mô tả','trim|required');
			$this->form_validation->set_rules('detail','Nội dung bài viết','trim|required');
			
			$this->form_validation->set_rules('cate_title','thể loại tin ','callback_checkSelected|callback__cate_title');
			$this->form_validation->set_rules('status','trạng thái hiển thị ','callback__getStatus');
			if($this->form_validation->run()){
				$flag=$this->model_posts->add($current_file);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/posts/view');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
        }
		$data['cateTitle'] = $this->category_model->getTitle(null, array('type'=>'news'));
		$data['active'] = array('post','post/add');
		$data['base']= $this->config->item('base_url');
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		
		
		
		$image_crud = new image_CRUD();
		$image_crud->set_url_field('value');
		$image_crud->set_primary_key_field('id');
		$image_crud->set_type_feild('key');
		$image_crud->set_status_feild('post_id');
		$image_crud->set_status_value(0);
		$image_crud->set_library_view_file('list_file.php');
		$image_crud->set_photo_where(array('post_id'=>0,'key'=>'file'));
		$image_crud->set_type_feild_value('file');
		$image_crud->set_table('utt_postmeta')
		->set_image_path('uploads/files');
			
		$output = $image_crud->render();
		$data['output'] = $output->output;
		$data['js_files'] = $output->js_files;
		$data['css_files'] = $output->css_files;
		
		
		
		
		$html .= $this->load->view('backend/posts/posts_add',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí bài viết');	
		$this->layout->js('publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->js('publics/admin/plugins/select2/distfd/js/select2.min.js',true);
		$this->layout->view($html);	
	}
	
	function edit($id=0){
		$image_crud = new image_CRUD();
		$image_crud->set_url_field('value');
		$image_crud->set_primary_key_field('id');
		$image_crud->set_type_feild('key');
		$image_crud->set_type_feild_value('file');
		$image_crud->set_relation_field('post_id');
		$image_crud->set_library_view_file('list_file.php');
		$image_crud->set_table('utt_postmeta')
		->set_image_path('uploads/files');
			
		$output = $image_crud->render();
		$data['output'] = $output->output;
		$data['js_files'] = $output->js_files;
		$data['css_files'] = $output->css_files;
		
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/posts/view';
		$getID = $this->model_posts->get('id',array('id' => (int)$id));
		$post = $this->model_posts->get_post($id);
		if(!isset($getID)||count($getID)==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Chuyên mục này không tồn tại'));
			redirect('admin/posts/view');
		}
		if(isset($_POST) && !empty($_POST)){
            $this->form_validation->set_rules('title','Tiêu đề','trim|required');
			$this->form_validation->set_rules('description','Mô tả','trim|required');
			$this->form_validation->set_rules('detail','Nội dung bài viết','trim|required');
			$this->form_validation->set_rules('cate_title','thể loại tin','callback_checkSelected|callback__cate_title');
			$this->form_validation->set_rules('status','trạng thái hiển thị ','callback__getStatus');
			if($this->form_validation->run()){
				$flag=$this->model_posts->edit($id);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect($redirect);
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
        }
		$data['cateTitle'] = $this->category_model->getTitle(null, array('type' => 'news'));
		$data['post'] = $post;
		$data['base']= $this->config->item('base_url');
		$data['title'] = $this->category_model->getTitle();
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		
		$html .= $this->load->view('backend/posts/posts_edit',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí bài viết');	
		$this->layout->js('publics/admin/plugins/ckeditor/ckeditor.js',true);
		$this->layout->js('publics/admin/plugins/select2/distfd/js/select2.min.js',true);
		$this->layout->view($html);	
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
	
	
	function _cate_title($cate_title){
		if($cate_title != 0){
			$count = $this->category_model->getcount(array('id'=>$cate_title));
			if($count < 1){
				$this->form_validation->set_message('_cate_title','%s này không tồn tại');
				return false;
			}
		}
		return true;
	}
	
	public function _getStatus($value=''){
		$data=array('1','2','3');
		if($value==1||$value==2||$value==3) {
			return true;
		}
		else {
			$this->form_validation->set_message('_getStatus','%s không tồn tại');
			return false;
		}
		return true;
	}	
	
	public function getListCate()
	{
		$q = $this->input->get('q');
		$like = array(
			'feild' =>'title',
			'val' => $q
		);
		$data = $this->model_posts->get('id,title', array('post_type'=>'news'),true,$like);
		$answer = array();
		if(count($data)){
			foreach($data as $key => $val){
				$answer['items'][] = array(
					'id' => $val['id'],
					'text' => $val['title']
				);
			}
		}
		echo json_encode($answer);
	}

	function send()
	{
		$this->load->model('admin/mail_model');
		if (isset($_POST['mailsend'])&&!empty($_POST['mailsend']))
		{
			$data = $this->input->post('mailsend');
			$post = $this->input->post('postid');
			$post_data = $this->model_posts->get_post($post);
			$link_cate = $this->posts_home_model->getLinkParrentCate($post_data['cate_id']);
			$data = json_decode($data, true);
			$arraymail = array();
			$mailgroup = $data[0];
			$mailoption = $data[1];
			$title = $this->mail_model->getTitle($post);
			// $detail = $this->mail_model->getDetail($post);
			$detail = $post_data['description'];
			$detail .= '==========>  Xem chi tiết tại đây : '.$this->config->base_url().$link_cate.slug($post_data['title']).'-a'.$post_data['id'].'.html';
			foreach ($mailgroup as $key => $value) {
				$check = $this->mail_model->checkdID($value);
				if ($check)
				{
					$mail = $this->mail_model->getMail($value);
					if ($mail)
					{
						foreach ($mail as $k => $val) {
							$arraymail[] = $val['email'];
						}
					}
				}
			}
			if (!empty($mailoption))
			{
				foreach ($mailoption as $key => $value) {
					$arraymail[] = $value;
				}
			}
			if (!empty($arraymail))
			{
				foreach ($arraymail as $key => $value) {
					if (!filter_var(isset($value)?$value:null, FILTER_VALIDATE_EMAIL)) unset($arraymail[$key]);
				}
			}

			$config = array('protocol' => 'smtp',
							    'smtp_host' => 'ssl://smtp.googlemail.com',
							    'smtp_port' => 465,
							    'smtp_user' => 'uttteams@gmail.com',
							    'smtp_pass' => 'UTTTeamAHLPT',
							    'useragent' => 'UTT TEAM',
							    'mailtype'  => 'html',
							    'charset'   => 'utf-8');
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");

			$this->email->from('uttteams@gmail.com', 'UTT Team');
		    
		    $this->email->to($arraymail);
		    $htmlMessage = $detail;
		    $this->email->subject($title);
		    $this->email->message($htmlMessage);

		    if ($this->email->send()) {
		        echo json_encode(array("success"=>"Bài viết '".$title."' đã được gửi thành công.","listsended"=>$arraymail), JSON_PRETTY_PRINT);
		    } else {
		        //show_error($this->email->print_debugger());
		        echo json_encode(array("error"=>"Có lỗi xảy ra! Bài viết chưa được gửi đi"), JSON_PRETTY_PRINT);
		    }
		}
	}
}
