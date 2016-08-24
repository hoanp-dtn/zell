<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getRows($query, $multiRow = 1, $resultType = 'array') {
        $iconn = $this->db->conn_id;
        mysqli_multi_query($iconn, $query) or show_custom_error(mysqli_error($iconn).$query);
        $result = mysqli_store_result($iconn);
        $data = array();
        $function = "mysqli_fetch_" . $resultType;
        if ($multiRow)
            while ($row = $function($result)) {
                $data[] = $row;
            }
        else
            $data = $function($result);

        mysqli_free_result($result);
        if (mysqli_more_results($iconn)) {
            mysqli_next_result($iconn);
        }
        return $data;
    }

    function getRowsOnMultiQuery($query, $resultType = 'array', $con = false, $utf8 = false) {
        $data = array();
        $function = "mysqli_fetch_" . $resultType;
        $userid = $this->session->userdata('uid');
        $userid = ($userid) ? $userid : 'guest';
        if (!$utf8) {
            $utf8 = UTF8_CASTING;
        }
        if (!$con) {
            if ($utf8) {
                $this->db->simple_query('SET NAMES utf8');
            }
            $iconn = $this->db->conn_id;
        } else {
            $uc = $this->load->database($con, TRUE);
            if ($utf8) {
                $uc->simple_query('SET NAMES utf8');
            }
            $iconn = $uc->conn_id;
        }
        mysqli_multi_query($iconn, $query) or show_custom_error(mysqli_error($iconn).$query);
        $i = 0;
        while (($result = mysqli_store_result($iconn)) !== false) {
            $data[$i] = array();
            while ($row = $function($result)) {
                $data[$i][] = $row;
            }
            $i++;
            if (!mysqli_next_result($iconn))
                break;
        }

        if ($result !== false)
            mysqli_free_result($result);
        if (mysqli_more_results($iconn)) {
            mysqli_next_result($iconn);
        }
        return $data;
    }

    function exeQuery($query) {
        $iconn = $this->db->conn_id;
        $userid = $this->session->userdata('uid');
        $userid = ($userid) ? $userid : 'guest';
        $result = mysqli_multi_query($iconn, $query) or show_custom_error(mysqli_error($iconn).$query);
        if (mysqli_more_results($iconn)) {
            mysqli_next_result($iconn);
        }
        return $result;
    }

    function execQuery($query, $resultType = 'array', $con = false, $utf8 = false) {
        $data = array();
        $function = "mysqli_fetch_" . $resultType;
        $userid = $this->session->userdata('uid');
        $userid = ($userid) ? $userid : 'guest';
        if (!$utf8) {
            $utf8 = UTF8_CASTING;
        }
        if (!$con) {
            if ($utf8) {
                $this->db->simple_query('SET NAMES utf8');
            }
            $iconn = $this->db->conn_id;
        } else {
            $uc = $this->load->database($con, TRUE);
            if ($utf8) {
                $uc->simple_query('SET NAMES utf8');
            }
            $iconn = $uc->conn_id;
        }
        mysqli_multi_query($iconn, $query) or show_custom_error(mysqli_error($iconn).$query);
        $i = 0;
        while (($result = mysqli_store_result($iconn)) !== false) {
            $data[$i] = array();
            while ($row = $function($result)) {
                $data[$i][] = $row;
            }
            $i++;
            if (!mysqli_next_result($iconn))
                break;
        }

        if ($result !== false)
            mysqli_free_result($result);
        if (mysqli_more_results($iconn)) {
            mysqli_next_result($iconn);
        }
        return $data;
    }
	
	function _get($select='',$table='',$para_where=NULL){
		return $this->db->select($select)->from($table)->where($para_where)->get()->row_array();
	}
	
	function _add($table='',$data=NULL,$messages=NULL){
		$this->db->insert($table,$data);
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message' => isset($messages['successful'])?$messages['successful']:'Thêm thành công'
			);
		}
		else
		{
			return array(
				'type'=>'error',
				'message' => isset($messages['error'])?$messages['error']:'Thao tác thất bại vui lòng thử lại sau!'
			);
		}
	}
	
	function _update($table='',$data=NULL,$para_where=NULL,$filed_where_in='',$para_where_in=NULL,$messages=NULL){
		if(!empty($field_where_in)&&isset($para_where_in)&&is_array($para_where_in)){
			$this->db->where_in($filed_where_in,$para_where_in);
		}
		if(isset($para_where)&&is_array($para_where)){
			$this->db->where($para_where);
		}
		$this->db->update($table,$data);
		$flag = $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message'=>isset($messages['successful'])?$messages['successful']:'Cập nhật thành công!'
			);
		}
		else {
			return array(
				'type' => 'error',
				'message' => isset($messages['error'])?$messages['error']:'Thao tác thất bại vui lòng thử lại sau!'			
			);
		}
	}
	
	function _delete($table='',$para_where=NULL,$messages=NULL){
		$this->db->delete($table,$para_where);
		$flag= $this->db->affected_rows();
		if($flag>0){
			return array(
				'type'=>'successful',
				'message'=>isset($messages['successful'])?$messages['successful']:'Xóa thành công!'
			);
		}
		else {
			return array(
				'type' => 'error',
				'message' => isset($messages['error'])?$messages['error']:'Thao tác thất bại vui lòng thử lại sau!'			
			);
		}
	}
	
}