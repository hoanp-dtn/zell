<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Contact extends MY_Controller {

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

	

    function index(){
        $this->setInformationSite($data);
        $langCode = $this->lang->lang();
        $dataSlider = $this->slider->getSlide(
                                                'id, title, post_id, img, url, location, description,
                                                (select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
                                                (select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',
                                                
                                                array(
                                                    'status'  => 1,
                                                    'lang'=>$langCode,
                                                    'type' => 'slide'
                                                )
        );
        $dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);

        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
         $dataTmp = array('dataMenuNews'=>$dataMenuNews,'dataSlider'=>$dataSlider,'dataMenu' => $dataMenu,'langCode' => $langCode);
        $data = array_merge($data, $dataTmp);
        $dataGallery = $this->gallery->getGallery();

        $html  = $this->render('layout/slider', $data , true);
        $html .="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);

        $html  .= $this->render('home/contact', $data , true);

        $html .= $this->render('layout/footer', array(), true);
        // $html .= $this->render(
        //                     'home/home',
        //                     compact(
        //                         'dataSlider',
        //                         // 'dataAds',
        //                         // 'dataPartner',
        //                         'langCode',
        //                         'dataGallery'
        //                         // 'dataDepartment'
        //                     ),
        //                     true
        // );
        $html .= "</div>";
        $data['content_for_layout'] = $html;
        $this->render('layout/default', $data);

    }

    public function add()
    {
        if(isset($_POST) && !empty($_POST)){
            $post = $this->input->post();
            $post['type'] = 'contact';
            $flag = $this->contact_home_model->add($post);
            $this->session->set_flashdata('message_flashdata',$flag);
            redirect('contact/');
        }
    }
    public function support()
    {
        if(isset($_POST) && !empty($_POST)){
            $post = $this->input->post();
            $post['type'] = 'contact';
            $flag = $this->contact_home_model->add($post);
            $this->session->set_flashdata('message_flashdata',$flag);
            redirect(base64_decode($this->input->get('redirect'))); 
        }
    }

}