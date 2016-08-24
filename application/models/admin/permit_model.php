<?php
/**
* Anh
*/
class Permit_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getINFO($userID)
	{
		if((int)$userID > 0)
		{
			$query = "SELECT * FROM utt_users WHERE id = '".$userID."'";
			$data = $this->getRows($query);
			return isset($data[0])?$data[0]:NULL; 
		} 
		return NULL;
	}

	function getSite($userID, $siteID)
	{
		if(((int)$siteID > 0) && ((int)$userID > 0))
		{
			$query = "SELECT * FROM utt_site_user WHERE site_id = '".$siteID."' AND user_id= '".$userID."'";
			$data = $this->getRows($query);
			return isset($data[0])?$data[0]:false; 
		}
		return false;
	}
}
?>