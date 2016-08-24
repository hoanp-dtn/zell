<?php
class Partner extends MY_Model {

    public function getListPostId($start =NULL,$limit=NULL,$where = NULL){
        if(isset($where) && is_array($where)){
            $this->db->where($where);
        }

        if(isset($start) && isset($limit) && is_numeric($start) && is_numeric($limit)){
            $this->db->limit($limit,$start);
        }
        return $this->db->select(
                                    PREFIX . 'post.id,' .
                                    PREFIX . 'post.title,' .
                                    PREFIX . 'post.image,'
                                )
                        ->from(PREFIX.'post')
                        ->join(PREFIX.'site',PREFIX . 'post.site_id = ' . PREFIX . 'site.id')
                        ->where('post_type','partner')
                        ->get()
                        ->result_array();
    }

    public function getPartner($start, $limit, $where=NULL){
        $list_post_id_tmp = $this->getListPostId($start,$limit,$where);
        $list_post_id = array();
        foreach($list_post_id_tmp as $key => $val){
            $list_post_id[] = $val['id'];

        }
        $list_partner = array();
        if(!empty($list_post_id)) {
            $tmp = $this->db->select(
                PREFIX . 'postmeta.post_id,' .
                PREFIX . 'postmeta.key,' .
                PREFIX . 'postmeta.value'
            )
                ->from(PREFIX . 'postmeta')
                ->where_in(PREFIX . 'postmeta.post_id', $list_post_id)
                ->get()
                ->result_array();
            $list_partner = array();
            foreach ($list_post_id_tmp as $key => $val) {
                $list_partner[$val['id']]['title'] = $val['title'];
                $list_partner[$val['id']]['image'] = $val['image'];

            }
            foreach ($tmp as $key => $val) {
                $list_partner[$val['post_id']][$val['key']] = $val['value'];

            }
        }
        return $list_partner;
    }


}