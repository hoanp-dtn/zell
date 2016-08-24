<?php

class Comment extends MY_Controller {
	private $redirect;
	private $site_id,$lang_code;
	
	function __construct() {
		parent::__construct ();
		$this->permit->authentication();
		$this->load->library('Adminlayout');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url','My_string'));
		$this->load->model('admin/comment_model');
		$this->load->model('admin/Model_posts');
		$this->redirect = $this->input->get('redirect');
		(isset($this->redirect) && !empty($this->redirect))?($this->redirect=base64_decode($this->redirect)):($this->redirect='admin/comment/view');
		$this->lang_code = $this->session->userdata('lang_select');
		$this->load->model('admin/permit_model');
		$this->load->model('admin/site_model');
		$lang_select = $this->input->post('lang_select');
			if(isset($lang_select) && !empty($lang_select)){
				$this->session->set_userdata('lang_select',$lang_select);
				redirect(curPageURL());
			}
	}
	
	function __destruct(){
		$this->permit->checkSelectSite();
	}
	function view_pending()
	{
		$data['view_post_feild'] = true;
		$data['status'] = "chưa được duyệt";
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/comment/view_pending');
		$config['total_rows'] = $this->comment_model->getcount(array('site_id'=>$this->site_id,'status'=>0));
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1; 
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['comment'] = $this->comment_model->view(
			array('utt_comment.site_id'=>$this->site_id,'utt_comment.status'=>0),$config['per_page'],($page*$config['per_page']),'utt_comment.time_created DESC');
		}
		$data['total'] = $config['total_rows'];
		$data['active'] = array('comment','comment/view_pending');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$site = $this->site_model->getEdit(PREFIX.'site', $this->site_id);
		$data['url_site'] = $site['url_name'];
		$html .= $this->load->view('backend/comment/comment_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí comment');	
		$this->layout->view($html);
	}
	function view_active()
	{
		$data['view_post_feild'] = true;
		$data['status'] = "đã được duyệt";
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/comment/view_active');
		$config['total_rows'] = $this->comment_model->getcount(array('site_id'=>$this->site_id,'status'=>1));
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1; 
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['comment'] = $this->comment_model->view(
			array('utt_comment.site_id'=>$this->site_id,'utt_comment.status'=>1),$config['per_page'],($page*$config['per_page']),'utt_comment.time_created DESC');
		}
		$data['total'] = $config['total_rows'];
		$data['active'] = array('comment','comment/view_active');
		$data['page'] = 'active';
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$site = $this->site_model->getEdit(PREFIX.'site', $this->site_id);
		$data['url_site'] = $site['url_name'];
		$html .= $this->load->view('backend/comment/comment_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí comment');	
		$this->layout->view($html);
	}
	function post_comment($post_id = 0){
		$data['view_post_feild'] = false;
		$getID = $this->Model_posts->get('id, title',array('id' => (int)$post_id));
		if(!isset($getID)||count($getID)==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Bài viết này không tồn tại'));
			redirect('admin/comment/view_pending');
		}
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/comment/post_comment/'.$post_id);
		$config['total_rows'] = $this->comment_model->getcount(array('site_id'=>$this->site_id,'post_id'=>(int)$post_id));
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1; 
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['comment'] = $this->comment_model->view(
			array('utt_comment.site_id'=>$this->site_id,'utt_comment.post_id'=>(int)$post_id),$config['per_page'],($page*$config['per_page']),'utt_comment.time_created DESC');
		}
		$data['total'] = $config['total_rows'];
		$data['post_title'] = $getID['title'];
		$data['active'] = array('comment');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$site = $this->site_model->getEdit(PREFIX.'site', $this->site_id);
		$data['url_site'] = $site['url_name'];
		$html .= $this->load->view('backend/comment/comment_view',$data,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí comment');	
		$this->layout->view($html);
	}
	function del($id = 0){
		$comment = $this->comment_model->get('id',array('id'=> (int)$id,'site_id'=>$this->site_id));
		if(!isset($comment) || count($comment)==0){
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Comment này không tồn tại'));
			redirect($this->redirect);
		}
		$flag = $this->comment_model->del(array('id' => $id,'site_id'=>$this->site_id));
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect($this->redirect);
	}
	
	function changeStatus($id=0){
		$comment = $this->comment_model->get('id',array('id'=> (int)$id,'site_id'=>$this->site_id));
		if(!isset($comment)||count($comment)==0){
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Comment này không tồn tại'));
			redirect($this->redirect);
		}
		$flag = $this->comment_model->changeStatus($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect($this->redirect);
	}
	public function edit($id = 0){
		$comment = $this->comment_model->get('*',array('id'=> (int)$id,'site_id'=>$this->site_id));
		if(!isset($comment)||count($comment)==0){
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Comment này không tồn tại'));
			redirect($this->redirect);
		}
		if(isset($_POST)&&!empty($_POST)){
			$data['current_status'] = $this->input->post('status');
			$config = array(
				array(
					'field'=>'name',
					'label'=>'Họ tên',
					'rules'=>'trim|required'
				),
				array(
					'field'=>'email',
					'label'=>'Email',
					'rules'=>'trim|required|valid_email'
				),
				array(
					'field'=>'detail',
					'label'=>'Nội dung bình luận',
					'rules'=>'trim|required'
				),
				array(
					'field'=>'status',
					'label'=>'Trạng thái hiển thị',
					'rules'=>'callback__checkStatus'
				)
            );

			$this->form_validation->set_rules($config);
			if($this->form_validation->run()){
				$flag = $this->comment_model->change($id);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect($this->redirect);
			}
			$this->form_validation->set_error_delimiters('<div class="form-group has-error"> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>','</label></div>');
		}
		$data['comment'] = $comment;
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view($this->template_f . 'backend/comment/comment_edit', isset($data)?$data:'', true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí comment');		
		$this->layout->view($html);	
	}
	
	
	// function add(){
		// if(isset($_POST)&&!empty($_POST)){
			// $data['current_status'] = $this->input->post('status');
			// $data['current_location'] = $this->input->post('location');
			// $config = array(
				// array(
					// 'field'=>'url',
					// 'label'=>'Đường dẫn',
					// 'rules'=>'trim|callback__url'
				// ),
				// array(
					// 'field'=>'status',
					// 'label'=>'Trạng thái hiển thị',
					// 'rules'=>'callback__checkStatus'
				// ),
				// array(
					// 'field'=>'location',
					// 'label'=>'Vị trí hiển thị',
					// 'rules'=>'callback__checkLocation'
				// )
            // );

			// $this->form_validation->set_rules($config);
			// if($this->form_validation->run()){
				// $flag = $this->comment_model->add();
				// $this->session->set_flashdata('message_flashdata',$flag);
				// redirect($this->redirect);
			// }
			// $this->form_validation->set_error_delimiters('<div class="form-group has-error"> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>','</label></div>');
		// }
		// $data['active'] = array('comment','comment/add');
		// $data['list_location'] = $this->comment_model->dropdown(array('site_id'=>$this->site_id));
		// $html  = $this->adminlayout->loadTop();
		// $html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		// $html .= $this->load->view($this->template_f . 'backend/comment/comment_add', isset($data)?$data:'', true);
		// $html .= $this->adminlayout->loadFooter();
		// $this->layout->title('Thêm comment');		
		// $this->layout->view($html);	
	// }
	function _checkStatus($val){
		if($val <0 || $val > 1){
			$this->form_validation->set_message('_checkStatus', '%s không hợp lệ');
			return false;
		}
		return true;
	}
	// function _checkLocation($val){
		// if($val == 0){
			// $this->form_validation->set_message('_checkLocation', 'Bạn chưa chọn %s');
			// return false;
		// }
		// $count = $this->comment_model->getcount(array('site_id'=>$this->site_id));
		// if($val <1 || $val > $count + 1){
			// $this->form_validation->set_message('_checkLocation', '%s không hợp lệ');
			// return false;
		// }
		// return true;
	// }
	// function _checkLocationUpdate($val){
		// if($val == 0){
			// $this->form_validation->set_message('_checkLocationUpdate', 'Bạn chưa chọn %s');
			// return false;
		// }
		// $count = $this->comment_model->getcount(array('site_id'=>$this->site_id));
		// if($val <1 || $val > $count){
			// $this->form_validation->set_message('_checkLocationUpdate', '%s không hợp lệ');
			// return false;
		// }
		// return true;
	// }
	
	// function _url($url){
		// if($url != "" && !$this->common->isUrl($url)){
			// $this->form_validation->set_message('_url','%s không hợp lệ');
			// return false;
		// }
		// return true;
	// }
}
