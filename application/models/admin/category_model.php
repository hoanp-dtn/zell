<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
* Anh
*/
class Category_Model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public $result = array();
	
	function getChild($id){
		$array = $this->db->select('id')->from('utt_cate')->where(array('parent_id'=>$id))->get()->result_array();
		foreach($array as $keyMain => $valMain){
			foreach($valMain as $keyItem => $valItem){
				$this->result[] = $valItem;
			}
			$this->getChild($valMain['id']);
		}
		return $this->result;
	}
	public function getTitle($langCode, $where = NULL)
	{
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->select('id,title')->from(''.PREFIX.'cate')->where('lang',$langCode)->get()->result_array();
	}
	
	public function get($table = '' ,$filed = NULL ,$where = NULL,$start = NULL, $limit = NULL, $where_not_in = NULL){
		if(is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit, $start);
		}
		if(isset($where_not_in) && is_array($where_not_in) && count($where_not_in['arr'])){
			$this->db->where_not_in($where_not_in['field'],$where_not_in['arr']);
		}
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		return $this->db->select($filed)->from($table)->get()->result_array();
	}
	
	public function view($start,$limit,$where=NULL, $like = NULL){
		 $this->db->select(PREFIX.'cate.id,'.PREFIX.'lang.name,'.PREFIX.'cate.title,'.PREFIX.'cate.lang,'.PREFIX.'cate.type,'.PREFIX.'cate.parent_id, (select c1.title from utt_cate c1 where c1.id = utt_cate.parent_id
		 ) as parent_title')->from(''.PREFIX.'cate')->join(''.PREFIX.'lang',''.PREFIX.'cate.lang = '.PREFIX.'lang.code');
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		if(isset($like) && is_array($like)){
			$this->db->like($like['feild'], $like['value']);
		}
		return $this->db->ORDER_BY(''.PREFIX.'cate.id DESC')->limit($limit,$start)->get()->result_array();
	}
	
	public function total($where = NULL, $like = NULL) {
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		if(isset($like) && is_array($like)){
			$this->db->like($like['feild'], $like['value']);
		}
		return $this->db->from(''.PREFIX.'cate')->count_all_results();
	}
	
	function CheckID($id,$return_data = false, $site_id = NULL)
	{
		if ((int)$id>0)
		{
			$query="SELECT * FROM utt_cate WHERE id='".$id."'";
	        $data = $this->db->query($query);
			if ($data->num_rows()==1){
				if($return_data){
					return $data->row_array();
				}
				return true;
			} 
	        else return false;
    	} return false;
	}

	function add($table, $data)
	{
		$this->db->insert($table,$data);
		
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
				'message' => 'Thêm thất bại, vui lòng thử lại'
			);
		}
	}

	function edit($table, $id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data); 
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

	function getEdit($table='', $id)
	{
		$query = "SELECT * FROM ".$table." WHERE id = '".$id."'";
		$data = $this->getRows($query);
        return $data[0];
	}

	function delete($table, $id)
	{
		$this->db->where('id', $id);
		$this->db->delete($table); 
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
				'message' => 'Xóa thất bại, vui lòng thử lại'
			);
		}
	}

	function CheckCate($type, $where = NULL)
	{
		$query="SELECT title FROM utt_cate WHERE title like N'".$type."'";
		if(!is_null($where)){
			$query .= " and ".$where;
		}
        $data = $this->db->query($query);
        if ($data->num_rows()>=1) return false;
        else return true;
	}

	function CheckCateEdit($type,$id, $where = NULL)
	{
		$query="SELECT title FROM utt_cate WHERE title like N'".$type."' AND id !='".$id."'";
		if(!is_null($where)){
			$query .= " and ".$where;
		}
        $data = $this->db->query($query);
        if ($data->num_rows() >= 1) return false;
        return true;
	}
	public function dropdown($lang='vn',$site_id = NULL)
	{
		$data = $this->db->select('id,title')->from('utt_cate')->where(array('lang'=>$lang))->get()->result_array();
		$temp[0] = '--Chọn danh mục--';
		foreach($data as $key => $val){
			$temp[$val['id']] = $val['title'];
		}
		return $temp;
	}
	
	public function getcount($param){
		$this->db->select('id')->from('utt_cate');
		if(isset($param) && is_array($param)){
			$this->db->where($param);
		}
		return count($this->db->get()->result_array());
	}
}
?>