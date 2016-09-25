<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Gallery_home extends MY_Controller {

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

    }
    public function photo($value='')
    {
        $this->setInformationSite($data);
        $langCode = $this->langCode;
        $dataSlider = $this->slider->getSlide(
                                                'id, title, post_id, img, url, location, description,
                                                (select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
                                                (select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',
                                                
                                                array(
                                                    'status'  => 1,
                                                    'type' => 'slide'
                                                )
        );
        $dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);

        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
         $dataTmp = array('dataMenuNews'=>$dataMenuNews,'dataSlider'=>$dataSlider,'dataMenu' => $dataMenu,'langCode' => $langCode);
        $data = array_merge($data, $dataTmp);
        $dataGallery = $this->gallery->getGallery();
        $html ="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);
        $html  .= $this->render('layout/slider', $data , true);

        $html  .= $this->render('home/photo', compact(
'dataGallery'
            ) , true);

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
public function video($value='')
    {
        $this->setInformationSite($data);
        $langCode = $this->langCode;
        $dataSlider = $this->slider->getSlide(
                                                'id, title, post_id, img, url, location, description,
                                                (select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
                                                (select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',
                                                
                                                array(
                                                    'status'  => 1,
                                                    'type' => 'slide'
                                                )
        );
        $dataVideo = $this->slider->getSlide(
                                                'id, title, post_id, img, url, location, description,
                                                (select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
                                                (select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',
                                                
                                                array(
                                                    'status'  => 1,
                                                    'type' => 'video'
                                                )
        );
        $dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
         $dataTmp = array('dataMenuNews'=>$dataMenuNews,'dataSlider'=>$dataSlider,'dataMenu' => $dataMenu,'langCode' => $langCode);
        $data = array_merge($data, $dataTmp);
        $dataGallery = $this->gallery->getGallery();
        $html ="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);
        $html  .= $this->render('layout/slider', $data , true);

        $html  .= $this->render('home/video', compact(
'dataVideo'
            ) , true);

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

}