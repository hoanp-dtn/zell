<?php
class Model_lang extends CI_Model {
	function __construct(){
        parent::__construct();
    }

	function getLang($where){
		$this->db->select('code')->from('utt_lang');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return count($this->db->get()->result_array());
	}
	
	function getAllLang()
	{
		$this->db->select('*');
		$this->db->from(PREFIX.'lang');
		return $this->db->get()->result_array();
	}

	function get($param, $where=NULL){
		$this->db->select($param)->from('utt_lang');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->get()->row_array();
	}
	
	function getcount($where = array()){
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->select('code,name')->from('utt_lang')->get()->result_array();
	}
	function dropdown(){
		$data = $this->db->select('code,name')->from('utt_lang')->get()->result_array();
		$list[0] = '-Chọn ngôn ngữ-';
		if(isset($data)&&count($data)){
			foreach($data as $key =>$value){
				$list[$value['code']]=$value['name'];
			}
			return $list;
		}
	}
	
	
}