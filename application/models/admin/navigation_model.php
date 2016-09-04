<?php
class Navigation_model extends MY_Model {
	function __construct(){
        parent::__construct();
    }
	
	function view($lang='vn',$site_id = 0){
		$select = "
				SELECT utt_navigation.parent_id as parentid, utt_navigation.id,utt_navigation.title, utt_navigation.location, utt_navigation.url,(select utt_cate.title from utt_cate where utt_cate.id =utt_navigation.cate_id) as cattitle,(select utt_post.title from utt_post where utt_post.id =utt_navigation.post_id) as post_title ,(select k.title from utt_navigation as k where k.id =utt_navigation.parent_id) as parenttitle, utt_lang.name as lang
				FROM utt_navigation, utt_lang
				WHERE utt_navigation.lang = utt_lang.code ";
		 return $this->getRows($select);
	}
	function get($param, $where){
		$this->db->select($param)->from('utt_navigation');
		if(isset($where) && count($where)){
			$this->db->where($where);
		}
		return $this->db->get()->row_array();
	}
	public function dropdown($lang='vn',$where = array(), $where_not_in = NULL){
		if(isset($where_not_in) && is_array($where_not_in) && count($where_not_in)){
			$this->db->where_not_in($where_not_in['feild'],$where_not_in['array']);
		}
		$where['sub_nav'] = 1;
		$data = $this->db->select('id,title, parent_id')->from('utt_navigation')->where($where)->get()->result_array();
		$temp[0] = '--Chọn danh mục--';
		// foreach($data as $key => $val){
			// $temp[$val['id']] = $val['title'];
		// }
		return $data;
	}
	
	function getcount($param){
		$this->db->select('id')->from('utt_navigation');
		if(isset($param) && is_array($param)){
			$this->db->where($param);
		}
		return count($this->db->get()->result_array());
	}
	
	function dropdown_location ($param){
		$count = $this->getcount($param);
		$data[0] = "--Chọn vị trí hiển thị--";
		for($i = 1; $i <= $count + 1; $i++){
			$data[$i] = "Số ".$i;
		}
		return $data;
	}
	
	function del($param){
		$this->db->delete('utt_navigation', $param); 
	}
	function update($param, $where, $bool){
		foreach($param as $key=> $val){
			 $this->db->set($key,$val,$bool);
		}
		$this->db->where($where);
		$this->db->update('utt_navigation');
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
	function insert($param){
		$this->db->insert('utt_navigation',$param);
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => 'Thêm thành công'
			);
		}else{
			return array(
				'type'=>'error',
				'message' => 'Thêm thất bại'
			);
		}
	}
	
	public $result = NULL;
	
	function getChild($id,$lang='vn',$site_id = 0){
		$array = $this->db->select('id,location')->from('utt_navigation')->where(array('parent_id'=>$id))->get()->result_array();
		if(!count($array)){
			return;
		}
		foreach($array as $key1 => $val1){
			foreach($array as $key2 => $val2){
				if($array[$key2]['location'] > $array[$key1]['location']){
					$tmp = $array[$key2];
					$array[$key2] = $array[$key1];
					$array[$key1] = $tmp;
				}
			}
		}
		foreach($array as $key => $val){
			$this->result[] = $val['id'];
			break;
		}
		$this->getChild($this->result[count($this->result)-1],$lang);
		$s=0;
		foreach($array as $key => $val){
			$s++;
			if($s==1){
				continue;
			}
			$this->result[] = $val['id'];
			$this->getChild($val['id'],$lang);
		}
		return $this->result;
	}
	
	public $menudequy = array();
	function menudequy($id,$step='',$data = array()){
		$this->menudequy = $data;
		$array = $this->db->select('id')->from('utt_navigation')->where('parent_id',$id)->get()->result_array();
		foreach($array as $keyMain => $valMain){
			foreach($this->menudequy as $dtKey => $dtVal){
				if($dtVal['id'] == $valMain['id']){
					$this->menudequy[$dtKey]['title'] = $step.$this->menudequy[$dtKey]['title'];
				}
			}
		    $this->menudequy($valMain['id'],$step.'|-------', $this->menudequy);
		}
		$temp = array();
		if(isset($this->result) && count($this->result)){
			foreach($this->result as $keyMain => $valMain){	
			foreach($this->menudequy as $keyItem => $valItem){
				if($valItem['id'] == $valMain){
					$temp[$keyMain] = $valItem;
				}
			}
		}
		}
		
		return $temp;
	}
}