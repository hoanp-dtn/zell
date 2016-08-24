<?php

/**
 * Class Ads
 */
class Ads extends MY_Model {
    /**
     * @param $start
     * @param $limit
     * @param array $where
     * @return mixed
     */
    public function getListPostAds($start, $limit, $where = array()){
        if(!empty($where)){
            $this->db->where($where);
        }

        if(isset($start) && isset($limit) && is_numeric($start) && is_numeric($limit)){
            $this->db->limit($limit,$start);
        }
        return $this->db->select('id, image, description')
                        ->from( PREFIX . 'post')
                        ->where('post_type','ads')
                        ->where('status', 1)
                        ->get()
                        ->result_array();
    }

    /**
     * @param int $start
     * @param int $limit
     * @param array $where
     * @return array
     */
    public function getAds($start = 0, $limit = 5, $where= array()){
        $list_post_id_tmp = $this->getListPostAds($start,$limit,$where);
        $list_post_id = array();
        foreach($list_post_id_tmp as $key => $val){
            $list_post_id[] = $val['id'];
        }
        if(!empty($list_post_id)) {

            $tmp = $this->db->select('post_id, key, value')
                            ->from( PREFIX . 'postmeta')
                            ->where_in('post_id',$list_post_id)
                            ->get()
                            ->result_array();
            $list_ads = array();
            $result = array();
            foreach($list_post_id_tmp as $key => &$val) {
                $list_ads[$val['id']] = $val;
            }

            foreach($tmp as $val) {
                $list_ads[$val['post_id']][$val['key']] = $val['value'];
            }
            foreach($list_ads as $val) {
                if(isset($val['adzone'])) {
                    $result[$val['adzone']][] = $val;
                }
            }

            return $result;
        }
        return array();
    }

}