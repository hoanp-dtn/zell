<?php
    class Home extends MY_Controller{
        private $authentication;
        function __construct(){
            parent::__construct();
            $this->load->library('Adminlayout');
            $this->load->model('model_user');
            $this->permit->authentication();
            $lang_select = $this->input->post('lang_select');
            if(isset($lang_select) && !empty($lang_select)){
                $this->session->set_userdata('lang_select',$lang_select);
                redirect(curPageURL());
            }
        }

        public function index(){
            $this->layout->title('Trang quản trị website');
            $html = $this->adminlayout->loadTop();
            $html .= $this->adminlayout->loadMenu();
            $html .= $this->load->view('backend/admin/content',NULL,true);
            $html .= $this->adminlayout->loadFooter();
            $this->layout->view($html);
        }

        public function checklog() {
            /**
             * highly advised that you use authentification
             * before running this controller to keep the world out of your logs!!!
             * you can use whatever method you like does not have to be logs
             */
            $authentication = $this->session->userdata('authentication');
            $user = json_decode($authentication,TRUE);
            if($user['permit'] == -1) {
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $this->load->library('fire_log');
            } else {
                redirect('admin/authentication');
            }
        }
    }
?>