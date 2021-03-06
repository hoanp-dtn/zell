<?php
class Contact_home_model extends MY_Model {
   function __construct(){
	   parent::__construct();
   }
   public function add($param){
		$this->db->insert('utt_customer',$param);
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Thông tin của bạn đã được gửi. Chúng tôi sẽ liên hệ sớm nhất tới bạn. Xin cảm ơn !',
				'id' =>  $this->db->insert_id()
			);
		}else{
			return array(
				'type'=>'error',
				'message' => 'Có lỗi xảy ra. Xin vui lòng thực hiện lại !'
			);
		}
	}
	
}