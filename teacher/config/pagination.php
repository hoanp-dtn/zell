<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ThinhNK
 * Date: 3/8/15
 * Time: 5:51 PM
 */

// $config['pagination']['base_url'] = '';
// $config['pagination']['total_rows'] = 0;
// $config['pagination']['per_page'] = 20;
// $config['pagination']['per_page_detail'] = 6 ;
// $config['pagination']['use_page_numbers'] = TRUE;
// $config['pagination']['page_query_string'] = TRUE;
// $config['pagination']['query_string_segment'] = 'page';
// $config['pagination']['cur_tag_open'] = '<span class="active_tnt_link">';
// $config['pagination']['cur_tag_close'] = '</span>';


$config['pagination']['full_tag_open']='<div class="row"><div class="col-xs-12"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination pull-right">';
$config['pagination']['full_tag_close']='</ul></div></div></div>';
$config['pagination']['first_link']='';
$config['pagination']['first_tag_open']='';
$config['pagination']['first_tag_close']='';
$config['pagination']['last_link']='';
$config['pagination']['last_tag_open']='';
$config['pagination']['last_tag_close']='';
$config['pagination']['next_link']='Next → ';
$config['pagination']['next_tag_open']='<li class="next">';
$config['pagination']['next_tag_close']='</li>';
$config['pagination']['prev_link']='← Previous';
$config['pagination']['prev_tag_open']='<li class="prev">';
$config['pagination']['pre_tag_close']='</li>';
$config['pagination']['cur_tag_open']='<li class="active"><a>';
$config['pagination']['cur_tag_close']='</a></li>';
$config['pagination']['num_tag_open']='<li>';
$config['pagination']['num_tag_close']='</li>';
$config['pagination']['use_page_number']= true;
$config['pagination']['use_page_numbers'] = TRUE;
$config['pagination']['per_page'] = 1;
$config['pagination']['num_link']=7;
$config['pagination']['uri_segment']=4;