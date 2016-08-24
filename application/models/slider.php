<?php

/**
 * Class Slider
 */
class Slider extends MY_Model {
    /**
     * @param array $select
     * @param array $where
     * @param int $limit
     * @param int $start
     * @return mixed
     */
    function getSlide($select=array(), $where=array(),$limit = 5, $start = 0)
    {
        $this->db->from(PREFIX . 'slide')->select($select);
        if(isset($where) && count($where)){
            $this->db->where($where);
        }
        if(is_numeric($start) && is_numeric($limit)){
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('location', 'asc');
        $data = $this->db->get()->result_array();
		foreach($data as $key => $val){   
			if($val['post_id']!=0 && isset($val['cate_id']) && $val['cate_id']!=0){
				$data[$key]['link'] = $this->siteName.$this->posts_home_model->getLinkParrentCate($val['cate_id']).slug($val['post_title']).'-a'.$val['post_id'].'.html';
			}elseif($val['url']!=""){
				$data[$key]['link'] = $val['url'];
			}else{
				$data[$key]['link'] = "javascript:void(0)";
			}
		}
		return isset($data) ? $data : false;
    }


}