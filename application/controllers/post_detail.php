<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_detail extends MY_Controller {
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

    function view($id = 0){
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
		$post = $this->posts_home_model->get('id', array('id' => (int)$id,  'status' => 1),TRUE);
		if( !isset($post) || count($post) == 0){
            show_404();
			redirect($this->config->base_url($langCode.'/'.$this->siteName));
		}

		// menu
		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
		
        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
		// data post
		$post_detail = $this->posts_home_model->showDetail((int)$id);
        $getPostAndRelative = $this->posts_home_model->showPostAndRelative($post_detail, 0,5);
		$arr = [];
		$breadcrumb = $this->posts_home_model->breadcrumb($post_detail['nav_id'], $arr, $post_detail['cate_id']);
		$list_comment = $this->comment_model->getListComment((int)$id);

		$data['title_for_layout'] = $post_detail['title'];
		$data['desc_for_layout'] = $post_detail['description'];
		$post_id = (int)$id;
        
        $dataTmp = array('getPostAndRelative' => $getPostAndRelative,'dataMenuNews' => $dataMenuNews,'dataSlider' => $dataSlider,'dataMenu' => $dataMenu,'langCode' => $langCode, 'breadcrumb'=>$breadcrumb);
        $data = array_merge($data, $dataTmp);
  //       $html  = $this->render('layout/header', $data , true);
		
		// // gallery
		// $dataGallery = $this->gallery->getGallery();
  //       $html .= $this->render(
  //                           'home/post_detail',array('breadcrumb'=>$breadcrumb,'post_detail' => $post_detail, 'getPostAndNew' => $getPostAndNew,'getPostAndRelative' => $getPostAndRelative,'getPostAndRelativeBottomArticle' => $getPostAndRelativeBottomArticle,'dataAds' => $dataAds, 'dataPartner' => $dataPartner,'dataGallery' => $dataGallery,'site_id' => $site_id, 'post_id' => $post_id,'list_comment'=>$list_comment),true
  //       );
  //       $html .= $this->render('layout/footer', $data, true);
        $html ="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);
        $html  .= $this->render('layout/slider', $data , true);

        $html  .= $this->render('home/post_detail', compact(
        	'post_detail'
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
	
	function view_listpost($nav_id){
		$this->setInformationSite($data);
		// $nameHeader = $this->model_site->getNameHeader($this->site['id']);//get name header
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
		// $navigation = $this->navigation_home_model->get('id,title', array('id' => (int)$nav_id, 'lang' => $langCode),TRUE);
		// if( !isset($navigation) || count($navigation) == 0){
		// 	redirect($this->config->base_url($langCode.'/'.$this->siteName));
		// }
		// $this->load->config('pagination');
		// $this->load->library('pagination');
		// $config = $this->config->item('pagination');
		// $config['total_rows'] = $this->posts_home_model->total($nav_id, $this->site['id'], $langCode);
		// $config['page_query_string'] = TRUE;
		// $config['use_page_numbers'] = TRUE;
		// $config['query_string_segment'] = 'page';
		// $config['per_page'] = 4;
		// $config['full_tag_open']='<div class="row"><div class="col-xs-12"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination pull-right" style = "float:left!important;">';
		// $config['base_url'] = is_bool(strpos(getCurrentUrl(),"?"))?getCurrentUrl():substr(getCurrentUrl(),0,strpos(getCurrentUrl(),"?"));
		// $config['first_link']=lang('first_link');
		// $config['last_link']=lang('last_link');
		// $config['next_link']=lang('next_link');
		// $config['prev_link']=lang('prev_link');
		// $total_page=ceil($config['total_rows']/$config['per_page']);
		// $page = (int)$this->input->get('page');
		// $page = ($page>$total_page)?$total_page:$page;
		// $page = ($page<1)?1:$page;
		// $page = $page-1;
		// $this->pagination->initialize($config);
		// $list_paginition = $this->pagination->create_links();
		// if($config['total_rows']>0){
		// 	$list_posts = $this->posts_home_model->getListPost($nav_id, $this->site['id'], $langCode,($page*$config['per_page']),$config['per_page']);
		// }
		$list_posts = $this->posts_home_model->getListPost($nav_id, $langCode);
		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
		
        $dataMenuNews = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(68,$langCode), $langCode);
		$breadcrumb = $this->posts_home_model->breadcrumb($nav_id);
		// $getPostAndNew = $this->posts_home_model->showPostAndNew($this->site['id'], 5, $langCode);
		// $data['title_for_layout'] = $navigation[0]['title'];
        $dataTmp = array('dataMenuNews' => $dataMenuNews,'dataSlider' => $dataSlider, 'dataMenu' => $dataMenu,'langCode' => $langCode, 'breadcrumb'=>$breadcrumb);
        $data = array_merge($data, $dataTmp);

        // $html  = $this->render('layout/header', $data , true);
		// $dataGallery = $this->gallery->getGallery();
		// if($config['total_rows'] == 1){
		// 	// $post_detail = $list_posts[0];
			
		// $post_detail = $this->posts_home_model->showDetail($list_posts[0]['id']);
		// $getPostAndRelative = $this->posts_home_model->showPostAndRelative($post_detail, $this->site['id'], 0,5, $langCode);
		// $getPostAndRelativeBottomArticle = $this->posts_home_model->showPostAndRelative($post_detail, $this->site['id'], 5,5, $langCode);
		// 	$list_comment = $this->comment_model->getListComment((int)$post_detail['id']);
		// 	$html .= $this->render(
		// 						'home/post_detail',array('post_detail' => $post_detail, 'getPostAndNew' => $getPostAndNew,'getPostAndRelative' => $getPostAndRelative,'getPostAndRelativeBottomArticle' => $getPostAndRelativeBottomArticle,'dataGallery' => $dataGallery,'site_id' => $this->site['id'], 'post_id' => $post_detail['id'],'list_comment'=>$list_comment,'breadcrumb'=>$breadcrumb),true
		// 	);
		// }else{
		// 	$html .= $this->render('home/list_post_detail',array(
		// 						'getPostAndNew' => $getPostAndNew,
		// 						'dataGallery' => $dataGallery,
		// 						'list_paginition' => $list_paginition,
		// 						'list_posts' => isset($list_posts)?$list_posts:NULL,
		// 						'siteName' => $this->siteName
		// 						,'breadcrumb'=>$breadcrumb
		// 					),true);
		// }
        $html ="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);
         $html  .= $this->render('layout/slider', $data , true);

        $html  .= $this->render('home/post_list', compact(
'list_posts'
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