<?php
class Navigation_home_model extends MY_Model {
	function __construct(){
        parent::__construct();
		$this->load->model('posts_home_model');
    }
	
	function getListChild($id, $langCode){
		return $this->db->select('id, title, cate_id, url, parent_id, post_id,menu_type,
								(select utt_post.cate_id from utt_post where utt_post.id = utt_navigation.post_id) as cate_id_post, 
								(select utt_post.title from utt_post where utt_post.id = utt_navigation.post_id) as post_title')
						->from( PREFIX.'navigation')->where(array('parent_id'=>$id))->order_by('location','ASC')->get()->result_array();
	}
	
	private $listMenu = array();
	function getListMenu(&$listChild, $langCode, $link = ''){
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
			if($val['post_id']!=0 && isset($val['cate_id_post']) && $val['cate_id_post']!=0){
				$val['link'] = $this->posts_home_model->getLinkParrentCate($val['cate_id_post']).slug($val['post_title']).'-a'.$val['post_id'].'.html';
			}elseif($val['url']!=""){
				$val['link'] = $val['url'];
			}elseif($val['cate_id'] !=0){
				$pre = "n";
				if($val['menu_type'] == 1){
					$pre = 'p';
				}
				$val['link'] = $link_child.'-'.$pre.$val['id'].'.html';
			}else{
				$val['link'] = "javascript:void(0)";
			}
			$listChildChild = $this->getListChild($val['id'], $langCode);
			$this->getListMenu($listChildChild, $langCode, $link_child);
			if(!empty($listChildChild)){
				$val['children'] = $listChildChild	;
			}
			$listChild[$key] = $val;
			$this->listMenu = $listChild;
		}
		return $this->listMenu;
	}
	
	function get($param = NULL, $where = NULL, $multirow = TRUE){
		$this->db->select($param)->from(PREFIX.'navigation');
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		if($multirow){
			return $this->db->get()->result_array();
		}
		return $this->db->get()->row_array();
	}
}