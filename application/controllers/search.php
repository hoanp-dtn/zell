<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
    private $data;
    function Search() {
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
    }
	function index(){
		$this->setInformationSite($data);
		$nameHeader = $this->model_site->getNameHeader($this->site['id']);//get name header
        $langCode = $this->lang->lang();
		$this->load->config('pagination');
		$this->load->library('pagination');
		$config = $this->config->item('pagination');
		$key_search = $this->input->get('s');
		if(!isset($key_search) || is_bool($key_search)){
			redirect($this->config->base_url($this->siteName));
		}
		$key_search = getSaveSqlStr($key_search);
		$config['total_rows'] = count($this->posts_home_model->searchPost($key_search, $this->site['id'], $langCode));
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['per_page'] = 4;
		$config['full_tag_open']='<div class="row"><div class="col-xs-12"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination pull-right" style = "float:left!important;">';
		$config['base_url'] = is_bool(strpos(getCurrentUrl(),"&"))?getCurrentUrl():substr(getCurrentUrl(),0,strpos(getCurrentUrl(),"&"));
		$config['first_link']=lang('first_link');
		$config['last_link']=lang('last_link');
		$config['next_link']=lang('next_link');
		$config['prev_link']=lang('prev_link');
		$total_page=ceil($config['total_rows']/$config['per_page']);
		$page = (int)$this->input->get('page');
		$page = ($page>$total_page)?$total_page:$page;
		$page = ($page<1)?1:$page;
		$page = $page-1;
		$this->pagination->initialize($config);
		$list_paginition = $this->pagination->create_links();
		if($config['total_rows']>0){
			$list_posts = $this->posts_home_model->searchPost($key_search, $this->site['id'], $langCode,($page*$config['per_page']),$config['per_page']);
		}
		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode, $this->site['id']), $langCode, $this->site['id']);
		$getPostAndNew = $this->posts_home_model->showPostAndNew($this->site['id'], 5, $langCode);
		$data['title_for_layout'] = $key_search.' -'.lang('search_article');
		$dataTmp = array('dataMenu' => $dataMenu,'langCode' => $langCode,'nameHeader' => $nameHeader,
                            'siteName'=>$this->siteName, 'logo_for_site'=>$data['logo_for_site']);
        $data = array_merge($data, $dataTmp);
        $html  = $this->render('layout/header', $data , true);		$dataGallery = $this->gallery->getGallery();
        $html .= $this->render('home/list_post_search',array(
								'key_search' => $key_search,
								'getPostAndNew' => $getPostAndNew,
								'dataGallery' => $dataGallery,
								'list_paginition' => $list_paginition,
								'list_posts_search' => isset($list_posts)?$list_posts:NULL,
								'siteName' => $this->siteName
							),true);
        $html .= $this->render('layout/footer', $data, true);
        $data['content_for_layout'] = $html;
        $this->render('layout/default', $data);
	}
}