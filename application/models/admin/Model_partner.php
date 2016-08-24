<?php
class Model_partner extends MY_Model {
	
	
	function __construct(){
        parent::__construct();
    }
	
	public function getListPostId($start,$limit,$where = NULL){
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		
		if(isset($start) && isset($limit) && is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit,$start);
		}
		return $this->db->select('utt_post.id,utt_post.title,utt_post.image,utt_post.time_create,utt_post.time_update')->from(''.PREFIX.'post')->where('post_type','partner')->get()->result_array();	
	}
	
	public function view($start,$limit,$where=NULL){
		$list_post_id_tmp = $this->getListPostId($start,$limit,$where);
		$list_post_id = array();
		foreach($list_post_id_tmp as $key => $val){
			$list_post_id[] = $val['id'];
			
		}
		$tmp = $this->db->select('utt_postmeta.post_id,utt_postmeta.key, utt_postmeta.value')->from('utt_postmeta')->where_in('utt_postmeta.post_id',$list_post_id)->ORDER_BY(''.PREFIX.'postmeta.post_id DESC')->get()->result_array();
		$list_partner = array();
		foreach($list_post_id_tmp as $key => $val){
			$list_partner[$val['id']]['title'] = $val['title'];
			$list_partner[$val['id']]['image'] = $val['image'];
			$list_partner[$val['id']]['time_create'] = $val['time_create'];
			$list_partner[$val['id']]['time_update'] = $val['time_update'];
			
		}
		foreach($tmp as $key => $val){
			$list_partner[$val['post_id']][$val['key']] = $val['value'];
			
		}
		return $list_partner;
	}
	
	public function total($where = NULL) {
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->from('utt_post')->where('post_type = ','partner')->count_all_results();
	}
	
	function getImage($id){
		$select ='SELECT image from utt_post where id = \''.$id.'\'';
		return $output = $this->db->query($select)->row()->image;
	}
	
	public function del($id = 0){
		$images_del=$this->getImage($id);
		$path_to_file = './uploads/images/partner/'.$images_del;
		unlink($path_to_file);
		$this->db->delete('utt_postmeta',array('post_id'=>$id));
		return $this->_delete('utt_post',array('id'=>$id));
	}
	
	public function edit($id){
		$img = $this->db->select('image')->from('utt_post')->where('id',$id)->get()->row_array();
		$file_name = $img['image'];
		$is_change_image = $this->input->post('is_change_image');
		if($is_change_image == 1){
			$images_del=$file_name;
			$path_to_file = './uploads/images/partner/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		$date_to_int = time();
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$data = array(
			'title' => getSaveSqlStr($this->input->post('name')),
			'image' => getSaveSqlStr($file_name),
			'user_id' =>$user_id,
			'time_update' => $date_to_int
		);
		$data1 = array(
			'value' => $this->input->post('link')
		);
		$this->db->where('post_id' , $id)->where('key','link')->update('utt_postmeta',$data1);
		$data2 = array(
			'value' => getSaveSqlStr($this->input->post('phonenumber'))
		);
		$this->db->where('post_id' , $id )->where('key','phonenumber')->update('utt_postmeta',$data2);
		$data3 = array(
			'value' => getSaveSqlStr($this->input->post('email'))
		);
		$this->db->where( 'post_id' , $id )->where('key','email')->update('utt_postmeta',$data3);
		return $this->_update('utt_post',$data,array('id'=>$id));
	}
	
	function add() {
		$date_to_int = time();
		$this->do_upload();
		$upload_data = $this->upload->data(); 
		$file_name =   $upload_data['file_name'];
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$data = array(
			'post_type' =>'partner',
			'time_create' => $date_to_int,
			'user_id' => $user_id,
			'title' => getSaveSqlStr($this->input->post('name')),
			'image' => getSaveSqlStr($file_name),
		);
		$this->db->insert('utt_post',$data);
		$post_id = $this->db->insert_id();
		$flag = $this->db->affected_rows();
		if($flag>0) {
			$this->db->flush_cache();
			$data1 = array(
				array(
					'post_id' => $post_id,
					'key' => 'link',
					'value' => getSaveSqlStr($this->input->post('link'))
				),
				array(
					'post_id' => $post_id,
					'key' => 'phonenumber',
					'value' => getSaveSqlStr($this->input->post('phonenumber'))
				),
				array(
					'post_id' => $post_id,
					'key' => 'email',
					'value' => getSaveSqlStr($this->input->post('email'))
				)
			);
			$this->db->insert_batch('utt_postmeta', $data1); 
			return array(
				'type'=>'successful',
				'message'=>'Thêm thành công'
			);
		}
		else {
			return array(
				'type'=>'error',
				'message'=>'Thêm thất bại'
			);
		}
	}
	
	function do_upload()
	{
		$config['upload_path'] = './uploads/images/partner';
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