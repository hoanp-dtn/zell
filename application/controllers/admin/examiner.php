<?php

class Examiner extends MY_Controller {

    private $site_id, $lang_code;

    function __construct() {
        parent::__construct ();
        //check permission
        $email_login = $this->session->userdata('userinfo')['email'];
        $user_access_examiner = $this->config->item('user_access_examiner');
        if(array_search($email_login, $user_access_examiner) === false) {
            redirect('admin/authentication');
        }

        $this->site_id = $this->session->userdata('site_select');
        $this->lang_code = $this->session->userdata('lang_select');
        $this->load->library('Adminlayout');
        $this->load->library('form_validation');
        $this->load->model('admin/model_examiner');
        $this->load->helper(array('form','My_string','url'));
        $this->permit->authentication();
        $site_select = (int)$this->input->post('site_select');
        $lang_select = $this->input->post('lang_select');
        if(isset($site_select) && $site_select !=0 && isset($lang_select) && !empty($lang_select)){
            $this->session->set_userdata('site_select',$site_select);
            $this->session->set_userdata('lang_select',$lang_select);
            redirect(curPageURL());
        }

    }

    function view(){
        $this->load->config('pagination');
        $this->load->library('pagination');
        $conditions_search = $this->input->get();
        $config = $this->config->item('pagination');
        $config['per_page'] = 20;

        if($conditions_search === false) {
            $conditions_search = null;
        }

        $config['total_rows'] = $this->model_examiner->total($conditions_search, null);

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = (int)$this->input->get('page');
        $page = ($page>$total_page)?$total_page:$page;
        $page = ($page<1)?1:$page;
        $page = $page-1;
        $data['search'] = $conditions_search;
        $data['conditions_search'] = $conditions_search;
        $query_build = '';
        if(is_array($conditions_search)) {
            $query_build = '?' . http_build_query($conditions_search);
        }

        if($config['total_rows']>0){

            $config['base_url'] = $this->config->base_url() . 'admin/examiner/view' . $query_build;
            $data['list_posts'] = $this->model_examiner->view(
                $page * $config['per_page'],
                $config['per_page'],
                $conditions_search
            );
        }

        $this->pagination->initialize($config);
        $data['list_paginition'] = $this->pagination->create_links();
        $data['form_exam'] = $this->config->item('form_exam');
        $data['query_build'] = $query_build;

        $data['active'] = array('examiner','examiner/view');
        $html  = $this->adminlayout->loadTop();
        $html .= $this->adminlayout->loadMenu($current = 'treeview', $viewFile = 'backend/admin/menu_view',  $data);
        $html .= $this->load->view('backend/examiner/examiner_view',$data,true);
        $html .= $this->adminlayout->loadFooter();
        $this->layout->css(base_url().'publics/teacher/css/toastr.min.css');
        $this->layout->js(base_url().'publics/teacher/js/toastr.min.js');
        $this->layout->title('Quản lí chấm thi');
        $this->layout->view($html);
    }

    public function download_excel() {
        $this->load->library('excel');
        $filename = "utt_examiner.xlsx";

        $conditions_search = $this->input->get();
        if($conditions_search === false) {
            $conditions_search = null;
        }

        $data['list_posts'] = $this->model_examiner->view(
            null,
            null,
            $conditions_search
        );

        $data['form_exam'] = $this->config->item('form_exam');
        $html = $this->load->view('backend/examiner/examiner_excel', $data, true);
        $tmpfile = tempnam(sys_get_temp_dir(), 'html');
        file_put_contents($tmpfile, $html);

        $objPHPExcel     = new PHPExcel();
        $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
        $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
        $objPHPExcel->getActiveSheet()->setTitle('Danh sách bài thi');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Danh sách bài thi');
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

        unlink($tmpfile);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    function assignment($id) {
        $date_expected  = $this->config->item('date_expected');
        $exam = $this->model_examiner->get($id);
        if(empty($exam)) {
            $error = array(
                'type' => 'error',
                'message' => 'Không tồn tại bài thi!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
            redirect('admin/examiner/view');
        }

        if(!empty($exam['day_assignment'])) {
            $error = array(
                'type' => 'error',
                'message' => 'Bài thi này đã được giao, thao tác không đúng!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
            redirect('admin/examiner/view');
        }

        $data['day_assignment']         = date("Y-m-d");
        $data['user_update']            = $this->session->userdata('userinfo')['id'];
        $data['expected_return_date']   = date("Y-m-d", strtotime($data['day_assignment'] . $date_expected[$exam['exam_form']]));
        $flg_update = $this->model_examiner->update($id, $data);
        if($flg_update) {
            $success = array(
                'type' => 'successful',
                'message' => 'Giao bài hoàn thành!'
            );
            $this->session->set_flashdata('message_flashdata', $success);
        } else {
            $error = array(
                'type' => 'error',
                'message' => 'Có lỗi trong quá trình thực hiện!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
        }

        redirect('admin/examiner/view');
    }

    function reset($id) {
        $exam = $this->model_examiner->get($id);
        if(empty($exam)) {
            $error = array(
                'type' => 'error',
                'message' => 'Không tồn tại bài thi!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
            redirect('admin/examiner/view');
        }

        $data['day_assignment']         = null;
        $data['user_update']            = $this->session->userdata('userinfo')['id'];
        $data['expected_return_date']   = null;
        $data['return_date']   = null;
        $flg_update = $this->model_examiner->update($id, $data);
        if($flg_update) {
            $success = array(
                'type' => 'successful',
                'message' => 'Đặt lại thành công!'
            );
            $this->session->set_flashdata('message_flashdata', $success);
        } else {
            $error = array(
                'type' => 'error',
                'message' => 'Có lỗi trong quá trình thực hiện!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
        }

        redirect('admin/examiner/view');
    }

    function pay_exams($id) {
        $exam = $this->model_examiner->get($id);
        if(empty($exam)) {
            $error = array(
                'type' => 'error',
                'message' => 'Không tồn tại bài thi!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
            redirect('admin/examiner/view');
        }

        if(!empty($exam['return_date'])) {
            $error = array(
                'type' => 'error',
                'message' => 'Bài thi này đã trả, thao tác không đúng!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
            redirect('admin/examiner/view');
        }

        $data['return_date']         = date("Y-m-d");
        $data['user_update']         = $this->session->userdata('userinfo')['id'];
        $flg_update = $this->model_examiner->update($id, $data);
        if($flg_update) {
            $success = array(
                'type' => 'successful',
                'message' => 'Hoàn thành nhận bài!'
            );
            $this->session->set_flashdata('message_flashdata', $success);
        } else {
            $error = array(
                'type' => 'error',
                'message' => 'Có lỗi trong quá trình thực hiện!'
            );
            $this->session->set_flashdata('message_flashdata', $error);
        }

        redirect('admin/examiner/view');
    }

}
