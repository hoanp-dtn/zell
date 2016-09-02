<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Order extends MY_Controller {

    private $data;

    function __construct() {

        parent::__construct ();

        $this->load->library('Homelayout');

        $this->lang->load('home');

        $this->load->model('posts_home_model');

		$this->load->model('Model_site');

        $this->load->model('slider');

        $this->load->model('ads');

        $this->load->model('partner');

        $this->load->model('navigation_home_model');

        $this->load->model('category_home_model');

        $this->load->model('gallery');
        $this->load->model('contact_home_model');
        $this->load->model('order_home_model');
        $this->load->library('form_validation');

    }

    public function add()
    {
        if(isset($_POST) && !empty($_POST)){
            $this->form_validation->set_rules('name','Họ tên','trim|required');
            $this->form_validation->set_rules('phone','Hotline','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|email');
            $this->form_validation->set_rules('address','Địa chỉ','trim|required');
            $this->form_validation->set_rules('message','Nội dung','trim|required');
           
            if($this->form_validation->run()){
                $post = $this->input->post();
                $data = [
                    'name' => $post['name'],
                    'phone' => $post['phone'],
                    'email' => $post['email'],
                    'address' => $post['address'],
                    'message' => $post['message'],
                    'type' => 'order',
                ];
                $contact = $this->contact_home_model->add($data);
                $flag = [];
                if($contact['type'] == 'successful'){
                    $flag = $this->order_home_model->add(array(
                        'customer_id' => $contact['id'],
                        'product_id' => $post['product_id'],
                        'number' => $post['number'],
                    ));
                }
                $this->session->set_flashdata('message_flashdata',$flag);
                redirect(base64_decode($this->input->get('redirect')));
            }
        }
    }

}