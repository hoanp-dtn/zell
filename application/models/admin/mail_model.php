<?php
/**
* AnhProduction
*/
class Mail_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getMail($id)
	{
		$id = (int)$id;
		if ($id > 0)
		{
			$this->db->select('email');
			$this->db->from(PREFIX.'users');
			$this->db->where('department_id',$id);
			$data = $this->db->get()->result_array();
			return $data;
		} else return false;
	}

	function checkdID($id)
	{
		$id = (int)$id;
		if( $id > 0)
		{
			$this->db->select('*');
			$this->db->from(PREFIX.'department');
			$this->db->where('id', $id);
			$data = $this->db->get()->result_array();
			return ((isset($data)&&!empty($data))?true:false);
		} else return false;
	}

	function checkPost($id)
	{
		$id = (int)$id;
		if( $id > 0)
		{
			$this->db->select('*');
			$this->db->from(PREFIX.'post');
			$this->db->where('id', $id);
			$data = $this->db->get()->result_array();
			return ((isset($data)&&!empty($data))?true:false);
		} else return false;
	}

	function getTitle($id='')
	{
		$id = (int)$id;
		if ($id > 0)
		{
			$data = $this->db->query("SELECT * FROM ".PREFIX."post WHERE id='".$id."'")->row();
			$title = (isset($data)&&!empty($data)?($data->title):null);
			return $title;
		} else return null;
	}

	function getDetail($id='')
	{
		$id = (int)$id;
		if ($id > 0)
		{
			$data = $this->db->query("SELECT * FROM ".PREFIX."post WHERE id='".$id."'")->row();
			$detail = (isset($data)&&!empty($data)?($data->detail):null);
			return $detail;
		} else return null;
	}
}

?>