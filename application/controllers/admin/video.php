<?php



class Video extends MY_Controller {

	private $redirect;


	

	function __construct() {

		parent::__construct ();

		$this->permit->authentication();

		$this->load->library('Adminlayout');

		$this->load->library('form_validation');

		$this->load->helper(array('form', 'url','My_string'));

		$this->load->model('admin/video_model');


		$this->load->model('admin/Model_posts');

		$this->redirect = $this->input->get('redirect');

		(isset($this->redirect) && !empty($this->redirect))?($this->redirect=base64_decode($this->redirect)):($this->redirect='admin/video/view');



		$this->load->model('admin/permit_model');


	}

	function view(){


		$this->load->config('pagination');

		$this->load->library('pagination');

		$config = $this->config->item('pagination');

		$config['base_url']	= $this->config->base_url('admin/video/view/');

		$config['total_rows'] = $this->video_model->getcount(array('type' => 'video'));
		$total_page=ceil($config['total_rows']/$config['per_page']);

		$page = (int)$this->input->get('page');

		$page = ($page>$total_page)?$total_page:$page;

		$page = ($page<1)?1:$page;

		$page = $page-1; 

		$this->pagination->initialize($config);

		$data['list_paginition'] = $this->pagination->create_links();

		if($config['total_rows']>0){

			$data['video'] = $this->video_model->view(

			array('id', 'url', 'img','status','','location','title'),

			array('type'=>'video'),$config['per_page'],($page*$config['per_page']),'location ASC');

		}


		$data['active'] = array('video','video/view');

		$html = $this->adminlayout->loadTop();

		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);

		$html .= $this->load->view('backend/video/video_view',$data,true);

		$html .= $this->adminlayout->loadFooter();

		$this->layout->title('Quản lí video');	

		$this->layout->view($html);

	}

	function del($id = 0){

		$video = $this->video_model->get('id',array('id'=> (int)$id));

		if(!isset($video) || count($video)==0){

			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Video này không tồn tại'));

			redirect($this->redirect);

		}

		$flag = $this->video_model->del(array('id' => $id));

		$this->session->set_flashdata('message_flashdata',$flag);

		redirect($this->redirect);

	}

	

	function changeStatus($id=0){

		$video = $this->video_model->get('id',array('id'=> (int)$id));

		if(!isset($video)||count($video)==0){

			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'video này không tồn tại'));

			redirect($this->redirect);

		}

		$flag = $this->video_model->changeStatus($id);

		$this->session->set_flashdata('message_flashdata',$flag);

		redirect($this->redirect);

	}

	public function edit($id = 0){

		$video = $this->video_model->get('*,(select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',array('id'=> (int)$id));

		if(!isset($video)||count($video)==0){

			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'video này không tồn tại'));

			redirect($this->redirect);

		}

		$post_id = $this->input->post('post_id');

		if(isset($_POST)&&!empty($_POST)){

			$data['current_post'] = $this->Model_posts->get('id, title', array('post_type'=>'news','id'=>(int)$post_id),false);

			$data['current_status'] = $this->input->post('status');

			$data['current_location'] = $this->input->post('location');

			$config = array(

				array(

					'field'=>'url',

					'label'=>'Đường dẫn',

					'rules'=>'trim'

				),

				array(

					'field'=>'status',

					'label'=>'Trạng thái hiển thị',

					'rules'=>'callback__checkStatus'

				),

				array(

					'field'=>'title',

					'label'=>'Tiêu đề',

					'rules'=>'trim|required'

				),


            );



			$this->form_validation->set_rules($config);

			if($this->form_validation->run()){

				$flag = $this->video_model->change($id);

				$this->session->set_flashdata('message_flashdata',$flag);

				redirect($this->redirect);

			}

			$this->form_validation->set_error_delimiters('<div class="form-group has-error"> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>','</label></div>');

		}

		$data['video'] = $video;

		$data['list_location'] = $this->video_model->dropdown(array());

		$html  = $this->adminlayout->loadTop();

		$html .= $this->adminlayout->loadMenu();

		$html .= $this->load->view($this->template_f . 'backend/video/video_edit', isset($data)?$data:'', true);

		$html .= $this->adminlayout->loadFooter();

		$this->layout->title('Quản lí video');		

		$this->layout->view($html);	

	}

	

	

	function add(){

		$post_id = $this->input->post('post_id');

		if(isset($_POST)&&!empty($_POST)){

			$data['post'] = $this->Model_posts->get('id, title', array('post_type'=>'news','id'=>(int)$post_id),false);

			$data['current_status'] = $this->input->post('status');

			$data['current_location'] = $this->input->post('location');

			$config = array(

				array(

					'field'=>'url',

					'label'=>'Đường dẫn',

					'rules'=>'trim|required'

				),

				array(

					'field'=>'status',

					'label'=>'Trạng thái hiển thị',

					'rules'=>'callback__checkStatus'

				),


				array(

					'field'=>'title',

					'label'=>'Tiêu đề',

					'rules'=>'trim|required'

				),


            );



			$this->form_validation->set_rules($config);

			if($this->form_validation->run()){

				$flag = $this->video_model->add();

				$this->session->set_flashdata('message_flashdata',$flag);

				redirect($this->redirect);

			}

			$this->form_validation->set_error_delimiters('<div class="form-group has-error"> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>','</label></div>');

		}

		$data['active'] = array('video','video/add');


		$data['list_location'] = $this->video_model->dropdown(array());

		$html  = $this->adminlayout->loadTop();

		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);

		$html .= $this->load->view($this->template_f . 'backend/video/video_add', isset($data)?$data:'', true);

		$html .= $this->adminlayout->loadFooter();

		$this->layout->title('Thêm video');		

		$this->layout->view($html);	

	}

	function _checkStatus($val){

		if($val <0 || $val > 1){

			$this->form_validation->set_message('_checkStatus', '%s không hợp lệ');

			return false;

		}

		return true;

	}

	function _checkLocation($val){

		if($val == 0){

			$this->form_validation->set_message('_checkLocation', 'Bạn chưa chọn %s');

			return false;

		}

		$count = $this->video_model->getcount(array());

		if($val <1 || $val > $count + 1){

			$this->form_validation->set_message('_checkLocation', '%s không hợp lệ');

			return false;

		}

		return true;

	}

	function _checkLocationUpdate($val){

		if($val == 0){

			$this->form_validation->set_message('_checkLocationUpdate', 'Bạn chưa chọn %s');

			return false;

		}

		$count = $this->video_model->getcount(array());

		if($val <1 || $val > $count){

			$this->form_validation->set_message('_checkLocationUpdate', '%s không hợp lệ');

			return false;

		}

		return true;

	}

	

	function _url($url){

		if($url != "" && !$this->common->isUrl($url)){

			$this->form_validation->set_message('_url','%s không hợp lệ');

			return false;

		}

		return true;

	}

	

	

	function _checkPost($post_id){

		if((int)$post_id != 0){

			$count = count($this->Model_posts->get('id', array('post_type'=>'news','id'=>(int)$post_id),true));

			if(!isset($count) || $count < 1){

				$this->form_validation->set_message('_checkPost','%s này không tồn tại');

				return false;

			}

		}

		return true;

	}

	public function getLocation(){


		$list_location =$this->video_model->dropdown(array());

		$data_list_location = ""; 

		foreach($list_location as $key => $val){

			$data_list_location.= "<option value='".$key."'>".$val."</option>";

		}

		echo $data_list_location;

	}

	

	function getListPosts(){

		 $q = $this->input->get('q');

		 $like = array(

			'feild' =>'title',

			'val' => $q

		 );

		 $data = $this->Model_posts->get('id,title', array('post_type'=>'news'),true,$like);

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

}

