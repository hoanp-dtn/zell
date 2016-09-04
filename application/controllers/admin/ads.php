<?php

class ads extends MY_Controller {
	
	private $site_id, $lang_code;
	function __construct() {
		parent::__construct ();
		$this->site_id = $this->session->userdata('site_select');
		$this->lang_code = $this->session->userdata('lang_select');
		$this->load->library('Adminlayout');
		$this->load->library('form_validation');
		$this->load->helper(array('form','My_string','url'));
		$this->load->model('admin/model_user');
		$this->load->model('admin/Model_posts');
		$this->load->model('admin/ads_model');
		$this->permit->authentication();
		$this->load->model('admin/permit_model');
		$this->load->model('admin/site_model');
		$site_select = (int)$this->input->post('site_select');
		$lang_select = $this->input->post('lang_select');
			if(isset($site_select) && $site_select !=0 && isset($lang_select) && !empty($lang_select)){
				$this->session->set_userdata('site_select',$site_select);
				$this->session->set_userdata('lang_select',$lang_select);
				redirect(curPageURL());
			}	}
	
	
	public function del($id = 0){
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/ads/view';
		$flag=$this->ads_model->del($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect($redirect);
	}
	
	public function view($page=1){
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/ads/view');
		$config['total_rows'] = $this->ads_model->total(array('site_id'=>$this->site_id));
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1; 
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['list_ads'] = $this->ads_model->view(($page*$config['per_page']),$config['per_page'],array('utt_post.site_id'=>$this->site_id));
		}
		$data['active'] = array('ads','ads/view');
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/ads/ads_view',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí quảng cáo');
		$this->layout->view($html);	
	}
	
	public function changeStatus($id = 0){
		$flag=$this->Model_posts->changeStatus($id);
		$this->session->set_flashdata('message_flashdata',$flag);
		redirect('admin/ads/view');
	}
	public function add(){
        $this->config->load('config_data');
        $config = $this->config->item('data');
		$list_adzone = array();
		foreach($config['adzone'] as $key => $val){
			$list_adzone[$key] = $val['name'];
		}
		$data['list_adzone'] = $list_adzone;
		if(isset($_POST)&& !empty($_POST)){
			$data['current_adzone'] = $this->input->post('adzone');
			$rules = array(
				// array(
					// 'field'=>'url',
					// 'label'=>'Đường dẫn',
					// 'rules'=>'trim|callback__url'
				// ),
				array(
					'field'=>'status',
					'label'=>'Trạng thái hiển thị',
					'rules'=>'callback__checkStatus'
				),
				array(
					'field'=>'adzone',
					'label'=>'Vùng hiển thị',
					'rules'=>'callback__checkAdzone'
				)
            );

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$flag = $this->ads_model->add();
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/ads/view');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$data['active'] = array('ads','ads/add');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/ads/ads_add',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí quảng cáo');
		$this->layout->view($html);
	}
	
	public function edit($id = 0){
		
		$ads = $this->ads_model->total(array('site_id'=>$this->site_id,'id'=>(int)$id));
		if(!isset($ads) || $ads ==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Quảng cáo này không tồn tại'));
			redirect('admin/ads/view');
		}
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'ads/view';
        $this->config->load('config_data');
        $config = $this->config->item('data');
		$list_adzone = array();
		foreach($config['adzone'] as $key => $val){
			$list_adzone[$key] = $val['name'];
		}
		$data['list_adzone'] = $list_adzone;
		$tmp = $this->ads_model->view(NULL,NULL,array('utt_post.site_id'=>$this->site_id,'utt_post.id' => $id));
		$data['ads'] = $tmp[$id];
		if(isset($_POST)&& !empty($_POST)){
			$data['current_adzone'] = $this->input->post('adzone');
			$rules = array(
				// array(
					// 'field'=>'url',
					// 'label'=>'Đường dẫn',
					// 'rules'=>'trim|callback__url'
				// ),
				array(
					'field'=>'status',
					'label'=>'Trạng thái hiển thị',
					'rules'=>'callback__checkStatus'
				),
				array(
					'field'=>'adzone',
					'label'=>'Vùng hiển thị',
					'rules'=>'callback__checkAdzone'
				)
            );

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$flag = $this->ads_model->edit($id);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect($redirect);
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/ads/ads_edit',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí quảng cáo');
		$this->layout->view($html);
	}
	
	function _url($url){
		if($url != "" && !$this->common->isUrl($url)){
			$this->form_validation->set_message('_url','%s không hợp lệ');
			return false;
		}
		return true;
	}
	
	function _checkStatus($val){
		if($val <1 || $val > 2){
			$this->form_validation->set_message('_checkStatus', '%s không hợp lệ');
			return false;
		}
		return true;
	}
	function _checkAdzone($val){
		if($val == '0'){
			$this->form_validation->set_message('_checkAdzone', 'Bạn chưa chọn %s');
			return false;
		}
		$this->config->load('config_data');
        $config = $this->config->item('data');
		$list_adzone_key = array();
		foreach($config['adzone'] as $key => $val1){
			$list_adzone_key[] = $key;
		}
		if(!in_array($val,$list_adzone_key)){
			$this->form_validation->set_message('_checkAdzone', '%s không hợp lệ');
			return false;
		}
		return true;
	}
}
