<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Review extends MY_Controller {

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
        $this->load->library('form_validation');

    }

    public function add()
    {
        if(isset($_POST) && !empty($_POST)){
            $post = $this->input->post();
            $data = [
                'type' => 'review',
                'location' => $post['vote'],
                'post_id' => $post['product_id'],
                'description' => $post['detail'],
            ];
            $flag = $this->slider->add($data);
            $this->session->set_flashdata('message_flashdata',$flag);
            redirect(base64_decode($this->input->get('redirect')));  
        }
    }

}