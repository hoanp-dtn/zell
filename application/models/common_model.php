<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ThinhNK
 * Date: 1/22/15
 * Time: 10:59 AM
 */
class Common_Model  extends MY_Model  {

    function __construct()
    {
        parent::__construct();
    }


    function insertData($table, $data){
         $return = 0;
         if($table == '' || empty($data) || !is_array($data))
             return $return;
         $insert = $this->db->insert(PREFIX.$table, $data);
         if($insert){
             $return = $this->db->insert_id();
         }
         return $return;
    }

    function updateData($table, $data, $field, $val){
        $return = 0;
        if($table == '' || empty($data) || !is_array($data))
            return $return;
        $this->db->where($field, $val);
        $update = $this->db->update(PREFIX.$table, $data);
        if($update) $return = $val;
        return $return;
    }

    function insertBatch($table, $data){
        $return = 0;
        if($table == '' || empty($data) || !is_array($data))
            return $return;
        $this->db->insert_batch(PREFIX.$table, $data);
        return 1;

    }
    function updateBatch($table, $data, $field){
        $return = 0;
        if($table == '' || empty($data) || !is_array($data))
            return $return;
        $this->db->update_batch(PREFIX.$table, $data, $field);
        return 1;

    }

    function listOptionByType($type){
        $sql = "SELECT id, value, custom_data FROM ".PREFIX."options WHERE type_name = '$type'";
        $data = $this->getRows($sql);
        return $data;
    }

    function  getOptionByID($id){
        $sql = "SELECT * FROM ".PREFIX."options WHERE id = '$id' LIMIT 1";
        $data = $this->getRows($sql);
        return $data;
    }
    function getUserInfo($uid){
        if((int) $uid <= 0) return array();
        $sql = "select * from ".PREFIX."users where id = $uid";
        $data = $this->getRows($sql);
        return isset($data[0]) ? $data[0] : array();
    }
    function  allCity(){
        $sql = "select * from ".PREFIX."city ";
        $data = $this->getRows($sql);
        return $data;
    }

    function getPostInfo($pid){
        $sql = "select * from ".PREFIX."posts where id = $pid";
        $data = $this->getRows($sql);
        return isset($data[0]) ? $data[0] : array();
    }

    function delPost($pid, $postType){
        $sql = "select count(id) as total from ".PREFIX."posts where id = ".$pid." and post_type='".$postType."'";
        $data = $this->getRows($sql);
        if($data[0]['total'] == 1){
            $sql = "delete from ".PREFIX."posts where id = ".$pid;
            $this->exeQuery($sql);
            return true;
        }
        return false;
    }



}