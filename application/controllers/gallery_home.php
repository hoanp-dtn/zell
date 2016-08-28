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

	

    function index(){

       $this->setInformationSite($data);

        $langCode = $this->lang->lang();	

		$nameHeader = $this->model_site->getNameHeader($this->site['id']);//get name header

		// menu

		$dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode, $this->site['id']), $langCode, $this->site['id']);

		

		// data post

		

		// tin moi nhat

		$getPostAndNew = $this->posts_home_model->showPostAndNew($this->site['id'], 5, $langCode);

		

		// quang cao

        $dataAds = $this->ads->getAds(0, 2, array('site_id' => $this->site['id']));

		

		// doi tac

        $dataPartner = $this->partner->getPartner(0, 4, array('site_id' => $this->site['id']));



        $dataTmp = array('dataMenu' => $dataMenu,'langCode' => $langCode,'nameHeader' => $nameHeader,

                            'siteName'=>$this->siteName, 'logo_for_site'=>$data['logo_for_site']);

        $data = array_merge($data, $dataTmp);

        $html  = $this->render('layout/header', $data , true);



		

		$dataDepartment = $this->model_site->getDepartmentWithUrlSite();

		// gallery

		$dataGallery = $this->gallery->getGallery();

        $html .= $this->render('home/gallery',array('dataDepartment'=>$dataDepartment,'langCode'=>$langCode,'getPostAndNew' => $getPostAndNew,'dataAds' => $dataAds, 'dataPartner' => $dataPartner,'dataGallery' => $dataGallery),true

        );

        $html .= $this->render('layout/footer', $data, true);

        $data['content_for_layout'] = $html;

        $data['css_for_layout'] = '<link rel="stylesheet" type="text/css" href="'.$this->config->base_url().'publics/template/default/gallery.css">';

        $this->render('layout/default', $data);

    }

    public function photo($value='')
    {
        $this->setInformationSite($data);
        $langCode = $this->lang->lang();
        $dataMenu = $this->navigation_home_model->getListMenu($this->navigation_home_model->getListChild(0,$langCode), $langCode);
         $dataTmp = array('dataMenu' => $dataMenu,'langCode' => $langCode);
        $data = array_merge($data, $dataTmp);
        $dataGallery = $this->gallery->getGallery();
        $html  = $this->render('layout/slider', $data , true);
        $html .="<div class='container'>";

        $html  .= $this->render('layout/menu_header', $data , true);
        $html  .= $this->render('layout/menu_main', $data , true);

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

}