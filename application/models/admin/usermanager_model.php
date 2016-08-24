<?php
/**
* AnhProduction
*/
class Usermanager_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAcc($page)
	{
		$begin = $page <= 1 ? 0 : ($page-1) * 15;
		$this->db->select("*");
		$this->db->from('utt_users');
		$this->db->where('permit !=','-1');
		$this->db->limit(15, $begin);
		$data = $this->db->get()->result_array();
		return $data;
	}

	function count()
	{
		$this->db->select("*");
		$this->db->from('utt_users');
		$this->db->where('permit !=','-1');
		$data = $this->db->get()->result_array();
		return count($data);
	}

	function checkAcc($u)
	{
		$u = (int)$u;
		$this->db->select('*');
		$this->db->from('utt_users');
		$this->db->where('id',$u);
		$this->db->where('permit !=', '-1');
		$data = $this->db->get()->result_array();
		if (!isset($data) || empty($data)) return false;
		else return true;
	}

	function getEmail($u)
	{
		$u = (int)$u;
		$email = $this->db->query("SELECT * FROM utt_users WHERE id='".$u."'")->row()->email;
		return isset($email)?$email:null;
	}

	function changePermit($u, $p)
	{
		$this->db->where('id', $u);
		$this->db->update('utt_users', array('permit' => $p));
	}

	function changeStatus($u, $s)
	{
		$this->db->where('id', $u);
		$this->db->update('utt_users', array('status' => $s));
	}

	function changepass($email, $newpass)
	{
		if (!empty($email))
		{
			$salt = md5(time('Y').time('m').time('d').time('s'));
			$password = md5(md5(md5($newpass).md5($salt)));
			$this->db->where('email', $email);
			$this->db->update('utt_users', array('password' => $password, 'salt' => $salt)); 
			return true;
		} return false;
	}

	function checkmail($email)
	{
		$this->db->select('*');
		$this->db->from(PREFIX.'users');
		$this->db->where('email', $email);
		$data = $this->db->get()->result_array();
		if (count($data) == 0) return true;
		else return false;
	}

	function checkuser($user)
	{
		$this->db->select('*');
		$this->db->from(PREFIX.'users');
		$this->db->where('username', $user);
		$data = $this->db->get()->result_array();
		if (count($data) == 0) return true;
		else return false;
	}

	function loadbr()
	{
		$this->db->select('*');
		$this->db->from(PREFIX.'brch');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function loaddep()
	{
		$this->db->select('*');
		$this->db->from(PREFIX.'department');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function add($data)
	{
		$this->db->insert(PREFIX.'users', $data);
		return true;
	}
}
?>