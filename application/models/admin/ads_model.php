<?php
class ads_model extends MY_Model {
	private $site_id;
	
	function __construct(){
        parent::__construct();
		$this->site_id = $this->session->userdata('site_select');
    }
	
	function get($param, $where){
		$this->db->select($param)->from('utt_post');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->get()->row_array();
	}
	
	public function getListPostId($start,$limit,$where = NULL){
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		
		if(isset($start) && isset($limit) && is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit,$start);
		}
		return $this->db->select('utt_post.id, utt_post.image,utt_post.time_create,utt_post.time_update, utt_post.description, utt_post.status')->from('utt_post')->where('post_type','ads')->get()->result_array();	
	}
	
	public function view($start = NULL,$limit = NULL,$where=NULL){
		$list_post_id_tmp = $this->getListPostId($start,$limit,$where);
		$list_post_id = array();
		foreach($list_post_id_tmp as $key => $val){
			$list_post_id[] = $val['id'];
		}
		$tmp = $this->db->select('utt_postmeta.post_id, utt_postmeta.key, utt_postmeta.value')->from('utt_postmeta')->where_in('utt_postmeta.post_id',$list_post_id)->get()->result_array();
		$list_ads = array();
		
		foreach($list_post_id_tmp as $key => $val){
			$list_ads[$val['id']]['image'] = $val['image'];
			$list_ads[$val['id']]['description'] = $val['description'];
			$list_ads[$val['id']]['time_update'] = $val['time_update'];
			$list_ads[$val['id']]['time_create'] = $val['time_create'];
			$list_ads[$val['id']]['status'] = $val['status'];
		}
		foreach($tmp as $key => $val){
			$list_ads[$val['post_id']][$val['key']] = $val['value'];
			if($val['key'] == 'adzone'){
				$this->config->load('config_data');
				$config = $this->config->item('data');
				$list_ads[$val['post_id']]['adzone_title'] = $config['adzone'][$val['value']]['name'];
			}
		}
		return $list_ads;
	}
	
	public function total($where = NULL) {
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->from('utt_post')->where('post_type = ','ads')->count_all_results();
	}
	public function getcount($where = NULL) {
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->from('utt_postmeta')->count_all_results();
	}
	
	function getImage($id){
		$select ='SELECT image from utt_post where id = \''.$id.'\'';
		return $output = $this->db->query($select)->row()->image;
	}
	
	public function del($id = 0){
		$images_del=$this->getImage($id);
		$path_to_file = './uploads/images/ads/'.$images_del;
		if(file_exists($path_to_file)){
			unlink($path_to_file);
		}
		$this->db->delete('utt_postmeta',array('post_id'=>$id));
		return $this->_delete('utt_post',array('id'=>$id));
	}
	
	function edit($id)
	{
		$type = $this->input->post('type');
		$img = $this->db->select('image')->from('utt_post')->where('id',$id)->get()->row_array();
		$file_name = $img['image'];
		$is_change_image = $this->input->post('is_change_image');
		if( ($is_change_image == 1) && ($type==1)) {
			$images_del=$file_name;
			$path_to_file = './uploads/images/ads/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		if($type==2){
			$images_del=$file_name;
			$path_to_file = './uploads/images/ads/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$file_name = NULL;
		}
		$date_to_int = time();
		$link = $this->input->post('url');
		$js = $this->input->post('javascript');
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$data1 = array(
			'post_type' =>'ads',
			'time_update' => $date_to_int,
			'user_id' =>$user_id,
			'site_id' =>$this->site_id,
			'description' =>$this->input->post('description'),
			'image' => $file_name,
			'status' => $this->input->post('status')
		);
		$this->db->update('utt_post',$data1,array('id'=>$id));
		$flag = $this->db->affected_rows();
		if($flag>0) {
			$this->db->flush_cache();
			if($type == 2){
				$countlink = $this->getcount(array('post_id' => $id, 'key' => 'link'));
				if($countlink > 0){
					$this->db->delete('utt_postmeta',array('post_id' => $id, 'key' => 'link'));
				}
				$countjs = $this->getcount(array('post_id' => $id, 'key' => 'javascript'));
				if($countjs != 0){
					$this->db->update('utt_postmeta', array(
						'key' => 'javascript',
						'value' => $js
					),array('post_id' => $id,'key' => 'javascript'));
				}
				if($countjs == 0){
					$this->db->insert('utt_postmeta',array('post_id' => $id, 'key' => 'javascript', 'value' => $js));
				}
			}
			if($type == 1){
				$countjs = $this->getcount(array('post_id' => $id, 'key' => 'javascript'));
				if($countjs > 0){
					$this->db->delete('utt_postmeta',array('post_id' => $id, 'key' => 'javascript'));
				}
				$countlink = $this->getcount(array('post_id' => $id, 'key' => 'link'));
				if($countlink != 0){
					$this->db->update('utt_postmeta', array(
						'key' => 'link',
						'value' => $link
					),array('post_id' => $id,'key' => 'link'));
				}
				if($countlink == 0){
					$this->db->insert('utt_postmeta',array('post_id' => $id, 'key' => 'link', 'value' => $link));
				}
			}
			
			$this->db->update('utt_postmeta', array(
					'key' => 'adzone',
					'value' => $this->input->post('adzone')
			   ),array('post_id' => $id,'key' => 'adzone'));
			return array(
				'type'=>'successful',
				'message'=>'sửa thành công'
			);
		}else {
			return array(
				'type'=>'error',
				'message'=>'sửa thất bại'
			);
		}
	}
	
	function add() {
		$date_to_int = time();
		$type = $this->input->post('type');
		$file_name = '';
		if($type=='1'){
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		$link = $this->input->post('url');
		$js = $this->input->post('javascript');
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$data1 = array(
			'post_type' =>'ads',
			'time_create' => $date_to_int,
			'user_id' =>$user_id,
			'site_id' =>$this->site_id,
			'description' =>$this->input->post('description'),
			'image' => $file_name,
			'status' => $this->input->post('status')
		);
		$this->db->insert('utt_post',$data1);
		$post_id = $this->db->insert_id();
		$flag = $this->db->affected_rows();
		if($flag>0) {
			$this->db->flush_cache();
			$data2 = array(
			   array(
					'key' => 'adzone',
					'value' => $this->input->post('adzone'),
					'post_id' => $post_id
			   )
			);
			if($type==1){
				if($link != ''){
					$data2[] = array(
						'key' => 'link',
						'value' => $link,
						'post_id' => $post_id
					);
				}
			}
			if($type==2){
				if($js != ''){
					$data2[] = array(
						'key' => 'javascript',
						'value' => $js,
						'post_id' => $post_id,
					);
				}
			}
			$this->db->insert_batch('utt_postmeta', $data2);
			return array(
				'type'=>'successful',
				'message'=>'Thêm thành công'
			);
		}else {
			return array(
				'type'=>'error',
				'message'=>'Thêm thất bại'
			);
		}
	}
	function do_upload()
	{
		$config['upload_path'] = './uploads/images/ads';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000000';
		$config['max_width']  = '10240';
		$config['max_height']  = '76800';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
	}
}