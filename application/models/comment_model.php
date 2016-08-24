<?php
class Comment_model extends MY_Model {
   function __construct(){
	   parent::__construct();
   }
   
	function add($data){
		$this->db->insert(PREFIX.'comment',$data);
		$flag = $this->db->affected_rows();
		if($flag>0){
			return 'Bình luận của bạn đã được gửi.';
		}
		return 'Lỗi không gửi được bình luận. Xin thử lại';
	}
	function getListComment($post_id){
		return $this->db->select('*')->from('utt_comment')->where(array('post_id'=>$post_id,'status'=>1))->get()->result_array();
	}
}