<?php

/**
 * Class Model_Posts
 */
class Posts_home_model extends MY_Model {
    /**
     * @param $cateName
     * @param string $siteid
     * @param int $isTop
     * @param int $limit
     * @param string $langCode
     * @return array|bool
     */
	 private $site_id = 1;
	 
	 
    function getPostSiteAndAreaDisplay($categoryId, $siteid = '', $isTop = 0, $limit = 5, $langCode = 'vn') {
        $conditionForSite = ($siteid != '') ? ' AND  p.site_id = ' . $siteid : '';
        $sql = 'SELECT
                    p.*, c.title AS cate_name, (select n.id from utt_navigation n where p.cate_id = n.cate_id and n.site_id = '.$siteid.') as nav_id
                FROM
                    utt_post as p
                INNER JOIN utt_cate c ON p.cate_id = c.id
                WHERE c.id = "' . $categoryId . '"
				AND p.status = 1
                AND p.is_top = ' . $isTop . ' ' . $conditionForSite . '
                AND p.post_type = "news"
                AND c.type = "news"
                AND p.site_id = '.$siteid.'
                ORDER BY p.id DESC, p.time_create DESC
                LIMIT ' . $limit . '
                ';
        $data = $this->getRows($sql);
		foreach($data as $key => $val){
			if(isset($val['nav_id'])){
				$data[$key]['link'] = $this->getLinkParrentMenu($val['nav_id']);
			}else{
				$data[$key]['link'] = $this->getLinkParrentCate($val['cate_id']);
			}
			
		}	
		
		if(is_numeric($categoryId)){
			$sql = "SELECT title FROM utt_cate WHERE id = ".$categoryId;   $data1 = $this->getRows($sql);
			$data['cate_name'] = isset($data1[0]['title'])?$data1[0]['title']:'';
		}
		
        return isset($data) ? $data : false;
    }
	
	function getLinkParrentMenu($nav_id, $data = ''){
		$navigation = $this->navigation_home_model->get('id, title, title_en, parent_id', array('id' => $nav_id), false);
		if(!isset($navigation) || count($navigation) == 0){
			return NULL;
		}
		if($this->langCode == 'vn'){		
             $langCode = '';		
        }else{		
         	$langCode = "_".$this->langCode;		
        }
        $title = 'title'.$langCode;
		$titleValue = $navigation[$title] != '' ? $navigation[$title] : $navigation['title'];
		if($navigation['parent_id'] == 0){
			return slug($titleValue).'/';
		}
		return $this->getLinkParrentMenu($navigation['parent_id'],$data).slug($titleValue).'/';
	}
	function getLinkParrentCate($cate_id, $data = ''){
		$category = $this->category_home_model->get('id, title, parent_id', array('id' => $cate_id), false);
		if(!isset($category) || count($category) == 0){
			return NULL;
		}
		if($category['parent_id'] == 0){
			return slug($category['title']).'/';
		}
		return $this->getLinkParrentCate($category['parent_id'],$data).slug($category['title']).'/';
	}
	function breadcrumb($nav_id, &$data = array(), $cate_id=0){
		$navigation = $this->navigation_home_model->get('id, title, parent_id', array('id' => $nav_id), false);
		if(!isset($navigation) || count($navigation) == 0){
			return null;
		}
		if($navigation['parent_id'] == 0){
			$data[] = array(
				'title' => $navigation['title'],
				'link' => slug($navigation['title']),
				'nav_id' => $navigation['id']
			);
			return $data;
		}
		$this->breadcrumb($navigation['parent_id'],$data);
		$count = count($data);
		if($count > 0){
			$data[] = array(
				'title' => $navigation['title'],
				'link' => $data[$count-1]['link'].'/'.slug($navigation['title']),
				'nav_id' => $navigation['id']
			);
		}
		return $data;
	}
	
	function showDetail($id = 0)
	{
		$data = $this->db->select(''.PREFIX.'post.id,'.PREFIX.'post.title,'.PREFIX.'post.description, utt_post.is_top,utt_post.*,'.PREFIX.'post.image,'.PREFIX.'post.cate_id,'.PREFIX.'post.detail,'.PREFIX.'post.time_create,'.PREFIX.'post.time_update,c.title as cate_name, (select n.id from utt_navigation n where '.PREFIX.'post.cate_id = n.cate_id) as nav_id')->from(PREFIX.'post')->where(PREFIX.'post.id ',(int)$id)->join(PREFIX.'cate c',PREFIX.'post.cate_id = '.'c.id')->get()->row_array();
		$data['file'] = $this->db->select(PREFIX.'postmeta.value')->from(PREFIX.'postmeta')->where(PREFIX.'postmeta.post_id',(int)$id)->get()->result_array();
		return $data;
	}
	
	function getAllChildCate($cate_id = 0, &$result = array()){
		$array = $this->db->select('id')->from(PREFIX.'cate')->where(array('parent_id'=>$cate_id))->get()->result_array();
		foreach($array as $keyMain => $valMain){
			foreach($valMain as $keyItem => $valItem){
				$result[] = $valItem;
			}
			$this->getAllChildCate($valMain['id'],$result);
		}
		return $result;
	}
	function showPostAndRelative($post_detail,$start, $limit, $langCode = 'vn', $post_type = 'news')
	{
		$currentCateID[0] = $post_detail['cate_id'];
		$allChild = $this->getAllChildCate($post_detail['cate_id'], $currentCateID);
		$data = $this->db->select('p.*, c.title as cate_name, (select n.id from utt_navigation n where p.cate_id = n.cate_id) as nav_id')
				->from(PREFIX.'post p')
				->join('utt_cate c','c.id = p.cate_id')
				->where_in('p.cate_id', $allChild)
				->where(array(
					'p.post_type' => $post_type,
					'p.status <' => '3',
					'p.id !=' => $post_detail['id']
				))
				->order_by('p.time_create', 'DESC')
				->limit($limit,$start)->get()->result_array();
		foreach($data as $key => $val){
			if(isset($val['nav_id'])){
				$data[$key]['link'] = $this->getLinkParrentMenu($val['nav_id']);
			}else{
				$data[$key]['link'] = $this->getLinkParrentCate($val['cate_id']);
			}
		}
		return isset($data) ? $data : false;
	}
	
	function getListPost($nav_id = 0, $langCode = 'vn', $start = NULL, $limit = NULL, $type = 'news', $cate_id=0){
		$navigation = $this->navigation_home_model->get('cate_id', array('id' => $nav_id), FALSE);
		if($cate_id != 0){
			$navigation['cate_id'] = $cate_id;
			$currentCateID[0] = $navigation['cate_id'];
		}else{
			$currentCateID[0] = $navigation['cate_id'];
		}
		$allChild = $this->getAllChildCate($navigation['cate_id'], $currentCateID);
		$this->db->select('p.*, (select c.title from utt_cate c where c.id = p.cate_id) as cate_name, (select n.id from utt_navigation n where p.cate_id = n.cate_id ) as nav_id')
			->from(PREFIX.'post p')
			->where_in('p.cate_id', $allChild)
			->where(array(
				'p.post_type' => $type,
				'p.status <' => '3',
			))
			->order_by('p.time_create', 'DESC');
		if( isset($start) && isset($limit) && is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit, $start);
		}
		$data = $this->db->get()->result_array();

		foreach($data as $key => $val){
			if(isset($val['nav_id'])){
				$data[$key]['link'] = $this->getLinkParrentMenu($val['nav_id']);
			}else{
				$data[$key]['link'] = $this->getLinkParrentCate($val['cate_id']);
			}
			
			if($val['is_top'] == 1){
				$tmp = $data[$key];
				$data[$key] = $data[0];
				$data[0] = $tmp;
			}
		}
        return isset($data) ? $data : false;
	}
	function searchPost($key = '', $siteid = 0, $langCode = 'vn', $start = NULL, $limit = NULL){
		$this->db->select('p.*, c.title as cate_name, (select n.id from utt_navigation n where p.cate_id = n.cate_id and n.site_id = '.$siteid.') as nav_id')
			->from(PREFIX.'post p')
				->join('utt_cate c','c.id = p.cate_id')
			->where(array(
				'p.post_type' => 'news',
				'p.status <' => '3',
				'p.site_id' => $siteid,
			))
			->like('p.title',$key)
			->order_by('p.time_create', 'DESC');
		if( isset($start) && isset($limit) && is_numeric($start) && is_numeric($limit)){
			$this->db->limit($limit, $start);
		}
		$data = $this->db->get()->result_array();
		
		foreach($data as $key => $val){
			if(isset($val['nav_id'])){
				$data[$key]['link'] = $this->getLinkParrentMenu($val['nav_id']);
			}else{
				$data[$key]['link'] = $this->getLinkParrentCate($val['cate_id']);
			}
			
		}
        return isset($data) ? $data : false;
	}
	
	function total($nav_id = 0, $siteid = 0, $langCode = 'vn'){
		return count($this->getListPost($nav_id, $siteid, $langCode));
	}
	function showPostAndNew($siteid = 0, $limit, $langCode = 'vn'){
        $sql = 'SELECT
                    p.*, c.title as cate_name, (select n.id from utt_navigation n where p.cate_id = n.cate_id and n.site_id = '.$siteid.') as nav_id
                FROM
                    utt_post p
				INNER JOIN utt_cate c ON p.cate_id = c.id
                WHERE p.post_type = "news"
                AND p.site_id = '.$siteid.'
                AND p.status < 3
                ORDER BY p.time_create DESC, p.id DESC
                LIMIT ' . $limit . '
                ';
        $data = $this->getRows($sql);
		foreach($data as $key => $val){
			if(isset($val['nav_id'])){
				$data[$key]['link'] = $this->getLinkParrentMenu($val['nav_id']);
			}else{
				$data[$key]['link'] = $this->getLinkParrentCate($val['cate_id']);
			}
			
		}
        return isset($data) ? $data : false;
		
	}
	
	function getCateTitle($id = ''){
		$select ='SELECT utt_cate.title from utt_cate where utt_cate.id = \''.$id.'\'';
		return $this->db->query($select)->row()->title;
	}
	function get($param = NULL, $where = NULL, $multirow = TRUE){
		$this->db->select($param)->from(PREFIX.'post');
		if(isset($where) && is_array($where)){
			$this->db->where($where);
		}
		if($multirow){
			return $this->db->get()->result_array();
		}
		return $this->db->get()->row_array();
	}

	public function addViewCount($product_id){
	    if(! (bool)$this->input->cookie('view_count_cookie')){
	    	// update view count
	    	$this->db->where('id', $product_id);
			$this->db->set('view_count', '`view_count`+ 1', FALSE);
			$this->db->update('utt_post');
	    	//set cookie
			$cookie= array(
		      'name'   => 'view_count_cookie',
		      'value'  => true,
		       'expire' => 15*60,
		    );
		    $this->input->set_cookie($cookie);
	    }
	}
	public function addLoveCount($product_id){
	    if(! (bool)$this->input->cookie('love_count_cookie_'.$product_id)){
	    	// update view count
	    	$this->db->where('id', $product_id);
			$this->db->set('love_count', '`love_count`+ 1', FALSE);
			$this->db->update('utt_post');
	    	//set cookie
			$cookie= array(
		      'name'   => 'love_count_cookie_'.$product_id,
		      'value'  => true,
		       'expire' => 3600*24*30,
		    );
		    $this->input->set_cookie($cookie);
		    return "Cảm ơn bạn đã yêu thích sản phẩm này !";
	    }
	    return "Bạn đã yêu thích sản phẩm này rồi !";
	}
}