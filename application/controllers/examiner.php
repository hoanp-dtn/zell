<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examiner extends MY_Controller {
    function Examiner() {
        parent::__construct ();
        $this->load->library('Homelayout');
        $this->config->load('config_data');
        $this->lang->load('home');
        $this->load->model('admin/model_examiner');
        $this->load->model('slider');
        $this->load->model('ads');
        $this->load->model('partner');
        $this->load->model('navigation_home_model');
        $this->load->model('gallery');
    }

    function index(){
        $this->setInformationSite($data);
        $langCode = $this->lang->lang();
        $nameHeader = $this->model_site->getNameHeader($this->site['id']);//get name header
        $dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode, $this->site['id']), $langCode, $this->site['id']);
        $data['dataSlider'] = $this->slider->getSlide(
            'id, title, post_id, img, url, location, description,
												(select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
												(select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',

            array(
                'site_id' => $this->site['id'],
                'status'  => 1,
                'lang'=>$langCode
            )
        );

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

            $config['base_url'] = $this->config->base_url() . $this->site['url_name'] . '/examiner' . $query_build;
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

        $data['departTypeLst'] = $this->config->item('departLstType');
        $data['dataGallery'] = $this->gallery->getGallery();
        $data['dataDepartment'] = $this->model_site->getDepartmentWithUrlSite();
        $data['dataAds'] = $this->ads->getAds(0, 2, array('site_id' => $this->site['id']));
        $data['dataPartner'] = $this->partner->getPartner(0, 4, array('site_id' => $this->site['id']));
        $dataTmp = array('dataMenu' => $dataMenu,'langCode' => $langCode,'nameHeader' => $nameHeader,
            'siteName'=>$this->siteName, 'logo_for_site'=>$data['logo_for_site']);
        $data = array_merge($data, $dataTmp);
        $html  = $this->render('layout/header', $data , true);
        $html .= $this->render('home/examiner_view', $data, true);
        $html .= $this->render('layout/footer', array(), true);
        $data['content_for_layout'] = $html;
        $data['js_for_layout'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.easing-1.3.js"></script>';
        $data['js_for_layout'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/admin/plugins/datepicker/bootstrap-datepicker.js"></script>';
        $data['js_for_layout1'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.jcarousellite.js"></script>';
        $data['js_for_layout2'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.mousewheel-3.1.12.js"></script>';

        $data['css_for_layout'] = '<link rel="stylesheet" type="text/css" href="'.$this->config->base_url().'publics/template/default/css/style-demo.css">';
        $data['css_for_layout'] = '<link rel="stylesheet" type="text/css" href="'.$this->config->base_url().'publics/admin/plugins/datepicker/datepicker3.css">';
        $this->render('layout/default', $data);
    }

}