<?php
class Category_home_model extends MY_Model {
	function __construct(){
        parent::__construct();
    }
	
	function getListChild($id, $langCode, $site_id){
		return $this->db->select('id, title, cate_id, url, parent_id,post_id')->from( PREFIX.'navigation')->where(array('parent_id'=>$id,'lang' =>$langCode,'site_id' =>$site_id))->order_by('location','ASC')->get()->result_array();
	}
	
	private $listMenu = array();
	function getListMenu(&$listChild, $langCode, $site_id, $link = ''){
		if(empty($listChild)){
			return;
		}
		foreach($listChild as $key => $val){
			$link_child = $link;
			if($val['parent_id'] == 0){
				$link_child = slug($val['title']);
			}else{
				$link_child .= '/'.slug($val['title']);
			}
			$val['link'] = $link_child;
			$val['link_post'] = $val['post_id'];
			$listChildChild = $this->getListChild($val['id'], $langCode, $site_id);
			$this->getListMenu($listChildChild, $langCode, $site_id, $link_child);
			if(!empty($listChildChild)){
				$val['children'] = $listChildChild	;
			}
			$listChild[$key] = $val;
			$this->listMenu = $listChild;
		}
		return $this->listMenu;
	}
	
	function get($param = NULL, $where = NULL, $multirow = TRUE){
		$this->db->select($param)->from(PREFIX.'cate');
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		if($multirow){
			return $this->db->get()->result_array();
		}
		return $this->db->get()->row_array();
	}
}