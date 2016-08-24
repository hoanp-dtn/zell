<?php
class Model_user extends CI_Model {
	function __construct(){
        parent::__construct();
    }
	
	function total($para_where=NULL) {
		$this->db->from('utt_users');
		if(isset($para_where)&&count($para_where)){
			$this->db->where($para_where);
		}
		return $this->db->count_all_results();
	}
	
	function get($select = 'email',$para_where=NULL){
		$this->db->select($select)->from('utt_users');
		if(isset($para_where)&&count($para_where)){
			$this->db->where($para_where);
		}
		return $this->db->get()->row_array();
	}
	public function register(){
		$salt = random_string('alnum',255);
		$password = $this->input->post('password');
		$password_encode = md5(md5(md5($password).md5($salt)));
		$date_to_int = time();
		$this->db->insert('utt_users',array(
			'username' =>$this->input->post('username'),
			'email' =>$this->input->post('email'),
			'password'=>$password_encode,
			'salt'=>$salt,
			'time_create'=>$date_to_int,
			'fullname'=>$this->input->post('fullname'),
			'address'=>$this->input->post('address'),
			'phone' => $this->input->post('telephone'),
			'permit' =>$this->input->post('permit')
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
}