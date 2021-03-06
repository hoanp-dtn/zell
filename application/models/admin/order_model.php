<?php
class Order_model extends MY_Model {
	private $lang_code;
	function __construct(){
        parent::__construct();
		$this->lang_code = $this->session->userdata('lang_select');
    }
	
	function view($select=array(), $where=array(),$limit=NULL,$start=NULL,$order_by=NULL)
	{
		$this->db->from('utt_order')->select($select)->join('utt_customer', 'utt_order.customer_id=utt_customer.id')->join('utt_post', 'utt_order.product_id=utt_post.id');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		if(is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit, $start);
		}
		if(isset($order_by) && $order_by != NULL){
			$this->db->order_by($order_by); 
		}
		return $this->db->get()->result_array();
	}
	
	
	function dropdown($param=NULL){
		$count = $this->getcount($param);
		$data[0] = "--Chọn vị trí hiển thị--";
		for($i = 1; $i <= $count + 1; $i++){
			$data[$i] = "Số ".$i;
		}
		return $data;
	}
	function changeStatus($id){
		$order = $this->get('status',array('id'=>$id));
		$where = NULL;
		if($order['status'] == 1){
			$where = array('status'=>0);
		}elseif($order['status'] == 0){
			$where = array('status'=>1);
		}
		$this->db->update('utt_order',$where,array('id' => $id));
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Cập nhật trạng thái thành công'
			);
		}else{
			return array(
				'type'=>'error',
				'message' => 'Cập nhật trạng thái thất bại'
			);
		}
	}
	function changeUseFormRegister($id){
		$video = $this->get('use_form_register',array('id'=>$id));
		$where = NULL;
		if($video['use_form_register'] == 1){
			$where = array('use_form_register'=>0);
		}elseif($video['use_form_register'] == 0){
			$this->update(array('use_form_register'=>0),array(),true);
			$where = array('use_form_register'=>1);
		}
		$this->db->update('utt_slide',$where,array('id' => $id));
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Cập nhật hiển thị form thành công'
			);
		}else{
			return array(
				'type'=>'error',
				'message' => 'Cập nhật hiển thị form thất bại'
			);
		}
	}
	
	function update($param, $where, $bool){
		foreach($param as $key=> $val){
			 $this->db->set($key,$val,$bool);
		}
		$this->db->where($where);
		$this->db->update('utt_order');
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Sửa thành công'
			);
		}else{
			return array(
				'type'=>'error',
				'message' => 'Sửa thất bại'
			);
		}
	}
	function change($id){
		$video = $this->get('img,location,lang',array('id'=>$id));
		$file_name = $video['img'];
		$is_change_image = $this->input->post('is_change_image');
		$title = $this->input->post('title');
		$post_id = $this->input->post('post_id');
		if($is_change_image == 1){
			$images_del=$file_name;
			$path_to_file = './uploads/images/video/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		$location = $this->input->post('location');
		if($location < $video['location']){
			$this->update(array('location' => 'location +1'),array('location >=' => $location,'location <' =>$video['location'],'lang'=>$video['lang']),false);
		}
		if($location > $video['location']){
			$this->update(array('location' => 'location - 1'),array('location <=' => $location,'location >'=>$video['location'],'lang'=>$video['lang']),false);
		}
		return $this->update(array(
			'url'=>$this->input->post('url'),
			'status'=>$this->input->post('status'),
			'description'=>$this->input->post('description'),
			'location'=>$this->input->post('location'),
			'img' =>$file_name,
			'post_id' =>$post_id,
			'title' =>$title
		),
		array('id'=>$id),TRUE);
	}
	public function add(){
		$this->do_upload();
		$upload_data = $this->upload->data(); 
		$file_name =   $upload_data['file_name'];
		$location = $this->input->post('location');
		$title = $this->input->post('title');
		$post_id = $this->input->post('post_id');
		$this->update(array('location' => 'location +1'),array('location >=' => $location,'lang'=>$this->lang_code),false);
		$this->db->insert('utt_slide',array(
			'url'=>$this->input->post('url'),
			'status'=>$this->input->post('status'),
			'lang'=>$this->lang_code,
			'description'=>$this->input->post('description'),
			'location'=>$location,
			'img' =>$file_name,
			'post_id' =>$post_id,
			'title' =>$title,
			'type' => 'video'
		));
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Thêm thành công'
			);
		}
		else
		{
			return array(
				'type'=>'error',
				'message' => 'Thêm thất bại'
			);
		}
	}
	function do_upload()
	{
		$config['upload_path'] = './uploads/images/video';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '10000000';
		$config['max_width']  = '102004';
		$config['max_height']  = '76008';
		if($_FILES["userfile"]['name'] != ""){
			$config['file_name'] = time().$_FILES["userfile"]['name'];
		}else{
			$config['file_name'] = "";
		}
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
	function get($param, $where){
		$this->db->select($param)->from('utt_order');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->get()->row_array();
	}
	
	function getcount($param=NULL){
		$this->db->select('id')->from('utt_order');
		if(isset($param) && is_array($param)){
			$this->db->where($param);
		}
		return count($this->db->get()->result_array());
	}
	
	function del($param){
		
		$this->db->delete('utt_order', $param); 
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Xóa thành công'
			);
		}
		else
		{
			return array(
				'type'=>'error',
				'message' => 'Xóa thất bại'
			);
		}
	}
	
}