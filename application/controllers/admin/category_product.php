<?php
class Category_product extends MY_Controller
{
    private $lang_code;
    private $data;
    function __construct()
    {
        parent::__construct ();
        $this->lang_code = $this->session->userdata('lang_select');
        $this->load->model('admin/category_model');
        $this->load->model('admin/Model_lang');
        $this->load->library('Adminlayout');
        $this->load->model('model_user');
        $this->permit->authentication();
        $this->load->model('admin/permit_model');
        $lang_select = $this->input->post('lang_select');
            if(isset($lang_select) && !empty($lang_select)){
                $this->session->set_userdata('lang_select',$lang_select);
                redirect(curPageURL());
            }
    }

    function view($lang = 'vn'){
        $data['current_lang'] = $this->lang_code;
        $query = $this->input->get('s');
        $like = NULL;
        if(isset($query) && !is_bool($query) && $query !=""){
            $like = array(
                'feild' => PREFIX.'cate.title',
                'value' => $query
            );
            $data['current_search'] = $query;
        }
        $this->load->config('pagination');
        $this->load->library('pagination');
        $config = $this->config->item('pagination');
        $config['base_url'] = is_bool(strpos(getCurrentUrl(),"?"))?getCurrentUrl():substr(getCurrentUrl(),0,strpos(getCurrentUrl(),"?")).'?s='.$query;
        $config['total_rows'] = $this->category_model->total(array('type'=>'product','lang'=>$this->lang_code), $like);
        $total_page=ceil($config['total_rows']/$config['per_page']);
        $page = (int)$this->input->get('page');
        $page = ($page>$total_page)?$total_page:$page;
        $page = ($page<1)?1:$page;
        $page = $page-1;
        $this->pagination->initialize($config);
        $data['list_paginition'] = $this->pagination->create_links();
        if($config['total_rows']>0){
            $data['category'] = $this->category_model->view(($page*$config['per_page']),$config['per_page'],array('type' => 'product','utt_cate.lang'=>$this->lang_code),$like);
        }
        $data['active'] = array('category_product','category_product/view');
        $data['list_lang'] = $this->Model_lang->dropdown();
        $html  = $this->adminlayout->loadTop();
        $html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
        $html .= $this->load->view('backend/admin/category/category_view',isset($data)?$data:NULL,true);
        $html .= $this->adminlayout->loadFooter();
        $this->layout->title('Quản lí danh mục');
        $this->layout->view($html);
    }
    function add()
    {
        $langCode = $this->lang_code;
        $ttnguoidung  = $this->session->userdata('userinfo');
        if (isset($_POST) && !empty($_POST))
        {
            $lang = getSaveSqlStr(strip_tags($this->input->post('cate_lang')));
            $title = getSaveSqlStr(strip_tags($this->input->post('cate_title')));
            $parent_id = (int)$this->input->post('cate_parent_id');

            if (!isset($title)||empty($title))
            {
                $error['cate_title_error'] = ' Chưa nhập tiêu đề danh mục!';
            }
            if (!$this->category_model->CheckCate($title))
            {
                $error['cate_title_error'] = ' Tên tiêu đề đã có!';
            }
                if(!isset($error)&&empty($error))
                {
                    $insert = array('type' => 'product',
                                    'title' => $title,
                                    'lang' => $this->lang_code,
                                    'parent_id' => $parent_id);

                    $this->category_model->add('utt_cate',$insert);
                    $data['cate_message']='Thêm thành công';
                } else $data['message_error'] = $error;
        }
        $data['active'] = array('category_product','category_product/add');
        $data['cate_parent']=$this->category_model->get('utt_cate','id,title',array('type' => 'product','lang'=>(isset($langCode) && $langCode != "")?$langCode:'vn'));
        $data['lang']=$this->category_model->get('utt_lang',array('code','name'),null);
        $data['userpermit']= $ttnguoidung['permit'];

        $html = $this->adminlayout->loadTop();
        $html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
        $html .= $this->load->view('backend/admin/category/category_add_view',$data,true);
        $html .= $this->adminlayout->loadFooter();
        //Show Layout
        $this->layout->title('Quản lí danh mục');
        $this->layout->view($html);
    }

    function edit($id = 0)
    {
		
        $redirect= $this->input->get('redirect');
        $redirect = !empty($redirect)?base64_decode($redirect):'admin/category/view';
        $id = (int)$id;
        $check = $this->category_model->CheckID($id, true);
        $where_not_in['arr'] = $this->category_model->getChild($id);
        $where_not_in['field'] = 'id';
        if (count($check) < 1 || $check == false) {
            $this->session->set_flashdata('msg_id_error', "Không tìm thấy trang bạn yêu cầu");
            redirect('admin/category/view');
        }

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
                    $title = getSaveSqlStr(strip_tags($this->input->post('cate_title')));
                    $parent_id = (int)$this->input->post('cate_parent_id');

                    if (!isset($title)||empty($title))
                    {
                        $error['cate_title_error'] = ' Chưa nhập tiêu đề danh mục!';
                    }
                    if (!$this->category_model->CheckCateEdit($title,$id))
                    {
                        $error['cate_title_error'] = ' Tên tiêu đề đã có!';
                    }
                    if(!isset($error)&&empty($error))
                    {
                        $edit = array('type' => 'news',
                                      'title' => $title,
                                      'parent_id' => $parent_id);

                        $this->category_model->edit('utt_cate',$id,$edit);
                        $this->session->set_flashdata('msg_success','Sửa thành công');
                        redirect($redirect);
                    } else $data['message_error'] = $error;

                }

            $data['category']=$this->category_model->getEdit('utt_cate',$id);
            $data['cate_parent']=$this->category_model->get('utt_cate',array('id','title'),array('lang'=>$check['lang'], 'id !=' => (int)$id), NULL,NULL, $where_not_in);
            $html .= $this->load->view('backend/admin/category/category_edit_view',$data,true);
        }
        $html .= $this->adminlayout->loadFooter();
        //Show Layout
        $this->layout->title('Quản lí danh mục');
        $this->layout->view($html);

    }

    function delete($id='0')
    {
        $id = (int)$id;
        $redirect= $this->input->get('redirect');
        $redirect = !empty($redirect)?base64_decode($redirect):'admin/category/view';
        $check = $this->category_model->CheckID($id);
        if (!$check) {
            $this->session->set_flashdata('msg_id_error', "Thao tác thất bại! Danh mục bạn vừa chọn không tồn tại");
            redirect('admin/category/view');
        }
        $this->category_model->delete('utt_cate',$id);
        $this->session->set_flashdata('msg_success', "Xóa thành công");
        redirect($redirect);
    }
}

?>