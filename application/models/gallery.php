<?php
class Gallery extends MY_Model {
   function __construct(){
	   parent::__construct();
   }
   
   function getGallery(){
	   $sql = 'SELECT
                p.id, p.title, p.cate_id, p.image, c.title as gallery_name, p.status, p.sort
			   FROM utt_post as p
			   JOIN utt_cate as c ON p.cate_id = c.id
			   WHERE post_type = "gallery" and c.site_id = '.$this->site['id'].'  order by p.cate_id ASC, p.sort ASC
                ';
		$data = $this->getRows($sql);
		$gallery = array();
		foreach($data as $key => $val){
			$gallery[$val['gallery_name']][] = array(
				'image' => $val['image'],
				'title' => $val['title']
			);
			if($val['status'] == 1){
				$gallery[$val['gallery_name']]['image_default'] = $val['image'];
				$gallery[$val['gallery_name']]['title_default'] = $val['title'];
			}elseif(!isset($gallery[$val['gallery_name']]['image_default'])){
				$gallery[$val['gallery_name']]['image_default'] = $gallery[$val['gallery_name']][0]['image'];
				$gallery[$val['gallery_name']]['title_default'] = $gallery[$val['gallery_name']][0]['title'];
			}
		}
		return $gallery;
   }
}