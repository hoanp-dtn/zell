<?php
class Ajax extends MY_Controller{
	
	private $site_id;
    function __construct()
    {
        parent::__construct();
		$site_select = (int)$this->input->post('site_select');
		if(isset($site_select) && $site_select !=0){
			$this->session->set_userdata('site_select',$site_select);
			redirect(curPageURL());
		}
		$this->site_id = $this->session->userdata('site_select');
        $this->load->database();
    }
    function ajax_level2()
    {
		$this->load->model('admin/category_model');
		if (isset($_POST['lang']) && !empty($_POST['lang']))
		{
			$lang = $_POST['lang'];
			if (isset($lang) && !empty($lang))
			{
				$data = $this->category_model->getTitle($lang);
				$show="";
				foreach ($data as $key => $value)
				{
					$show .= "<option value=\"".$value['id']."\">".$value['title']."</option>";
				}
				echo $show;
			} else echo "Lỗi";
		}
		else echo "Lỗi! Không load được dữ liệu";
    }
    function suShow()
    {
        $this->load->model('admin/site_user_model');
        if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $id = (int)$_POST['id'];
            if (isset($id) && !empty($id))
            {
                $data['site_user'] = $this->site_user_model->getUser($id);
                $data['userdata'] = $this->site_user_model->UserBox($id);
                $data['site_id'] = $id;
                $this->load->view('backend/admin/site_user',$data);
            } else echo "Lỗi! ID";
        } else echo "Lỗi! Không load được dữ liệu";
    }

    function suUpdate()
    {
        $this->load->model('admin/site_user_model');

        if (isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['site']) && !empty($_POST['site']))
        {
            $site_id = (int)$_POST['site'];
            $user_id = (int)$_POST['user'];
            if (isset($site_id) && !empty($site_id) && isset($user_id) && !empty($user_id))
            {
                $insert = array('site_id' => $site_id,
                    'user_id' => $user_id);

                $this->site_user_model->Add($insert);

                $data['site_user'] = $this->site_user_model->getUser($site_id);
                $data['userdata'] = $this->site_user_model->UserBox($site_id);
                $data['site_id'] = $site_id;
                $data['message'] = "Thêm quản lý site thành công";
                $this->load->view('backend/admin/site_user',$data);
            } else echo "Lỗi! Không nhận được ID người dùng và ID site";
        }
        else echo "Lỗi! Không load được dữ liệu<br> Vui lòng kiểm tra lại";
    }

    function suRemove()
    {
        $this->load->model('admin/site_user_model');

        if (isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['site']) && !empty($_POST['site']))
        {
            $site_id = (int)$_POST['site'];
            $user_id = (int)$_POST['user'];
            if (isset($site_id) && !empty($site_id) && isset($user_id) && !empty($user_id))
            {
                $this->site_user_model->Remove($user_id, $site_id);

                $data['site_user'] = $this->site_user_model->getUser($site_id);
                $data['userdata'] = $this->site_user_model->UserBox($site_id);
                $data['site_id'] = $site_id;
                $data['message'] = "Hủy cấp quyền quản lý site thành công";
                $this->load->view('backend/admin/site_user',$data);
            } else echo "Lỗi! Không nhận được ID người dùng và ID site";
        }
        else echo "Lỗi! Không load được dữ liệu<br> Vui lòng kiểm tra lại";
    }
}

