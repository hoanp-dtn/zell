<?php

class Navigation extends MY_Controller {
	private $authentication;
	
	function __construct() {
		parent::__construct ();
		$this->load->library('Adminlayout');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('admin/navigation_model');
		$this->load->model('admin/category_model');
		$this->load->model('admin/model_user');
		$this->load->model('admin/Model_posts');
		$this->permit->authentication();
		$this->load->model('admin/permit_model');
	}
	
	function view(){
		$this->navigation_model->getChild(0,null);
		$data['active'] = array('navigation','navigation/view');
		$data['list_navigation'] = $this->navigation_model->menudequy(0,'',$this->navigation_model->view());
		// print_r($data['list_navigation']);die;
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/navigation/navigation_view',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí menu');	
		$this->layout->view($html);	
	}

	function del($id = 0){
		$navigation = $this->navigation_model->get('*',array('id'=> (int)$id));
		if(!isset($navigation)||count($navigation)==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Menu này không tồn tại'));
			redirect('admin/navigation/view');
		}
		$child = $this->navigation_model->getChild($id);
		if(isset($child) && count($child)){
			$this->session->set_flashdata('message_flashdata',array(
				'type'=>'error',
				'message' => 'Bạn phải xóa hoặc di chuyển menu con trước khi xóa menu này'
			));
			redirect('admin/navigation/view');
			return false;
		}
		
		$this->navigation_model->update(array('location'=>"location -1"),array(
			'location >'  => $navigation['location'],
			'parent_id'   => $navigation['parent_id'],
		),FALSE);
		$this->navigation_model->del(array(
			'id'=>$navigation['id']
		));
		redirect('admin/navigation/view');
	}
	public function edit($id = 0){
		$navigation = $this->navigation_model->get('*,(select utt_post.title from utt_post where utt_post.id = utt_navigation.post_id) as post_title',array('id'=> (int)$id));
		if(!isset($navigation)||count($navigation)==0) {
			$this->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Menu này không tồn tại'));
			redirect('admin/navigation/view');
		}
		$parent_id = $this->input->post('parent_id');
		$cate_id = $this->input->post('cate_id');
		$title = $this->input->post('title');
		$title_en = $this->input->post('title_en');
		$url = $this->input->post('url');
		$location = $this->input->post('location');
		$sub_nav = $this->input->post('sub_nav');
		$post_id = $this->input->post('post_id');
		$menu_type = $this->input->post('menu_type');
		if(isset($_POST) && !empty($_POST)){
			$data['current_post'] = $this->Model_posts->get('id, title', array('post_type'=>'news','id'=>(int)$post_id),false);
			$data['current_cate'] = (int)$cate_id;
			$data['current_nav'] = (int)$parent_id;
			$data['current_sub_nav'] = (int)$sub_nav;
			$data['current_location'] = (int)$location;
			$data['menu_type'] = (int)$menu_type;
			$this->form_validation->set_rules('menu_type','Kiểu menu','required');
			$this->form_validation->set_rules('title','Tên menu(VN)','required|trim');
			$this->form_validation->set_rules('title_en','Tên menu(EN)','required|trim');
			$this->form_validation->set_rules('url','Đường dẫn','trim');
			$this->form_validation->set_rules('cate_id','Loại tin','callback__cate_id_update['.$id.']');
			$this->form_validation->set_rules('parent_id','Danh mục','callback__parent_id_update['.$navigation['id'].']');
			$this->form_validation->set_rules('location','Vị trí','callback__location');
			$this->form_validation->set_rules('sub_nav','Cho phép thêm danh mục con','callback__sub_nav');
			$this->form_validation->set_rules('post_id','Link bài viết','callback__checkPost');
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
			
			if ($this->form_validation->run()){
				if($parent_id == $navigation['parent_id']){
					if($location > $navigation['location']){
						$this->navigation_model->update(array('location'=>"location -1"),array(
							'location >' => $navigation['location'],
							'location <=' => $location,
							'parent_id'   => $parent_id,
						),FALSE);
					}elseif($location < $navigation['location']){
						$this->navigation_model->update(array('location'=>"location + 1"),array(
							'location >=' => $location,
							'location <' => $navigation['location'],
							'parent_id'   => $parent_id,
						),FALSE);
					}
				}else{
					$total = $this->navigation_model->getcount(array(
						'parent_id' =>$parent_id,
					));
					
					if($location < $total + 1){
						$this->navigation_model->update(array('location'=>"location +1"),array(
							'location <=' => $total,
							'location >=' => $location,
							'parent_id'   => $parent_id,
						),FALSE);
					}
					$this->navigation_model->update(array('location'=>"location - 1"),array(
						'location >' => $navigation['location'],
						'parent_id'  => $navigation['parent_id'],
					),FALSE);
				}
				$flag = $this->navigation_model->update(array(
					'title'     => $title,
					'title_en'     => $title_en,
					'cate_id'   => $cate_id,
					'parent_id' => $parent_id,
					'url' 		=> is_bool($url)?"":$url,
					'location' 	=> $location,
					'post_id' 	=> $post_id,
					'sub_nav' 	=> $sub_nav
				),
				array(
					'id'   => $navigation['id'],
				),TRUE);
				
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/navigation/view');
			}
		}
		$data['navigation'] = $navigation;
		$list_location =$this->navigation_model->dropdown_location(array(
			'parent_id' =>is_bool($parent_id)?$navigation['parent_id']:$parent_id,
		));
		array_pop($list_location);
		$data['list_location'] = $list_location;
		$data['list_category'] = $this->category_model->dropdown();
		$child =  $this->navigation_model->getChild($id);
		$where_not_in = array(
			'feild' => 'id',
			'array' => $child
		);
		$this->navigation_model->getChild(0);
		$tmp = $this->navigation_model->menudequy(0,'',$this->navigation_model->dropdown(null,array('id !='=> $navigation['id'])), $where_not_in);
		$data['list_navigation'][0] = '--Chọn menu cha--';
		foreach($tmp as $key => $val){
			$data['list_navigation'][$val['id']] = $val['title'];
		}
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu();
		$html .= $this->load->view('backend/navigation/navigation_edit',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí menu');	
		$this->layout->view($html);	
	}
	
	
	function add(){
		$parent_id = $this->input->post('parent_id');
		$cate_id = $this->input->post('cate_id');
		$title = $this->input->post('title');
		$title_en = $this->input->post('title_en');
		$url = $this->input->post('url');
		$location = $this->input->post('location');
		$sub_nav = $this->input->post('sub_nav');
		$post_id = $this->input->post('post_id');
		$menu_type = $this->input->post('menu_type');
		$where['type'] = 'news';
		if(isset($_POST) && !empty($_POST)){
			if($_POST['menu_type'] == 1){
				$where['type'] = 'product';
			}
			if((int)$post_id){
				$data['post'] = $this->Model_posts->get('id, title', array('post_type'=>'news','id'=>(int)$post_id),false);
			}
			$data['current_cate'] = (int)$cate_id;
			$data['current_nav'] = (int)$parent_id;
			$data['current_sub_nav'] = (int)$sub_nav;
			$data['current_location'] = (int)$location;
			$data['menu_type'] = (int)$menu_type;
			$this->form_validation->set_rules('title','Tên menu(VN)','required|trim');
			$this->form_validation->set_rules('title_en','Tên menu(EN)','required|trim');
			$this->form_validation->set_rules('url','Đường dẫn','trim');
			$this->form_validation->set_rules('menu_type','Kiểu menu','required');
			$this->form_validation->set_rules('cate_id','Loại tin','callback__cate_id');
			$this->form_validation->set_rules('parent_id','Danh mục','callback__parent_id');
			$this->form_validation->set_rules('location','Vị trí','callback__location');
			$this->form_validation->set_rules('sub_nav','Cho phép thêm danh mục con','callback__sub_nav');
			$this->form_validation->set_rules('post_id','Link bài viết','callback__checkPost['.$this->lang_code.']');
			$this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>','</div>');
			if ($this->form_validation->run()){
				$total = $this->navigation_model->getcount(array(
					'parent_id' =>$parent_id,
				));
				if($location < $total + 1){
					$this->navigation_model->update(array('location'=>"location +1"),array(
						'location >=' => $location,
						'location <=' => $total,
						'parent_id'   => $parent_id,
					),FALSE);
				}
				$flag = $this->navigation_model->insert(array(
					'title'     => $title,
					'title_en'     => $title_en,
					'cate_id'   => $cate_id,
					'parent_id' => $parent_id,
					'url' 		=> is_bool($url)?"":$url,
					'location' 	=> $location,
					'sub_nav' 	=> $sub_nav,
					'post_id' 	=> $post_id,
				));
				$this->session->set_flashdata('message_flashdata',$flag);
				redirect('admin/navigation/view');
			}
		}
		$data['list_location'] =$this->navigation_model->dropdown_location(array(
			'parent_id' =>is_bool($parent_id)?0:$parent_id,
		));
		$data['active'] = array('navigation','navigation/add');
		$data['list_category'] = $this->category_model->dropdown(null, null, $where);
		$this->navigation_model->getChild(0);
		$tmp = $this->navigation_model->menudequy(0,'',$this->navigation_model->dropdown(null,array()));
		$data['list_navigation'][0] = '--Chọn menu cha--';
		foreach($tmp as $key => $val){
			$data['list_navigation'][$val['id']] = $val['title'];
		}
		$html  = $this->adminlayout->loadTop();
		$html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
		$html .= $this->load->view('backend/navigation/navigation_add',isset($data)?$data:NULL,true);
		$html .= $this->adminlayout->loadFooter();
		$this->layout->title('Quản lí menu');	
		$this->layout->view($html);	
	}
	
	
	function _url($url){
		$cate_id = $this->input->post('cate_id');
		if($cate_id != 0 && $url !=""){
			$this->form_validation->set_message('_url','Bạn chỉ được nhập %s hoặc chọn một Loại tin');
			return false;
		}
		if($url != "" && !$this->common->isUrl($url)){
			$this->form_validation->set_message('_url','%s không hợp lệ');
			return false;
		}
		return true;
	}
	function _cate_id($cate_id){
		$navigation = $this->navigation_model->get('*',array('cate_id'=> (int)$cate_id, 'cate_id !=' => 0));
		if(isset($navigation) && count($navigation)){
			$this->form_validation->set_message('_cate_id','Đã tồn tại menu chứa thể loại tin này');
			return false;
		}
		if((int)$cate_id != 0){
			$count = $this->category_model->getcount(array('id'=>$cate_id));
			if($count < 1){
				$this->form_validation->set_message('_cate_id','%s này không tồn tại');
				return false;
			}
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
	function _cate_id_update($cate_id, $id){
		$navigation = $this->navigation_model->get('*',array('cate_id'=> (int)$cate_id, 'cate_id !=' => 0, 'id !='=> (int)$id));
		if(isset($navigation) && count($navigation)){
			$this->form_validation->set_message('_cate_id_update','Đã tồn tại menu chứa thể loại tin này');
			return false;
		}
		if((int)$cate_id != 0){
			$count = $this->category_model->getcount(array('id'=>$cate_id));
			if($count < 1){
				$this->form_validation->set_message('_cate_id_update','%s này không tồn tại');
				return false;
			}
		}
		return true;
	}
	function _parent_id($parent_id){
		if($parent_id != 0){
			$count = $this->navigation_model->getcount(array('id'=>$parent_id));
			if($count < 1){
				$this->form_validation->set_message('_parent_id','%s này không tồn tại');
				return false;
			}
		}
		return true;
	}
	function _parent_id_update($parent_id,$id){
		if($parent_id != 0){
			$count = $this->navigation_model->getcount(array('id'=>$parent_id));
			if($count < 1){
				$this->form_validation->set_message('_parent_id_update','%s này không tồn tại');
				return false;
			}
			$navigation = $this->navigation_model->get('lang',array('id'=> (int)$id));
			$child = $this->navigation_model->getChild($id);
			
			if( is_array($child) && in_array($parent_id,$child)){
				$this->form_validation->set_message('_parent_id_update','Không thể chọn %s này làm danh mục cha');
				return false;
			}
		}
		return true;
	}
	function _sub_nav($sub_nav){
		if($sub_nav < 0 || $sub_nav >1){
			$this->form_validation->set_message('_sub_nav','%s không hợp lệ');
			return false;
		}
		return true;
	}
	function _location($location){
		$parent_id = $this->input->post('parent_id');
		$count = $this->navigation_model->getcount(array('parent_id'=>$parent_id));
		if($location > 0){
			if($location > ($count+1)){
				$this->form_validation->set_message('_location','%s không hợp lệ');
				return false;
			}
		}else{
			$this->form_validation->set_message('_location','Bạn phải chọn %s');
			return false;
		}
		return true;
	}
	public function getCateMenu(){
		$parent_id = $this->input->post('parent_id');
		$list_category = $this->category_model->dropdown();
		$this->navigation_model->getChild(0);
		$tmp = $this->navigation_model->menudequy(0,'',$this->navigation_model->dropdown(null,array()));
		$list_navigation[0] = '--Chọn danh mục cha--';
		foreach($tmp as $key => $val){
			$list_navigation[$val['id']] = $val['title'];
		}
		$data_list_navigation = ""; 
		foreach($list_navigation as $key => $val){
			$data_list_navigation.= "<option value='".$key."'>".$val."</option>";
		}
		
		$data_list_category = ""; 
		foreach($list_category as $key => $val){
			$data_list_category .= "<option value='".$key."'>".$val."</option>";
		}
		$list_location =$this->navigation_model->dropdown_location(array(
			'parent_id' => $parent_id
		));
		$data_list_location = ""; 
		foreach($list_location as $key => $val){
			$data_list_location.= "<option value='".$key."'>".$val."</option>";
		}
		echo '{"list_category":"'.$data_list_category.'", "list_navigation":"'.$data_list_navigation.'","list_location":"'.$data_list_location.'"}';
	}
	
	public function getLocation(){
		$parent_id = $this->input->post('parent_id');
		$list_location =$this->navigation_model->dropdown_location(array(
			'parent_id' => $parent_id,
		));
		$data_list_location = ""; 
		foreach($list_location as $key => $val){
			$data_list_location.= "<option value='".$key."'>".$val."</option>";
		}
		echo '{"list_location":"'.$data_list_location.'"}';
	}
	public function getListCates(){
		if(isset($_POST) && !empty($_POST)){
			$where['type'] = 'news';
			if($_POST['menu_type'] == 1){
				$where['type'] = 'product';
			}
			$list_category = $this->category_model->dropdown(null, null, $where);
			$js = 'id="cate_id" class="form-control"';
			echo form_dropdown('cate_id', (isset($list_category)&&count($list_category))?$list_category:array(), 0, $js);
		}
	}
}

