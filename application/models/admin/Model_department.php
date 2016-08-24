<?php
class Model_department extends MY_Model {
	
	function __construct(){
        parent::__construct();
		$this->load->helper('common_helper');
    }
	
	public function get($id){
		return $this->_get('name_en,name_vn,key',''.PREFIX.'department',array('id' => $id));
	}
	
	public function checkName($where = NULL)
	{
		$this->db->select('name_vn,name_en')->from(''.PREFIX.'department');
		if(isset($where)&&!empty($where))
		{
			$this->db->where('id != ',$where);
		}
		return $this->db->get()->result_array();
	}
	
	public function view($start,$limit){
		return $this->db->select('id,name_en,name_vn,key')->from(''.PREFIX.'department')->ORDER_BY(''.PREFIX.'department.id DESC')->limit($limit,$start)->get()->result_array();
	}
	
	public function total() {
		return $this->db->from(''.PREFIX.'department')->count_all_results();
	}
	
	public function del($id = 0){
		return $this->_delete(''.PREFIX.'department',array('id'=>$id));
	}
	
	public function edit($id){
		$key = getSaveSqlStr($this->input->post('key'));
		$data = array(
			'name_vn' => getSaveSqlStr($this->input->post('name_vn')),
			'name_en' => getSaveSqlStr($this->input->post('name_en')),
			'key' => $key
		);
		return $this->_update(''.PREFIX.'department',$data,array('id'=>$id));
	}
	
	function add() {
		$key = getSaveSqlStr($this->input->post('key'));
		$data = array(
			'name_vn' => getSaveSqlStr($this->input->post('name_vn')),
			'name_en' => getSaveSqlStr($this->input->post('name_en')),
			'key' => $key
		);
		return $this->_add(''.PREFIX.'department',$data,'');
	}
	function dropdown(){
		$data = $this->db->select('id,name_vn')->from(''.PREFIX.'department')->get()->result_array();
		$list[0] = '-- Chọn đơn vị --';
		if(isset($data)&&count($data)){
			foreach($data as $key =>$value){
				$list[$value['id']] = $value['name_vn'];
			}
			return $list;
		}
	}
}