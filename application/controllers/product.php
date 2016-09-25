<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
    private $data;
    function __construct() {
        parent::__construct ();
        $this->load->library('Homelayout');
		$this->load->model('posts_home_model');
		$this->lang->load('list_posts');
		$this->lang->load('home');
        $this->load->model('posts_home_model');
        $this->load->model('slider');
        $this->load->model('ads');
        $this->load->model('partner');
        $this->load->model('navigation_home_model');
        $this->load->model('category_home_model');
        $this->load->model('gallery');
        $this->load->model('comment_model');
    }

    public function productList($nav_id = 0){
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
		// $post = $this->posts_home_model->get('id', array('id' => (int)$id, 'lang' => $langCode, 'status' => 1),TRUE);
		if( !isset($post) || count($post) == 0){
			// redirect($this->config->base_url($langCode.'/'.$this->siteName));
		}
		// menu
		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
		
        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
		// data post
		// $post_detail = $this->posts_home_model->showDetail((int)$id);
		$breadcrumb = $this->posts_home_model->breadcrumb($nav_id);
		// $list_comment = $this->comment_model->getListComment((int)$id);

		// $data['title_for_layout'] = $post_detail['title'];
		// $data['desc_for_layout'] = $post_detail['description'];
		$list_product = $this->posts_home_model->getListPost($nav_id, $langCode, null, null, 'product');
        
        $dataTmp = array('dataMenuNews'=> $dataMenuNews,'dataSlider'=> $dataSlider, 'dataMenu' => $dataMenu,'langCode' => $langCode, 'breadcrumb'=>$breadcrumb);
        $data = array_merge($data, $dataTmp);
  //       $html  = $this->render('layout/header', $data , true);
		
		// // gallery
		// $dataGallery = $this->gallery->getGallery();
  //       $html .= $this->render(
  //                           'home/post_detail',array('breadcrumb'=>$breadcrumb,'post_detail' => $post_detail, 'getPostAndNew' => $getPostAndNew,'getPostAndRelative' => $getPostAndRelative,'getPostAndRelativeBottomArticle' => $getPostAndRelativeBottomArticle,'dataAds' => $dataAds, 'dataPartner' => $dataPartner,'dataGallery' => $dataGallery,'site_id' => $site_id, 'post_id' => $post_id,'list_comment'=>$list_comment),true
  //       );
  //       $html .= $this->render('layout/footer', $data, true);
        $html ="<div class='container product-list'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);
         $html  .= $this->render('layout/slider', $data , true);

        $html  .= $this->render('home/productList', compact(
        	'list_product'
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
		$data['js_for_layout'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/comment.js"></script>';
        $this->render('layout/default', $data);
    }
	
	function view($id){
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
        $post_detail = $this->posts_home_model->showDetail((int)$id);
        $dataReviews = $this->slider->getReviews(
                                                'id, post_id, location, description',
                                                
                                                array(
                                                    'status'  => 1,
                                                    'type' => 'review',
                                                    'post_id' => $post_detail['id']
                                                )
        );
		$post = $this->posts_home_model->get('id', array('id' => (int)$id, 'status' => 1),TRUE);
		if( !isset($post) || count($post) == 0){
			redirect($this->config->base_url());
		}
        $this->posts_home_model->addViewCount($id);
		// menu
		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
		
        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
		// data post
		$breadcrumb = $this->posts_home_model->breadcrumb($post_detail['nav_id']);
		$list_comment = $this->comment_model->getListComment((int)$id);

		$data['title_for_layout'] = $post_detail['title'];
		$data['desc_for_layout'] = $post_detail['description'];
		$post_id = (int)$id;
        $productRelative = $this->posts_home_model->showPostAndRelative($post_detail, 0,100000, $langCode, 'product');
        $dataTmp = array('dataReviews'=>$dataReviews,'dataMenuNews'=>$dataMenuNews,'dataSlider'=>$dataSlider,'dataMenu' => $dataMenu,'langCode' => $langCode,'breadcrumb'=>$breadcrumb);
        $data = array_merge($data, $dataTmp);
  //       $html  = $this->render('layout/header', $data , true);
		
		// // gallery
		// $dataGallery = $this->gallery->getGallery();
  //       $html .= $this->render(
  //                           'home/post_detail',array('breadcrumb'=>$breadcrumb,'post_detail' => $post_detail, 'getPostAndNew' => $getPostAndNew,'getPostAndRelative' => $getPostAndRelative,'getPostAndRelativeBottomArticle' => $getPostAndRelativeBottomArticle,'dataAds' => $dataAds, 'dataPartner' => $dataPartner,'dataGallery' => $dataGallery,'site_id' => $site_id, 'post_id' => $post_id,'list_comment'=>$list_comment),true
  //       );
  //       $html .= $this->render('layout/footer', $data, true);
        $html ="<div class='container product-view'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);
         $html  .= $this->render('layout/slider', $data , true);

        $html  .= $this->render('home/product_detail', compact(
        	'post_detail',
             'productRelative'
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
		$data['js_for_layout'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/comment.js"></script>';
        $this->render('layout/default', $data);
	}

    public function addLoveCount(){
        $product_id = (int)$this->input->post('product_id');
        if($product_id){
            $post = $this->posts_home_model->get('id', array('id' => $product_id, 'status' => 1),TRUE);
            if(count($post)){
                $result = $this->posts_home_model->addLoveCount($product_id);
                echo $result;
            }
        }
    }
}