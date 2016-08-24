<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['data'] = array (
 'adzone' => array(
       '0' => array(
        'name' => '-- Chọn vùng hiển thị --'
       ),
       'banner_top_left' => array(
            'name' => 'Quảng cáo trang chủ nội dung bên trái '
       ),
       'banner_top_right' => array(
            'name' => 'Quảng cáo trang chủ nội dung bên phải'
       ),
	   // 'banner_top_left_content' => array(
            // 'name' => 'Quảng cáo trang chủ nội dung vùng biên bên trái'
       // ),
	   // 'banner_top_right_content' => array(
            // 'name' => 'Quảng cáo trang chủ nội dung vùng biên bên phải'
       // ),
 )
);



// config loại đơn vị phòng ban

$config['departLstType'] = array(
  'phong-ban' => 'Phòng ban',
	'khoa' => 'Khoa',
	'bomon' => 'Bộ môn',
	'csdt' => 'Cơ sở đào tạo',
	'trung-tam' => 'Trung tâm',
);