<?php
class Slide_model extends MY_Model {
	function __construct(){
        parent::__construct();
    }
	
	function view($select=array(), $where=array(),$limit=NULL,$start=NULL,$order_by=NULL)
	{
		$this->db->from('utt_slide')->select($select);
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
		$slide = $this->get('status',array('id'=>$id));
		$where = NULL;
		if($slide['status'] == 1){
			$where = array('status'=>0);
		}elseif($slide['status'] == 0){
			$where = array('status'=>1);
		}
		$this->db->update('utt_slide',$where,array('id' => $id));
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
		$slide = $this->get('use_form_register',array('id'=>$id));
		$where = NULL;
		if($slide['use_form_register'] == 1){
			$where = array('use_form_register'=>0);
		}elseif($slide['use_form_register'] == 0){
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
		$this->db->update('utt_slide');
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
		$slide = $this->get('img,location,lang',array('id'=>$id));
		$file_name = $slide['img'];
		$is_change_image = $this->input->post('is_change_image');
		$title = $this->input->post('title');
		$post_id = $this->input->post('post_id');
		if($is_change_image == 1){
			$images_del=$file_name;
			$path_to_file = './uploads/images/slide/'.$images_del;
			if($images_del!="" && file_exists($path_to_file)){
				unlink($path_to_file);
			}
			$this->do_upload();
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		$location = $this->input->post('location');
		if($location < $slide['location']){
			$this->update(array('location' => 'location +1'),array('location >=' => $location,'location <' =>$slide['location']),false);
		}
		if($location > $slide['location']){
			$this->update(array('location' => 'location - 1'),array('location <=' => $location,'location >'=>$slide['location']),false);
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
		$this->update(array('location' => 'location +1'),array('location >=' => $location),false);
		$this->db->insert('utt_slide',array(
			'url'=>$this->input->post('url'),
			'status'=>$this->input->post('status'),
			'description'=>$this->input->post('description'),
			'location'=>$location,
			'img' =>$file_name,
			'post_id' =>$post_id,
			'title' =>$title,
			'type' => 'slide'
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
		$config['upload_path'] = './uploads/images/slide';
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
		$this->db->select($param)->from('utt_slide');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->get()->row_array();
	}
	
	function getcount($param=NULL){
		$this->db->select('id')->from('utt_slide');
		if(isset($param) && is_array($param)){
			$this->db->where($param);
		}
		return count($this->db->get()->result_array());
	}
	
	function del($param){
		$slide = $this->get('img,location,lang',array('id'=>$param['id']));
		$images_del = $slide['img'];
		$path_to_file = './uploads/images/slide/'.$images_del;
		if($images_del!="" && file_exists($path_to_file)){
			unlink($path_to_file);
		}
		$this->update(array('location' => 'location - 1'),array('location >' => $slide['location']),false);
		$this->db->delete('utt_slide', $param); 
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