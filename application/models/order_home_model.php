<?php
class Order_home_model extends MY_Model {
   function __construct(){
	   parent::__construct();
   }
   public function add($param){
		$this->db->insert('utt_order',$param);
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Đặt hàng thành công !',
				'id' =>  $this->db->insert_id()
			);
		}else{
			return array(
				'type'=>'error',
				'message' => 'Có lỗi xảy ra trong quá trình đặt hàng !'
			);
		}
	}
	
}