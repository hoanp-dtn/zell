<?php
class Comment_model extends MY_Model {
	private $site_id;
	function __construct(){
        parent::__construct();
		$this->load->model('navigation_home_model');
		$this->site_id = $this->session->userdata('site_select');
    }
	
	function view($where=array(),$limit=NULL,$start=NULL,$order_by=NULL)
	{
		$this->db->from('utt_comment')->select('utt_comment.*, (select utt_post.title from utt_post where utt_post.id = utt_comment.post_id) as post_title, (select utt_post.cate_id from utt_post where utt_post.id = utt_comment.post_id) as post_cate_id, (select utt_cate.title from utt_cate where utt_cate.id = post_cate_id) as cate_name, (select n.id from utt_navigation n where n.cate_id = post_cate_id) as nav_id, (select count(cm.id) from utt_comment as cm where cm.post_id = utt_comment.post_id) as count_comment, (select u.fullname from utt_users as u where u.id = utt_comment.user_id) as fullname');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		if(is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit, $start);
		}
		if(isset($order_by) && $order_by != NULL){
			$this->db->order_by($order_by); 
		}
		$data = $this->db->get()->result_array();
		foreach($data as $key => $val){
			if(isset($val['nav_id'])){
				$data[$key]['link'] = $this->getLinkParrentMenu($val['nav_id']);
			}else{
				$data[$key]['link'] = slug($val['cate_name']).'/';
			}
		}
		return isset($data) ? $data : false;
	}
	
	function getLinkParrentMenu($nav_id, $data = ''){
		$navigation = $this->navigation_home_model->get('id, title, parent_id', array('id' => $nav_id), false);
		if(!isset($navigation) || count($navigation) == 0){
			return NULL;
		}
		if($navigation['parent_id'] == 0){
			return slug($navigation['title']).'/';
		}
		return $this->getLinkParrentMenu($navigation['parent_id'],$data).slug($navigation['title']).'/';
	}
	function changeStatus($id){
		$authentication = json_decode($this->session->userdata('authentication'),TRUE);
		$user_id = $authentication['id'];
		$comment = $this->get('status',array('id'=>$id));
		$where = NULL;
		if($comment['status'] == 1){
			$where = array(
				'status'=>0, 
				'user_id' => $user_id
			);
		}elseif($comment['status'] == 0){
			$where = array(
				'user_id' => $user_id, 
				'status'=>1
			);
		}
		$this->db->update('utt_comment',$where,array('id' => $id));
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
	
	function update($param, $where, $bool){
		foreach($param as $key=> $val){
			 $this->db->set($key,$val,$bool);
		}
		$this->db->where($where);
		$this->db->update('utt_comment');
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
		$time = time();
		return $this->update(array(
			'name'=>$this->input->post('name'),
			'status'=>$this->input->post('status'),
			'detail'=>$this->input->post('detail'),
			'email'=>$this->input->post('email'),
			'time_updated' =>$time,
		),
		array('id'=>$id),TRUE);
	}
	public function add(){
		$this->do_upload();
		$upload_data = $this->upload->data(); 
		$file_name =   $upload_data['file_name'];
		$location = $this->input->post('location');
		$this->update(array('location' => 'location +1'),array('location >=' => $location),false);
		$this->db->insert('utt_comment',array(
			'url'=>$this->input->post('url'),
			'status'=>$this->input->post('status'),
			'description'=>$this->input->post('description'),
			'location'=>$location,
			'site_id'=>$this->site_id,
			'img' =>$file_name
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
		$config['upload_path'] = './uploads/images/comment';
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
		$this->db->select($param)->from('utt_comment');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->get()->row_array();
	}
	
	function getcount($param=NULL){
		$this->db->select('id')->from('utt_comment');
		if(isset($param) && is_array($param)){
			$this->db->where($param);
		}
		return count($this->db->get()->result_array());
	}
	
	function del($param){
		$this->db->delete('utt_comment', $param); 
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