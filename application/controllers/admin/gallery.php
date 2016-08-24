<?php
class Gallery extends MY_Controller
{
	
	private $site_id, $lang_code;
	private $data;
	function __construct()
	{
		parent::__construct ();
		$this->site_id = $this->session->userdata('site_select');
		$this->lang_code = $this->session->userdata('lang_select');
		$this->load->model('admin/category_model');
		$this->load->model('admin/Model_posts');
		$this->load->library('Adminlayout');
		$this->load->model('model_user');
		$this->permit->authentication();
		$this->load->model('admin/permit_model');
		$this->load->library('form_validation');
		$this->load->model('admin/site_model');
		$this->load->library('image_CRUD');
		$site_select = (int)$this->input->post('site_select');
		$lang_select = $this->input->post('lang_select');
			if(isset($site_select) && $site_select !=0 && isset($lang_select) && !empty($lang_select)){
				$this->session->set_userdata('site_select',$site_select);
				$this->session->set_userdata('lang_select',$lang_select);
				redirect(curPageURL());
			}
	}
	
	function __destruct(){
		$this->permit->checkSelectSite();
	}
	function view($page = 1){
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$config['base_url']	= $this->config->base_url('admin/gallery/view');
		$config['total_rows'] = $this->category_model->total(array('site_id'=>$this->site_id,'type'=>'gallery'));
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1;
		$this->pagination->initialize($config);
		$data['list_paginition'] = $this->pagination->create_links();
		if($config['total_rows']>0){
			$data['gallery'] = $this->category_model->get('utt_cate' ,'utt_cate.title,utt_cate.id',array('utt_cate.site_id'=>$this->site_id,'type'=>'gallery'),($page*$config['per_page']), $config['per_page']);
		}
		$data['active'] = array('gallery','gallery/view');
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/gallery/gallery_view',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí album ảnh');
		$this->layout->view($html);
	}
	function add()
	{	
		if(isset($_POST) && !empty($_POST)){
			$this->form_validation->set_rules('title','Tiêu đề album ảnh ','trim|required|callback__checkTitle');
			if($this->form_validation->run()){
				$insert = array(
						'type' => 'gallery',
						'title' => $this->input->post('title'),
						'site_id' => $this->site_id,
						'lang' => $this->lang_code
				);
				$flag = $this->category_model->add('utt_cate',$insert);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/gallery/view');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
		}
		$data['active'] = array('gallery','gallery/add');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/gallery/gallery_add',$data,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí album ảnh');	
		$this->layout->view($html);
	}
	
	function managerimages($id = 0){
		$image_crud = new image_CRUD();
		$image_crud->set_url_field('image');
		$image_crud->set_title_field('title');
		$image_crud->set_primary_key_field('id');
		$image_crud->set_type_feild('post_type');
		$image_crud->set_type_feild_value('gallery');
		$image_crud->set_relation_field('cate_id');
		$image_crud->set_library_view_file('list.php');
		$image_crud->set_status_feild('status');
		$image_crud->set_status_value(0);
		$image_crud->set_table('utt_post')
		->set_ordering_field('sort')
		->set_image_path('uploads/images/gallery');
			
		$output = $image_crud->render();
		
		$getID = $this->category_model->get('utt_cate','utt_cate.id,utt_cate.title',array('id' => (int)$id, 'site_id' => $this->site_id));
		if(!isset($getID)||count($getID)==0){
			redirect('admin/gallery/view');
		}
		$output->gallery = $getID;
		$data['active'] = array('gallery');
		$html = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/gallery/gallery_managerimages',$output,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí album ảnh');	
		$this->layout->view($html);
	}

	function edit($id= 0){
		$redirect= $this->input->get('redirect');
		$redirect = !empty($redirect)?base64_decode($redirect):'admin/gallery/view';
		$getID = $this->category_model->get('utt_cate','utt_cate.id',array('id' => (int)$id, 'site_id' => $this->site_id));
		$gallery = $this->category_model->get('utt_cate' ,'utt_cate.title,utt_cate.id',array('utt_cate.site_id'=>$this->site_id,'type'=>'gallery','id'=>(int)$id));
		if(!isset($getID)||count($getID)==0){
			redirect('admin/gallery/view');
		}
		if(isset($_POST) && !empty($_POST)){
            $this->form_validation->set_rules('title','Tiêu đề album ảnh','trim|required|callback__checkTitleUpdate['.$id.']');
			if($this->form_validation->run()){
				$data['title'] = getSaveSqlStr(strip_tags($this->input->post('title')));
				$flag=$this->category_model->edit('utt_cate', $id, $data);
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect($redirect);
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
        }
		$data['gallery'] = $gallery;
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/gallery/gallery_edit',isset($data)?$data:'',true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí album ảnh');	
		$this->layout->view($html);	
	}
	
	function changeDefaultGallery($id = 0){
		$getID = $this->Model_posts->get('id, cate_id',array('id' => (int)$id));
		if(!isset($getID)||count($getID)==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Ảnh này không tồn tại'));
			redirect('admin/gallery/view');
		}
		$flag = $this->Model_posts->changeDefaultGallery($id, $getID['cate_id']);
		$this->session->set_flashdata('message_flashdata',$flag);
		$redirect = $this->input->get('redirect');
		if(!is_bool($redirect)){
			if(strpos(base64_decode($redirect),'ajax_list')){
				redirect(substr(base64_decode($redirect),0, strpos(base64_decode($redirect),'ajax_list')));
			}else{
				redirect(base64_decode($redirect));
			}
		}
		redirect('admin/gallery/view');
	}
	function delete($id='0')
	{
		$id = (int)$id;
		$getID = $this->Model_posts->get('id',array('cate_id' => (int)$id));
		if(isset($getID) && count($getID)){
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Album này tồn tại ảnh nên không thể xóa được'));
			redirect('admin/gallery/view');
		}
		$flag = $this->category_model->delete('utt_cate',$id);
		$this->session->set_flashdata('message_flashdata', $flag);
		redirect('admin/gallery/view');
	}
	
	function _checkTitleUpdate($title,$id){
		$check = $this->category_model->CheckCate($title," type = 'gallery' and id != ".$id."");
		if(!$check){
			$this->form_validation->set_message('_checkTitleUpdate','%s này đã tồn tại');
			return false;
		}
		return true;
	}
	function _checkTitle($title){
		$check = $this->category_model->CheckCate($title," type = 'gallery'");
		if(!$check){
			$this->form_validation->set_message('_checkTitle','%s này đã tồn tại');
			return false;
		}
		return true;
	}
}

?>