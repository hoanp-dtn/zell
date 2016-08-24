<?php
/**
 * 
 */
 class Site_model extends MY_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 		$this->load->helper('url');
 	}
	
	function getDescAndKeywordSite($id=0){ 
		return $this->_get('id,desc,keyword','utt_site',array('id'=>(int)$id));
	}
	
 	function view($table='',$field='*')
	{
		$query = "SELECT ".$field." FROM ".$table;
		$data = $this->getRows($query);
        return $data;
	}

	function CheckID($id)
	{
		if ((int)$id>0)
		{
			$query="SELECT * FROM utt_site WHERE id='".$id."'";;
	        $data = $this->db->query($query);
	        if ($data->num_rows()==1) return true;
	        else return false;
    	} return false;
	}

	function getAll()
	{
		$query = "SELECT utt_site.*, (select utt_department.name_vn from utt_department where utt_department.id = utt_site.department_id) as department_name FROM utt_site";
		$data = $this->db->query($query)->result_array();
        return $data;
	}

	function getByID($id)
	{
		$query = "SELECT A.id,A.title, A.template_id, A.name, A.url_name, A.logo, A.banner, A.footer_info, A.desc, (select utt_department.name_vn from utt_department where utt_department.id = A.department_id) as department_name FROM utt_site A INNER JOIN utt_site_user B ON A.id=B.site_id WHERE B.user_id = '".$id."'";
		$data = $this->db->query($query)->result_array();
        return $data;
	}

	function add($table, $data)
	{
		$this->db->insert($table,$data);

	}

	function edit($table, $id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data); 
	}

	function getEdit($table='', $id)
	{
		$query = "SELECT * FROM ".$table." WHERE id = '".$id."'";
		$data = $this->getRows($query);
        return (isset($data[0])) ? $data[0] : array();
	}
	function CheckName($name)
	{
		$query="SELECT * FROM utt_site WHERE name ='".$name."'";
        $data = $this->db->query($query);
        if (isset($data)||!empty($data))
		{
			if($data->num_rows()>=1) return false;
			else return true;
		} else return true;
	}
	function Checkurlname($urlname)
	{
		$query="SELECT * FROM utt_site WHERE name ='".$urlname."'";
        $data = $this->db->query($query);
        if (isset($data)||!empty($data))
		{
			if($data->num_rows()>=1) return false;
			else return true;
		} else return true;
	}
	function CheckNameEdit($name,$id)
	{
		//$name=$this->input->post('site_name');
		if(isset($name)&&!empty($name)){
		$query="SELECT * FROM utt_site WHERE name ='".$name."'AND id<> '".$id."'";
		$data = $this->db->query($query);
		}
		if (isset($data)||!empty($data))
		{
			if($data->num_rows()>=1) return false;
			else return true;
		} else return true;
	}
	function CheckurlnameEdit($urlname,$id)
	{
		if(isset($urlname)&&!empty($urlname)){
		$query="SELECT * FROM utt_site WHERE url_name ='".$urlname."' AND id<> '".$id."' ";
		$data =$this->db->query($query);
		}
		if (isset($data)||!empty($data))
		{
			if($data->num_rows()>=1) return false;
			else return true;
		} else return true;
	}
	
	function CheckDepartmentEdit($department_id,$id){
		if(isset($department_id)&&!empty($department_id)){
		$query="SELECT department_id FROM utt_site WHERE department_id ='".$department_id."' AND id<> '".$id."' ";
		$data =$this->db->query($query);
		}
		if (isset($data)||!empty($data))
		{
			if($data->num_rows()>=1) return false;
			else return true;
		} else return true;
	}
	
	function CheckDepartment($department_id)
	{
		$query="SELECT department_id FROM utt_site where department_id = '".$department_id."'";
        $data = $this->db->query($query);
        if (isset($data)||!empty($data))
		{
			if($data->num_rows()>=1) return false;
			else return true;
		} 
		else return true;
	}
	
	function getLogo($id)
	{
		$name = $this->db->query("SELECT * FROM utt_site WHERE id='".$id."'")->row()->logo;
		return (isset($name)?$name:null);
	}

	function getBanner($id)
	{
		$name = $this->db->query("SELECT * FROM utt_site WHERE id='".$id."'")->row()->banner;
		return (isset($name)?$name:null);
	}
}
 ?>