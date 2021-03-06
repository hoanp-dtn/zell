<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    private $data;
    function Home() {
        parent::__construct ();
        $this->load->library('Homelayout');
        $this->config->load('config_data');
        $this->lang->load('home', $this->language);
        $this->load->model('posts_home_model');
        $this->load->model('Model_site');
        $this->load->model('slider');
        $this->load->model('ads');
        $this->load->model('partner');
        $this->load->model('navigation_home_model');
        $this->load->model('category_home_model');
        $this->load->model('gallery');
    }
    
    function index(){
        $this->setInformationSite($data);
        $langCode = $this->langCode;
        $post_about = $this->navigation_home_model->get(
            'post_id',
            [
                'parent_id' => 51,
                'post_id !=' => 0
            ],
            false
        );
        $post_about_detail = null;
        if($post_about['post_id']){
            $post_about_detail = $this->posts_home_model->showDetail((int)$post_about['post_id']);
        }
        $dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
        
        $dataSlider = $this->slider->getSlide(
                                                'id, title, post_id, img, url, location, description,
                                                (select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
                                                (select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',
                                                
                                                array(
                                                    'status'  => 1,
                                                    'type' => 'slide'
                                                )
        );
        $dataGallery = $this->gallery->getGallery();
        // $dataPartner = $this->partner->getPartner(0, 4, array('site_id' => $this->site['id']));
        $list_posts = $this->posts_home_model->getListPost(0, $langCode, 0, 5,'news', 27);
        $list_promotion = $this->posts_home_model->getListPost(0, $langCode, 0, 5,'news', 101);
        $list_product = $this->posts_home_model->getListPost(68, $langCode, null, null, 'product');
        
        $dataTmp = array('post_about_detail' =>$post_about_detail,'list_product' =>$list_product,'list_promotion' =>$list_promotion,'list_posts' =>$list_posts,'dataMenuNews' =>$dataMenuNews,'dataMenu' => $dataMenu,'langCode' => $langCode, 'dataSlider'=>$dataSlider);
        $data = array_merge($data, $dataTmp);

        $html ="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);

        $html  .= $this->render('layout/slider', $data , true);
        $html  .= $this->render('home/home-mobile', $data , true);

        $html  .= $this->render('layout/book_slider', $data , true);
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
        $data['js_for_layout'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.easing-1.3.js"></script>';
        $data['js_for_layout1'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.jcarousellite.js"></script>';
        $data['js_for_layout2'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.mousewheel-3.1.12.js"></script>';
        
        $data['css_for_layout'] = '<link rel="stylesheet" type="text/css" href="'.$this->config->base_url().'publics/template/default/css/style-demo.css">';
        $this->render('layout/default', $data);
    }

}