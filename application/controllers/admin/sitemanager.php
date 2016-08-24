<?php
/**
 * 
 */
 class Sitemanager extends MY_Controller
 {
    private $data, $userID,$site_id;

    function __construct()
    {
        parent::__construct ();
        $this->load->helper(array('form', 'url','My_string_helper'));
        $this->site_id = $this->session->userdata('site_select');
        $this->load->model('admin/site_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/model_template');
        $this->load->model('admin/Model_department');
        $this->load->library('Adminlayout');
        $this->load->model('model_user');
        $this->load->helper("url");
        $this->load->library('upload');
        $this->permit->authentication();
    }

    public function view()
    {
        $udata = json_decode($this->session->userdata('authentication'),true);
        $userID = $udata['id'];
        if($this->permit->isSU($userID))
            {
                $data['permit'] = true;
                $data['site'] = $this->site_model->getAll();
            }
        else
            {
                $data['permit'] = null;
                $data['site'] = $this->site_model->getByID($userID);
            }
        $data['active'] = array('site','site/view');
        $html = $this->adminlayout->loadTop();
        $html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
        $html .= $this->load->view('backend/admin/site/site_view',$data,true);
        $html .= $this->adminlayout->loadFooter();
        //Show Layout
        $this->layout->title('Quản lí site');
        $this->layout->view($html);
    }
    public function add()
    {
        if (isset($_POST) && !empty($_POST))
        {
            if(isset($_FILES['file_logo']) && !empty($_FILES['file_logo']))
            {
                $uploadlg = $this->uploadLogo('file_logo');
                $logo = ($uploadlg['success'])? $uploadlg['upload_data']['file_name']:null;
            } else $logo = null;
            if (isset($_FILES['file_banner']) && !empty($_FILES['file_banner']))
            {
                $uploadbn = $this->upload('file_banner');
                $banner = ($uploadbn['success'])? $uploadbn['upload_data']['file_name']:null;
            } else $banner = null;

            $footer_info = getSaveSqlStr(strip_tags($this->input->post('footer_info')));
            $template_id = (int)$this->input->post('site_template_id');
            $name_vn = getSaveSqlStr(strip_tags($this->input->post('name_vn')));
            $name_en = getSaveSqlStr(strip_tags($this->input->post('name_en')));
            $url_name = getSaveSqlStr(strip_tags(slug($this->input->post('site_url_name'))));
            $title = getSaveSqlStr(strip_tags($this->input->post('site_title')));
            $desc = getSaveSqlStr(strip_tags($this->input->post('site_desc')));
            $keyword = getSaveSqlStr(strip_tags($this->input->post('site_keyword')));
            $department_id = (int)getSaveSqlStr(strip_tags($this->input->post('dept')));
            $settingPositionHomePage = $this->getDataSaveSettingContent();

            if (!isset($template_id)||empty($template_id))
            {
                $error['template_id_error'] = ' Chưa chọn Mẫu Template!';
            }
            if (!isset($url_name)||empty($url_name))
            {
                $error['url_name_error'] = ' Chưa nhập Địa chỉ/URL của trang!';
            }
            if (!$this->site_model->Checkurlname($url_name))
            {
                $error['url_name_error'] = ' Địa chỉ/URL của trang đã tồn tại!';
            }
            if(!isset($department_id)||empty($department_id))
            {
                $error['csk'] = "Chưa chọn Khoa/Phòng Ban!";
            }
            if ($department_id != 0 && !$this->site_model->CheckDepartment($department_id))
            {
                $error['url_name_error1'] = ' Phòng ban này đã có site riêng.';
            }
            if(!isset($title)||empty($title))
            {
                $error['title'] = "Chưa nhập Tiêu đề trang!";
            }
            if(!isset($error)&&empty($error))
            {

                $insert = array(
                                'template_id'=>$template_id,
                                'name_header_vn'=>$name_vn,
                                'name_header_en'=>$name_en,
                                'url_name'=>$url_name,
                                'title'=>$title,
                                'logo'=>$logo,
                                'banner'=>$banner,
                                'footer_info'=>$footer_info,
                                'desc'=>$desc,
                                'keyword' => $keyword,
                                'department_id' => $department_id,
                                'position_display' => $settingPositionHomePage
                );
                $this->site_model->add('utt_site',$insert);
                $data['site_message']='Thêm thành công';
            } else $data['message_error'] = $error;

        }

        $data['list_department'] = $this->Model_department->dropdown();
        $data['template'] = $this->site_model->view('utt_template');
        $data['keyword'] = "đại học công nghệ gtvt, tuyển sinh đại học, đhcngtvt, đh công nghệ gtvt, tuyển sinh 2015, tuyển sinh liên thông, tư vấn tuyển sinh, đh công nghệ gtvt";
        $data['active'] = array('site','site/add');

        $html = $this->adminlayout->loadTop();
        $html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
        $html .= $this->load->view('backend/admin/site/site_add_view',$data,true);

        $blockDetail = 'Vui lòng chọn template!';
        $this->layout->addreplace('layout_setting_home_page', $blockDetail);

        $this->getSettingContent();

        $html .= $this->adminlayout->loadFooter();
        $this->layout->title('Quản lí site');
        $this->layout->view($html);
    }

     function getSettingContent($data = array(), $siteId = 0) {
         $dataContent['cateTitleVn'] = $this->category_model->getTitle('vn', array('site_id' => $siteId));
         $dataContent['cateTitleEn'] = $this->category_model->getTitle('en', array('site_id' => $siteId));

         $content['content'] = array(
             'name' => 'content_01',
             'data' => (isset($data['content_01'])) ? $data['content_01'] : array()
         );
         $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/content_setting_common',
             $dataContent + $content,
             true
         );
         $this->layout->addreplace('content_01', $blockDetail);

         $content['content'] = array(
             'name' => 'content_02',
             'data' => (isset($data['content_02'])) ? $data['content_02'] : array()
         );
         $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/content_setting_common',
             $dataContent + $content,
             true
         );
         $this->layout->addreplace('content_02', $blockDetail);

         $content['content'] = array(
             'name' => 'content_03',
             'data' => (isset($data['content_03'])) ? $data['content_03'] : array()
         );
         $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/content_setting_common',
             $dataContent + $content,
             true
         );
         $this->layout->addreplace('content_03', $blockDetail);

         $content['content'] = array(
             'name' => 'content_04',
             'data' => (isset($data['content_04'])) ? $data['content_04'] : array()
         );
         $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/content_setting_common',
             $dataContent + $content,
             true
         );
         $this->layout->addreplace('content_04', $blockDetail);

         $content['content'] = array(
             'name' => 'content_05',
             'data' => (isset($data['content_05'])) ? $data['content_05'] : array()
         );
         $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/content_setting_common',
             $dataContent + $content,
             true
         );
         $this->layout->addreplace('content_05', $blockDetail);

         $content['content'] = array(
             'name' => 'content_06',
             'data' => (isset($data['content_06'])) ? $data['content_06'] : array()
         );
         $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/content_setting_common',
             $dataContent + $content,
             true
         );
         $this->layout->addreplace('content_06', $blockDetail);
     }

     public function ajaxGetTemplateSetting($templateId, $site_id) {
         $this->load->model('admin/model_template');
         $this->load->model('admin/site_model');
         $this->load->model('admin/category_model');
         $template = $this->model_template->getTemplateName($templateId);
         if(empty($template)) {
             $data = array(
                 'status'   => 'ERROR',
                 'data'     => 'Template không tồn tại'
             );
         } else {
             $result = $this->load->view($this->template_f . 'backend/admin/site/layout_template_' . $template['name'],
                 array(),
                 true
             );
             $data['site']= $this->site_model->getEdit('utt_site', (int)$site_id);
             if(!empty($data['site'])) {
                 $position_display = json_decode($data['site']['position_display'], true);
             } else {
                 $position_display = array();
             }
             $this->getSettingContent($position_display, (int)$site_id);
             $this->layout->setLayout('/backend/layouts/ajax');
             $data = array(
                 'status'   => 'SUCCESS',
                 'data' => $this->layout->view($result, true)
             );
         }

         header('Content-Type: application/json');
         echo json_encode( $data );
     }

     public function getDataSaveSettingContent() {
         $data['content_01'] = $this->getDataContent('content_01');
         $data['content_02'] = $this->getDataContent('content_02');
         $data['content_03'] = $this->getDataContent('content_03');
         $data['content_04'] = $this->getDataContent('content_04');
         $data['content_05'] = $this->getDataContent('content_05');
         $data['content_06'] = $this->getDataContent('content_06');
         return json_encode($data);
     }

     private function getDataContent($content) {
         $limit = ( (int)$this->input->post('number_' . $content) ) ? (int)$this->input->post('number_' . $content) : 5;
         $result = array(
             'cate_id_vn' => (int)getSaveSqlStr(strip_tags($this->input->post('cate_' . $content . '_vn'))),
             'cate_id_en' => (int)getSaveSqlStr(strip_tags($this->input->post('cate_' . $content . '_en'))),
             'limit' => $limit
         );
         return $result;
     }

    public function edit($id='0')
    {
        $id =(int)$id;

        $check = $this->site_model->CheckID($id);
        if (!$check) {
            $this->session->set_flashdata('msg_id_error', "Danh mục bạn vừa chọn không tồn tại");
            redirect('admin/sitemanager');
        }
        $udata = json_decode($this->session->userdata('authentication'),true);
        $userID = $udata['id'];
        $this->permit->check($userID,$id);

        $html = $this->adminlayout->loadTop();
        $html .= $this->adminlayout->loadMenu();
        if ($id=='0' or empty($id))
                {
                    $html .=   '<div class="content-wrapper" style="min-height: 918px;">
                                    <section class="content">
                                    <div class="box">
                                      <div class="box-header">
                                        <h3 class="box-title">404 Not Found!</h3>
                                      </div>
                                    </div>
                                    </select>
                                </div>';
                }
        else
            {
                if (isset($_POST) && !empty($_POST))
                {
                if(isset($_FILES['file_logo']) && !empty($_FILES['file_logo']))
                {
                    $uploadlg = $this->uploadLogo('file_logo');
                    $logo = ($uploadlg['success'])? $uploadlg['upload_data']['file_name']:($this->site_model->getLogo($id));
                } else $logo = $this->site_model->getLogo($id);
                if (isset($_FILES['file_banner']) && !empty($_FILES['file_banner']))
                {
                    $uploadbn = $this->upload('file_banner');
                    $banner = ($uploadbn['success'])? $uploadbn['upload_data']['file_name']:($this->site_model->getBanner($id));
                } else
                {
                    $banner = $this->site_model->getBanner($id);
                }

                $footer_info = getSaveSqlStr(strip_tags($this->input->post('footer_info')));
                $template_id = (int)$this->input->post('site_template_id');
                $name_vn = getSaveSqlStr(strip_tags($this->input->post('name_header_vn')));
                $name_en = getSaveSqlStr(strip_tags($this->input->post('name_header_en')));
                $url_name = getSaveSqlStr(strip_tags(slug($this->input->post('site_url_name'))));
                $title = getSaveSqlStr(strip_tags($this->input->post('site_title')));
                $desc = getSaveSqlStr(strip_tags($this->input->post('site_desc')));
                $keyword = getSaveSqlStr(strip_tags($this->input->post('site_keyword')));
                $department_id = (int)getSaveSqlStr(strip_tags($this->input->post('dept')));
                $settingPositionHomePage = $this->getDataSaveSettingContent();

                if (!isset($template_id)||empty($template_id))
                {
                    $error['template_id_error'] = ' Chưa chọn Mẫu Template!';
                }
                if (!isset($url_name)||empty($url_name))
                {
                    $error['url_name_error'] = ' Chưa điền Địa chỉ/URL của trang!';
                }
                if (!$this->site_model->CheckNameEdit($name_vn,$id))
                {
                    $error['name_error_vn'] = ' Tên trang này đã tồn tại!';
                }
                if (!$this->site_model->CheckNameEdit($name_en,$id))
                {
                    $error['name_error_en'] = ' Tên trang này đã tồn tại!';
                }
                if (!$this->site_model->CheckurlnameEdit($url_name,$id))
                {
                    $error['url_name_error'] = ' Địa chỉ/URL của trang đã tồn tại!';
                }
                if(!isset($department_id))
                {
                    $error['csk'] = "Chưa chọn đơn vị trực thuộc!";
                }
                if ($department_id != 0 && !$this->site_model->CheckDepartmentEdit($department_id,$id))
                {
                    $error['url_name_error1'] = ' Phòng ban này đã có site riêng.';
                }
                if(!isset($title)||empty($title))
                {
                    $error['title'] = "Chưa nhập Tiêu đề trang!";
                }
                if(!isset($error)&&empty($error))
                {
                    $edit = array('template_id'=>$template_id,
                            'name_header_vn'=>$name_vn,
                            'name_header_en' => $name_en,
                            'url_name'=>$url_name,
                            'title'=>$title,
                            'logo'=>$logo,
                            'banner'=>$banner,
                            'footer_info'=>$footer_info,
                            'desc'=>$desc,
                            'keyword' => $keyword,
                            'department_id' => $department_id,
                            'position_display' => $settingPositionHomePage
                            );

                    $this->site_model->edit('utt_site',$id,$edit);
                    $data['site_message']='Sửa thành công';
                } else $data['message_error'] = $error;
                }
                $data['list_department'] = $this->Model_department->dropdown();
                $data['site']=$this->site_model->getEdit('utt_site',$id);

                $position_display = json_decode($data['site']['position_display'], true);

                $template = $this->model_template->getTemplateName($data['site']['template_id']);
                $blockDetail = $this->load->view($this->template_f . 'backend/admin/site/layout_template_' . $template['name'],
                    array(),
                    true
                );
                $this->layout->addreplace('layout_setting_home_page', $blockDetail);

                $this->getSettingContent($position_display, $id);

                $data['template'] = $this->site_model->view('utt_template');
                $html .= $this->load->view('backend/admin/site/site_edit_view',$data,true);
            }
        $this->layout->title('Sửa Site Trang');
        $this->layout->view($html);
    }

    function uploadLogo($name){
        $config = array(
            'upload_path' =>'uploads/images/site',
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "1024000",
            'encrypt_name' => true,
        );
        $new_name = time().$_FILES[$name]['name'];
        $config['file_name'] = $new_name;
        $data = array();
        $data['success'] = false;
        $this->upload->initialize($config);
        if($this->upload->do_upload($name))
        {
            $dataUpload = $this->upload->data();
            $data['upload_data'] = $dataUpload;
            //$data['urlImg'] = $dataUpload['file_name'];
            $data['success'] = true;
        }
        else
        {
            $data['error'] = array('error' => $this->upload->display_errors());
        }
        @unlink($_FILES['tmp_name']);
        //die(json_encode($data));
        return $data;
    }

    function upload($name){
        $config = array(
            'upload_path' =>'uploads/images/site',
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "1024000",
            'encrypt_name' => true,
        );
        $new_name = time().$_FILES[$name]['name'];
        $config['file_name'] = $new_name;
        $data = array();
        $data['success'] = false;
        $this->upload->initialize($config);
        if($this->upload->do_upload($name))
        {
            $dataUpload = $this->upload->data();
            $data['upload_data'] = $dataUpload;
            //$data['urlImg'] = $dataUpload['file_name'];
            $data['success'] = true;
        }
        else
        {
            $data['error'] = array('error' => $this->upload->display_errors());
        }
        @unlink($_FILES['tmp_name']);
        //die(json_encode($data));
        return $data;
    }
 } 
 ?>