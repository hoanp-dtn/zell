<?php

/**
* 
*/
class Permit
{
	private $CI;
	private $authentication, $uid;
	function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->model('admin/model_user');
		$this->CI->load->model('admin/model_lang');
	}

	function authentication(){
		$this->authentication = $this->CI->session->userdata('authentication');
		if(isset($this->authentication) && !empty($this->authentication)){
			$user = json_decode($this->authentication,TRUE);
			$count = $this->CI->model_user->total(array(
				'email'=>$user['email'],
				'password' => $user['password'],
				'salt' => $user['salt'],
				'id' => $user['id']
			));	
			if($count == 0){
				redirect('admin/authentication');
			}
			$this->uid = $user['id'];
		}else{
			redirect('admin/authentication');
		}
	}
	function Check($userID,$siteID)
	{
		$User = $this->CI->permit_model->getINFO($userID);
		if (!$User) {
			show_error("Vui lòng kiểm tra lại thông tin đăng nhập");
		} elseif ($User['permit']!=-1)
		{
			$Site = $this->CI->permit_model->getSite($userID, $siteID);
			if (!$Site){
				show_error("Lỗi! Bạn không có quyền truy cập vào trang này hoặc trang bạn yêu cầu không tồn tại!");
			} 
		}
	}
	function isSU($userID)
	{
		$User = $this->CI->permit_model->getINFO($userID);
		if (isset($User) && !empty($User)) 
		{
			if ($User['permit'] == -1) return true;
			else return false;
		} return false;
	}
	
	function checkSelectSite(){
		$this->CI->load->model('admin/permit_model');
		$this->CI->load->library('session');
		$lang_select_ss  = $this->CI->session->userdata('lang_select');
		if(!isset($lang_select_ss) || is_bool($lang_select_ss)){
			$language = $this->CI->Model_lang->getAllLang();
			$authentication = $this->CI->session->userdata('authentication');
			if(isset($authentication) && !empty($authentication)){
				$guser = json_decode($authentication,TRUE);
				$userID = $guser['id'];
				echo '
				<div id="show_select_site" class="modal" data-backdrop="static" data-keyboard="false">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title"><b>Vui lòng chọn một ngôn ngữ và một site để tiếp tục</b></h4>
					  </div>
					  <form method="post" action="">
					  <div class="modal-body">
					  <label>Chọn ngôn ngữ:</label>
					  <select class="form-control" name="lang_select" title="Chọn ngôn ngữ"><optgroup label="Chọn ngôn ngữ">';
				          foreach ((isset($language)?$language:array()) as $k => $val)
				          {
				            if ((isset($lang_select_ss)?$lang_select_ss:null) == $val['code'])
				            {
				              echo '<option selected value="'.$val['code'].'">'.$val['name'].'</option>';
				            } else echo '<option value="'.$val['code'].'">'.$val['name'].'</option>';
				          }
				        echo '</select>';
						  
						echo '
					  </div>
					  <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Chọn</button>
					  </div>
					  </form>
					</div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div>
				';
				 echo '<script>
					$(document).ready(function()
						{
						  $("#show_select_site").modal("show");
						});
                  </script>';
			}
		}
	}

	function getCheckPermit($permit="1") // [1:Super Admin(default)] | [2: Admin] | [3: Manager] | [4: Member] //
	{
		$p = $permit;
		if (in_array($permit, array('1', '2', '3','4')))
		{
			$p = ($permit==1)?'-1':$p;
			$p = ($permit==2)?'1':$p;
			$p = ($permit==3)?'2':$p;
			$p = ($permit==4)?'0':$p;

			$User = $this->CI->permit_model->getINFO((int)$this->uid);
			if (isset($User) && !empty($User)) 
			{
				if ( $User['permit'] == $p ) return true;
				else return false;
			} return false;
		} else return false;
	}

	function checkRedirect($page = "", $permit = "1") // [1:Super Admin(default)] | [2: Admin] | [3: Manager] | [4: Member] //
	{
		$permit = (int)$permit;
		$ck = $this->getCheckPermit($permit);
		if (!$ck){
			$this->CI->session->set_flashdata('message_flashdata',array('type'=>'error','message'=>'Bạn không đủ quyền để truy cập chức năng này'));
			redirect($page,'refresh');		
		} // IF NOT -> goto $page
	}
}

?>