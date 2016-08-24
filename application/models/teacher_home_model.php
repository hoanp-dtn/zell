<?php
class Teacher_home_model extends MY_Model {
   function __construct(){
	   parent::__construct();
   }
   
   function getListTeacher(){
	   $sql = '
				SELECT u.* from utt_users u WHERE u.department_id = (select s.department_id from utt_site s where s.id = '.$this->site['id'].')
                ';
		$data = $this->getRows($sql);
		return $data;
   }
}