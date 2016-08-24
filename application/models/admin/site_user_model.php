<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
* Anh
*/
class Site_User_Model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getUser($id)
	{
		$query = "SELECT * FROM utt_site_user INNER JOIN utt_users ON utt_site_user.user_id = utt_users.id WHERE utt_site_user.site_id = '".$id."' AND permit = '2'";
		$data = $this->getRows($query);
		return $data;
	}

	function UserBox($id)
	{
		$query = "SELECT * FROM utt_users WHERE permit = '2' AND id NOT IN (SELECT user_id FROM utt_site_user WHERE site_id = '".$id."')";
		$data = $this->getRows($query);
		return $data;
	}

	function Add($data)
	{
		$this->db->insert('utt_site_user',$data);

	}

	function Remove($user,$site)
	{
		$query = "DELETE FROM `utt_site_user` WHERE `user_id`='".$user."' AND `site_id`='".$site."'";
		$this->db->query($query);
	}

	function Info($user, $site)
	{
		$query="SELECT t2.username AS username, t3.name AS sitename FROM utt_site_user t1 INNER JOIN utt_users t2 ON t1.user_id = t2.id INNER JOIN utt_site t3 ON t1.site_id = t3.id  WHERE t1.user_id='".$user."' AND t1.site_id='".$site."'";
        $data = $this->db->query($query);
        return $data;
	}

	function CheckAdd($user, $site)
	{
		$query="SELECT * FROM utt_site_user WHERE user_id='".$user."' AND site_id='".$site."'";
        $data = $this->db->query($query);
        if ($data->num_rows()>=1) return false;
        else return true;
	}
}
?>