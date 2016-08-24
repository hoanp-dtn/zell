<?php
/**
* 
*/
class Profile_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function profile($id="")
	{
		if (isset($id) && ((int)$id > 0))
		{
			$this->db->select(PREFIX.'users.*, '.PREFIX.'brch.name as brch, '.PREFIX.'department.name_vn as department');
			$this->db->from(PREFIX.'users');
			$this->db->join(PREFIX.'brch',PREFIX.'users.br_id = '.PREFIX.'brch.id','left');
			$this->db->join(PREFIX.'department',PREFIX.'users.department_id = '.PREFIX.'department.id','left');
			$this->db->where(PREFIX.'users.id', $id);

			return $data  = $this->db->get()->result_array();
		} return array();
	}

	function checkoldpass($uid, $pass) 
	{
		if ((int)$uid > 0)
		{
			$this->db->select('*');
			$this->db->from(PREFIX.'users');
			$this->db->where('id', $uid);
			$data = $this->db->get()->result_array();
			if (!empty($data[0]))
			{
				$password = $data[0]['password'];
				$salt = $data[0]['salt'];
				$password_encode = md5(md5(md5($pass).md5($salt)));
				if ($password == $password_encode) return true;
			} else return false;
		} else return false;
	}

	function changepass($uid, $newpass)
	{
		if ((int)$uid > 0)
		{
			$salt = md5(time('Y').time('m').time('d').time('s'));
			$password = md5(md5(md5($newpass).md5($salt)));
			$this->db->where('id', $uid);
			$this->db->update(PREFIX.'users', array('password' => $password, 'salt' => $salt)); 
			return true;
		} return false;
	}

	function update($uid, $data)
	{
		if ((int)$uid > 0)
		{
			$this->db->where('id', $uid);
			$this->db->update(PREFIX.'users', $data);
			return true;
		} else return false;
	}

	function checkmail($uid, $email)
	{
		if ((int)$uid > 0)
		{
			$this->db->select('*');
			$this->db->from(PREFIX.'users');
			$this->db->where('id !=', $uid);
			$this->db->where('email', $email);
			$data = $this->db->get()->result_array();
			if (count($data) == 0) return true;
			else return false;
		} else return false;
	}
}

?>