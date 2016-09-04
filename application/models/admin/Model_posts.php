<?php
class Model_posts extends MY_Model {
	function __construct(){
        parent::__construct();
    }
	function delete_files($array){
		$data = array();
		if(isset($array) && is_array($array) && count($array)){
			$data = $this->db->select('id, value')->from('utt_postmeta')->where(array('post_id'=>0,'key'=>'file'))->where_not_in('id',$array)->get()->result_array();
		}else{
			$data = $this->db->select('id, value')->from('utt_postmeta')->where(array('post_id'=>0,'key'=>'file'))->get()->result_array();
		}
		if(count($data)){
			foreach($data as $key => $val){
				$path_to_file = './uploads/files/'.$val['value'];
				$path_to_file2 = './uploads/files/thumb__'.$val['value'];
				if(file_exists($path_to_file)){
					unlink($path_to_file);
				}
				if(file_exists($path_to_file2)){
					unlink($path_to_file2);
				}
				$this->db->delete('utt_postmeta',array('id'=> $val['id']));
			}
		}
	}
	function get_post($id=0){ 
		return $this->_get('id,cate_id,status,time_create,is_top,title,lang,description,image,detail,price, price_old','utt_post',array('id'=>(int)$id));
	}
	
	function get($param, $where = NULL,$multirow = false,$like = NULL){
		$this->db->select($param)->from('utt_post');
		
		if(isset($like) && is_array($like)){
			$this->db->like($like['feild'],$like['val']);
		}
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		if($multirow){
			return $this->db->get()->result_array();
		}
		return $this->db->get()->row_array();
	}
	
	public function count_recycle($where = NULL,$search = NULL){
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->from('utt_post')->where('status = ','3')->like('utt_post.title',$search)->count_all_results();
	}
	
	public function view($start,$limit,$key,$lang,$cate = '', $post_type = 'news'){
		if(isset($cate)&&!empty($cate)){
			$this->db->where(''.PREFIX.'post.cate_id',$cate);
		}
		return $this->db->select('utt_post.id,utt_post.title,utt_post.description,utt_post.detail,utt_post.image,utt_post.status,utt_post.time_create,utt_post.time_update,(select utt_cate.title from utt_cate where utt_cate.id = utt_post.cate_id) as catetitle')->from('utt_post')->where('utt_post.status > ','0')->where('utt_post.status <','3')->where ('post_type',$post_type)->like(PREFIX.'post.title',$key)->ORDER_BY('utt_post.id DESC')->limit($limit,$start)->get()->result_array();
	}
	
	public function view_recycle($start,$limit,$key,$lang,$cate = '', $post_type = 'news'){
		if(isset($cate)&&!empty($cate)){
			$this->db->where(''.PREFIX.'post.cate_id',$cate);
		}
		return $this->db->select('utt_post.id,utt_post.title,utt_post.description,utt_post.detail,utt_post.image,utt_post.status,utt_post.time_create,utt_post.time_update,(select utt_cate.title from utt_cate where utt_cate.id = utt_post.cate_id) as catetitle')->from('utt_post')->where('utt_post.status','3')->where ('post_type',$post_type)->like(PREFIX.'post.title',$key)->ORDER_BY('utt_post.id DESC')->limit($limit,$start)->get()->result_array();
	}
	
	public function getStatus($id = 0){
		return $this->db->select('status')->from('utt_post')->where('id',(int)$id)->get()->row_array();
	}
	public function changeStatus($id = 0){
		$status = $this->getStatus($id);
		$where = NULL;
		if($status['status'] == 1){
			$where = array('status'=>2);
		}
		elseif($status['status'] == 2){
			$where = array('status'=>1);
		}
		else {
			$where = array('status' => 1);
		}
		$this->db->update('utt_post',$where,array('id' => $id));
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Sửa trạng thái thành công'
			);
		}
		else
		{
			return array(
				'type'=>'error',
				'message' => 'Sửa thất bại, vui lòng thử lại'
			);
		}
	}
	
	public function del($id = 0){
		return $this->_delete('utt_post',array('id'=>$id));
	}
	
	public function total($where = NULL,$search = NULL) {
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->from('utt_post')->where('utt_post.status < ','3')->where('utt_post.status > ','0')->like('utt_post.title',$search)->count_all_results();
	}
	function add($current_file, $post_type = 'news') {
		$date = $this->input->post('datepost');
		$date_to_int = empty($date)?(time()): strtotime($date);
		$this->do_upload();
		$upload_data = $this->upload->data(); 
		$file_name =   $upload_data['file_name'];
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$data = array(
			'status'=>$this->input->post('status'),
			'cate_id' =>$this->input->post('getTitle'),
			'time_create' => $date_to_int,
			'post_type' => $post_type,
			'user_id' =>$user_id,
			'title' =>$this->input->post('title'),
			'description' => str_replace("\n","",getSaveSqlStr( $this->input->post('description') )),
			'detail' => htmlspecialchars( $this->input->post('detail', false) ),
			'image' => $file_name,
			'is_top' => getSaveSqlStr($this->input->post('is_top'))
		);

	    $this->db->insert('utt_post',$data);
		$flag = $this->db->affected_rows();
		if($flag>0){
			$result = array(
				'type'=>'successful',
				'message' => 'Thêm thành công'
			);
		}
		else
		{
			$result = array(
				'type'=>'error',
				'message' => 'Thêm thất bại, vui lòng thử lại'
			);
		}
		$insert_post_id = $this->db->insert_id();
		$this->db->flush_cache();
		if(isset($current_file) && is_array($current_file) && count($current_file)){
			$data = array();
			foreach($current_file as $key => $val){
				$data[] = array(
					'id' => $val,
					'post_id' => $insert_post_id
				); 
			}
			$this->db->update_batch('utt_postmeta', $data, 'id'); 
		}
		return $result;
	}
	function add_product($current_file, $post_type = 'news') {
		$date = $this->input->post('datepost');
		$date_to_int = empty($date)?(time()): strtotime($date);
		$this->do_upload();
		$upload_data = $this->upload->data(); 
		$file_name =   $upload_data['file_name'];
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$data = array(
			'status'=>$this->input->post('status'),
			'cate_id' =>$this->input->post('getTitle'),
			'price' =>$this->input->post('price'),
			'price_old' =>$this->input->post('price_old'),
			'time_create' => $date_to_int,
			'post_type' => $post_type,
			'user_id' =>$user_id,
			'title' =>$this->input->post('title'),
			'description' => str_replace("\n","",getSaveSqlStr( $this->input->post('description') )),
			'detail' => htmlspecialchars( $this->input->post('detail', false) ),
			'image' => $file_name,
			'is_top' => getSaveSqlStr($this->input->post('is_top'))
		);

	    $this->db->insert('utt_post',$data);
		$flag = $this->db->affected_rows();
		if($flag>0){
			$result = array(
				'type'=>'successful',
				'message' => 'Thêm thành công'
			);
		}
		else
		{
			$result = array(
				'type'=>'error',
				'message' => 'Thêm thất bại, vui lòng thử lại'
			);
		}
		$insert_post_id = $this->db->insert_id();
		$this->db->flush_cache();
		if(isset($current_file) && is_array($current_file) && count($current_file)){
			$data = array();
			foreach($current_file as $key => $val){
				$data[] = array(
					'id' => $val,
					'post_id' => $insert_post_id
				); 
			}
			$this->db->update_batch('utt_postmeta', $data, 'id'); 
		}
		return $result;
	}
	
	function update($tenbang, $param, $where){
		$this->db->update($tenbang,$param,$where);
	}
	
	function getImage($id){
		$select ='SELECT image from utt_post where id = \''.$id.'\'';
		return $output = $this->db->query($select)->row()->image;
	}
	
	
	function edit($id, $post_type = 'news'){
		$post = $this->get('image',array('id'=>$id));
		$file_name = $post['image'];
		$is_change_image = $this->input->post('is_change_image');
		if($is_change_image == 1){
			$images_del=$file_name;
			$path_to_file = './uploads/images/news/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		$date = $this->input->post('datepost');
		$date_to_int = empty($date)?(time()):strtotime($date);
		$description = getSaveSqlStr( $this->input->post('description'));
		$data = array(
			'title' => getSaveSqlStr( $this->input->post('title') ),
			'description' => str_replace('\n','',$description ),
			'detail' => htmlspecialchars( $this->input->post('detail', false) ),
			'image' => $file_name,
			'status' => getSaveSqlStr( $this->input->post('status') ),
			'cate_id' => getSaveSqlStr( $this->input->post('getTitle') ),
			'time_create' => $date_to_int,
			'time_update' => time(),
			'post_type' => $post_type,
			'is_top' => getSaveSqlStr( $this->input->post('is_top') )
		);
		return $this->_update('utt_post',$data,array('id'=>$id));
	}
	function edit_pr($id, $post_type = 'news'){
		$post = $this->get('image',array('id'=>$id));
		$file_name = $post['image'];
		$is_change_image = $this->input->post('is_change_image');
		if($is_change_image == 1){
			$images_del=$file_name;
			$path_to_file = './uploads/images/news/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		$date = $this->input->post('datepost');
		$date_to_int = empty($date)?(time()):strtotime($date);
		$description = getSaveSqlStr( $this->input->post('description'));
		$data = array(
			'title' => getSaveSqlStr( $this->input->post('title') ),
			'description' => str_replace('\n','',$description ),
			'detail' => htmlspecialchars( $this->input->post('detail', false) ),
			'image' => $file_name,
			'status' => getSaveSqlStr( $this->input->post('status') ),
			'cate_id' => getSaveSqlStr( $this->input->post('getTitle') ),
			'time_create' => $date_to_int,
			'time_update' => time(),
			'post_type' => $post_type,
			'is_top' => getSaveSqlStr( $this->input->post('is_top') ),

			'price' =>$this->input->post('price'),
			'price_old' =>$this->input->post('price_old'),
		);
		return $this->_update('utt_post',$data,array('id'=>$id));
	}
	
	function do_upload()
	{
		$config['upload_path'] = './uploads/images/news';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000000';
		$config['max_width']  = '10240';
		$config['max_height']  = '76800';
                $config['encrypt_name'] = 'true';
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
	
	function changeDefaultGallery($id = 0, $cate_id = 0){
		$status = $this->getStatus($id);
		$where = NULL;
		if($status['status'] == 0){
			$this->db->update('utt_post',array('status'=> 0),array('post_type'=>'gallery','cate_id'=>$cate_id));
			$where = array('status'=>1);
		}elseif($status['status'] == 1){
			$where = array('status'=>0);
		}else{
			$where = array('status'=>0);
		}
		$this->db->update('utt_post',$where,array('id' => $id));
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Sửa thành công'
			);
		}
		else
		{
			return array(
				'type'=>'error',
				'message' => 'Sửa thất bại, vui lòng thử lại'
			);
		}
	}
	function recyle($id){
		$date_to_int = time();
		$this->db->where_in('id',(int)$id)->update('utt_post',array(
			'status'=>'3',
			'time_update' => $date_to_int,
		));
		$flag = $this->db->affected_rows();
		if($flag>0) {
			return array(
				'type'=>'successful',
				'message'=>'Xóa thành công'
			);
		}
		else {
			return array(
				'type'=>'error',
				'message'=>'Thao tác thất bại'
			);
		}
	}

	function getDepartment()
	{
		$this->db->select('*');
		$this->db->from(PREFIX.'department');
		$data = $this->db->get()->result_array();
		return !empty($data)?$data:array();
	}
}