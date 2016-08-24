<?php
class Login_model extends MY_Model {
	
	function Login_model() {
		parent::__construct ();
	}
	
	function login_check( $us = '', $pw = '' ) {
		$data = array ();
		$query = $this->db->query("SELECT * FROM  ".PREFIX."users WHERE `username` = '$us' AND `password` = '$pw'  LIMIT 1 ");
		if ( $query->num_rows () > 0 ) 
			$data = $query->row_array();
		return $data;
	}	
	
	
}
?>