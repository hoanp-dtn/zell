<?php

class Management extends MY_Controller {
	
	private $_crud;
	
	function __construct() {
		parent::__construct ();
		check_login_admin();
		$this->load->library('Adminlayout');
		$this->load->library('grocery_CRUD');
		$this->load->helper('admin_callback');
		$this->_crud = new grocery_CRUD();
		$this->_crud->set_theme('twitter-bootstrap');
	}
	
	function index() {
				
		try{
			$data = array();
			$data['css_files'] = array(
				site_url().'assets/grocery_crud/themes/twitter-bootstrap/css/bootstrap.min.css',
				site_url().'assets/grocery_crud/themes/twitter-bootstrap/css/bootstrap-responsive.min.css',
			);
			$data['js_files'] = array(
			);
			$data['output'] = '';
			$data['moduleTitle'] = 'Management';
			$html = $this->adminlayout->loadTop();
			$html .= $this->adminlayout->loadMenu();

			$html .= $this->load->view($this->template_f . 'admin/management/management_view', $data, true);
			$html .= $this->adminlayout->loadFooter();

			$this->layout->title('Management');		
			$this->layout->view($html);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function listCity(){
		try{
			$data = array();
			$this->_crud->set_table(PREFIX.'city');
			$this->_crud->set_subject('City');
			$this->_crud->required_fields('name');
			$output = $this->_crud->render();
			$output = (array) $output;
			$data = $output;
			$data['moduleTitle'] = 'Management:: City';
			$html = $this->adminlayout->loadTop();
			$html .= $this->adminlayout->loadMenu();

			$html .= $this->load->view($this->template_f . 'admin/management/management_view', $data, true);
			$html .= $this->adminlayout->loadFooter();

			$this->layout->title('Management:: City');		
			$this->layout->view($html);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function news(){
		try{
			$crud = $this->_crud;
			$data = array();
			$this->_crud->set_table(PREFIX.'posts');
			$this->_crud->where('post_type' , 'news');
			$this->_crud->set_subject('News');
			$this->_crud->required_fields('title', 'image', 'detail', 'cate_id');
			$this->_crud->field_type('title', 'string');
			$crud->set_relation('cate_id',PREFIX.'categories','title', array('type' => 'news_cate'));


			$crud->columns('title', 'cate_id' ,'image', 'time_create');
			$crud->display_as('cate_id','Category');
			$crud->fields('title','desc','detail','image','post_type', 'time_create', 'time_update', 'cate_id');
			$crud->change_field_type('post_type','invisible');
			$this->_crud->field_type('time_create', 'invisible');
			$this->_crud->field_type('time_update', 'invisible');
			$crud->unset_texteditor('desc');
			$crud->set_field_upload('image','uploads/images/news');
			$crud->callback_before_insert(array($this,'news_add_callback'));
			$crud->callback_before_update(array($this,'news_edit_callback'));
			$output = $this->_crud->render();
			$output = (array) $output;
			$data = $output;
			$data['moduleTitle'] = 'Management::News';

			$this->breadcrumbs->push('Dashboard', admin_link('management/'));
			$this->breadcrumbs->push('news', admin_link('management/news'));
			  // $this->breadcrumbs->push('Page', site_url('section/page') );
			$data['breadcrumbs'] = $this->breadcrumbs->show();
			$html = $this->adminlayout->loadTop();
			$html .= $this->adminlayout->loadMenu('news');

			$html .= $this->load->view($this->template_f . 'admin/management/management_view', $data, true);
			$html .= $this->adminlayout->loadFooter();

			$this->layout->title('Management::News');		
			$this->layout->view($html);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function news_add_callback($post_array) {
		  $dateCreate = date('Y-m-d h:i:s');
		  $post_array['post_type'] = 'news';
		  $post_array['time_create'] = $dateCreate;
		  $post_array['time_update'] = $dateCreate;
		  return $post_array;
	}
	function news_edit_callback($post_array) {
		  $dateUpdate = date('Y-m-d h:i:s');
		  $post_array['time_update'] = $dateUpdate;
		  return $post_array;
	}
	

	
	
	
}

