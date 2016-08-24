<?php
class Model_Site extends MY_Model {
	
	function __construct(){
        parent::__construct();
    }

	function getSite()
	{
		$sql="select id,name,url_name from utt_site";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0)
		{
		    return $query->result_array();
		}
		return 0;
	}
	
	
	function dropdown(){
		$data = $this->db->select('id,name')->from('utt_site')->get()->result_array();
		$list[0] = '---Chọn trang cộng tác---';
		if(isset($data)&&count($data)){
			foreach($data as $key =>$value){
				$list[$value['id']]=$value['name'];
			}
			return $list;
		}
	}
	
	function getNameHeader($id)
	{
		return $this->db->select('name_header_vn,name_header_en')->from(''.PREFIX.'site')->where('id',$id)->get()->row_array();
	}
	
	function getDepartmentWithUrlSite(){
		$data = $this->db->select('url_name,name_vn,name_en,key')->FROM(''.PREFIX.'site')
		->JOIN(''.PREFIX.'department',''.PREFIX.'site.department_id = '.PREFIX.'department.id')->order_by('sort','ASC')
		->get()->result_array();
		$tmp = array();
		foreach($data as $key => $val){
			$tmp[$val['key']][] = array(
				'url_name'=>$val['url_name'], 
				'name_vn'=>$val['name_vn'],
				'name_en'=>$val['name_en']
			);
		}
		return $tmp;
	}
	
	function getDepartSiteByType($type){
		$data = $this->db->select('url_name,name_vn,name_en,key')
				->FROM(''.PREFIX.'site')
				->JOIN(''.PREFIX.'department',''.PREFIX.'site.department_id = '.PREFIX.'department.id')
				->WHERE('key', $type)
				->get()->result_array();
		return $data;
	}

    function getTemplateBySite($siteName) {
        $sql = 'SELECT t.* FROM ' . PREFIX . 'site s INNER JOIN ' . PREFIX . 'template t ON s.template_id = t.id WHERE s.url_name = "' .$siteName . '"';
        $data = $this->getRows($sql);
        return isset($data[0]) ? $data[0] : false;
    }

    function isSite($siteName = '') {
        $sql = 'SELECT * FROM ' . PREFIX . 'site s WHERE s.url_name = "' .$siteName . '"';
        $data = $this->getRows($sql);
        return isset($data[0]) ? $data[0] : false;
    }
}