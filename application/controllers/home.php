<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    private $data;
    function Home() {
        parent::__construct ();
        $this->load->library('Homelayout');
        $this->config->load('config_data');
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
	
    function index(){
        $this->setInformationSite($data);
        $positionDisplay = json_decode($this->site['position_display'], true);
        $langCode = $this->lang->lang();
		$nameHeader = $this->model_site->getNameHeader($this->site['id']);//get name header
		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode, $this->site['id']), $langCode, $this->site['id']);
        $keyCateNameLang = 'cate_id_' . $this->lang->lang();
        $content_01 = $this->posts_home_model->getPostSiteAndAreaDisplay(
                                                $positionDisplay['content_01'][$keyCateNameLang],
                                                $this->site['id'],
                                                1,
                                                $positionDisplay['content_01']['limit'],
                                                $langCode
        );
        $content_02 = $this->posts_home_model->getPostSiteAndAreaDisplay(
                                                $positionDisplay['content_02'][$keyCateNameLang],
                                                $this->site['id'],
                                                1,
                                                $positionDisplay['content_02']['limit'],
                                                $langCode
        );
        $content_03 = $this->posts_home_model->getPostSiteAndAreaDisplay(
                                                $positionDisplay['content_03'][$keyCateNameLang],
                                                $this->site['id'],
                                                1,
                                                $positionDisplay['content_03']['limit'],
                                                $langCode
        );
        $content_04 = $this->posts_home_model->getPostSiteAndAreaDisplay(
                                                $positionDisplay['content_04'][$keyCateNameLang],
                                                $this->site['id'],
                                                1,
                                                $positionDisplay['content_04']['limit'],
                                                $langCode
        );
        $content_05 = $this->posts_home_model->getPostSiteAndAreaDisplay(
                                                $positionDisplay['content_05'][$keyCateNameLang],
                                                $this->site['id'],
                                                1,
                                                $positionDisplay['content_05']['limit'],
                                                $langCode
        );
        $content_06 = $this->posts_home_model->getPostSiteAndAreaDisplay(
                                                $positionDisplay['content_06'][$keyCateNameLang],
                                                $this->site['id'],
                                                1,
                                                $positionDisplay['content_06']['limit'],
                                                $langCode
        );
        $dataSlider = $this->slider->getSlide(
                                                'id, title, post_id, img, url, location, description,
												(select utt_post.cate_id from utt_post where utt_post.id = utt_slide.post_id) as cate_id, 
												(select utt_post.title from utt_post where utt_post.id = utt_slide.post_id) as post_title',
												
                                                array(
                                                    'site_id' => $this->site['id'],
                                                    'status'  => 1,
													'lang'=>$langCode
                                                )
        );
        $data['departTypeLst'] = $this->config->item('departLstType');
		$dataGallery = $this->gallery->getGallery();
		$dataDepartment = $this->model_site->getDepartmentWithUrlSite();
        $dataAds = $this->ads->getAds(0, 2, array('site_id' => $this->site['id']));
        $dataPartner = $this->partner->getPartner(0, 4, array('site_id' => $this->site['id']));
        $dataTmp = array('dataMenu' => $dataMenu,'langCode' => $langCode,'nameHeader' => $nameHeader,
                            'siteName'=>$this->siteName, 'logo_for_site'=>$data['logo_for_site']);
        $data = array_merge($data, $dataTmp);
        $html  = $this->render('layout/header', $data , true);
        $html .= $this->render(
                            'home/home',
                            compact(
                                'content_01',
                                'content_02',
                                'content_03',
                                'content_04',
                                'content_05',
                                'content_06',
                                'dataSlider',
                                'dataAds',
                                'dataPartner',
                                'positionDisplay',
								'nameHeader',
								$this->siteName,
								'langCode',
								'dataGallery',
								'dataDepartment'
                            ),
                            true
        );
        $html .= $this->render('layout/footer', array(), true);
        $data['content_for_layout'] = $html;
		$data['js_for_layout'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.easing-1.3.js"></script>';
		$data['js_for_layout1'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.jcarousellite.js"></script>';
		$data['js_for_layout2'] = '<script type="text/javascript" src="'.$this->config->base_url().'publics/template/default/js/jquery.mousewheel-3.1.12.js"></script>';
        
		$data['css_for_layout'] = '<link rel="stylesheet" type="text/css" href="'.$this->config->base_url().'publics/template/default/css/style-demo.css">';
		$this->render('layout/default', $data);
    }

}