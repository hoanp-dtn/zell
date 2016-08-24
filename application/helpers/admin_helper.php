<?php

function admin_style() {
    $style = base_url() . 'publics/admin/css/';
    return $style;
}

function admin_js() {
    $style = base_url() . 'publics/admin/js/';
    return $style;
}

function admin_img() {
    $style = base_url() . 'publics/admin/images/';
    return $style;
}

function admin_editor_path() {
    $editor = base_url() . 'publics/tiny_mce/';
    return $editor;
}

function get_admin_lang() {
    $CI = & get_instance();
    $CI->load->helper('cookie');

    $lang = (int) get_cookie('lang_id');

    return $lang;
}

function admin_gallery() {
    $path = base_url() . MYN_UPLOAD_GALLERY;
    return $path;
}

function admin_msg($msg) {
    if ($msg) {
        echo '<div class="msg">';
        echo '<ul>';
        foreach ($msg as $text) {
            echo '<li>' . $text . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}

function admin_thickbox() {
    $th = base_url() . 'publics/thickbox/';
    return $th;
}

/**
 * Hiển thị box để chọn ảnh
 *
 */
function admin_box_img($image = '', $text = '') {

    echo '<tr>';
    echo '<td colspan="2" class="h4">Ảnh minh họa</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Đường dẫn tới ảnh</td>';
    echo '<td>';
    echo '<input type="text" name="pic" value="' . $image . '" class="text" />';
    echo '<a href="' . admin_link('gallery/browser/KeepThis/true/TB_iframe/true/height/450/width/750') . '" title="Chọn ảnh" class="select-img thickbox">Chọn ảnh</a>';
    echo '<div id="img">';
    if ($image != '') {

        $find = 'http://';
        $pos = strpos($image, $find);

        if ($pos !== false)
            echo '<p><a target="_blank" href="' . $image . '"><img src="' . $image . '" alt="" /></a></p>';
        else
            echo '<p><a target="_blank" href="' . admin_gallery() . $image . '"><img src="' . admin_gallery() . $image . '" alt="" /></a></p>';
    }
    echo '</div>';
    echo '<p class="text-desc">http://truesmart/image/demo.jpg</p>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Mô tả cho ảnh</td>';
    echo '<td><input type="text" name="picdesc" value="' . $text . '" maxlength="255" class="text" /></td>';
    echo '</tr>';
}

/**
 * Hiển thị list tin
 *
 */
function admin_cat($cat = 0, $type = 0, &$menu) {
    $CI = & get_instance();

    $data = $CI->cat_model->list_cat_combo($type, $cat);

    if (count($data) > 0) {
        foreach ($data as $dt) {
            $menu[] = $dt;
            admin_cat($dt['id'], $dt['type'], $menu);
        }
    }
}

function admin_cat_combo($array, $curr, $size = 1, $text = 1) {

    if ($text == 1)
        $text = 'Không thuộc chủ đề nào';
    else
        $text = 'Tất cả các bài viết';

    echo '<select size="' . $size . '" name="cat" id="cat" class="combo2">';
    echo '<option value="0" selected="selected"> ' . $text . '</option>';
    if ($array) {
        foreach ($array as $val) {
            echo '<option ';
            if ($curr == $val['id'])
                echo 'selected="selected"';
            echo 'value="' . $val['id'] . '">';
            for ($i = 0; $i < (int) $val['lever']; $i++)
                echo '&mdash;&mdash;';

            echo ' ' . $val['name'];
            echo '</option>';
        }
    }
    echo '</select>';
}

/**
 * Hiển thị popup để chọn ảnh chèn vào bài viết
 *
 */
function thickbox_img() {
    echo '<p><a href="' . admin_link('gallery/editor/KeepThis/true/TB_iframe/true/height/450/width/750') . '" title="Chọn ảnh vào bài viết" class="select-img thickbox">Chọn ảnh</a></p>';
}

/**
 * Đẩy từ khóa lên URL
 *
 */
function admin_up_url($text) {
    $text = trim($text);
    $text = str_replace(' ', '-', $text);
    return $text;
}

/**
 * Tạo ảnh thumb
 *
 */
function image_thumb($imgname, $type, $height, $width) {
    $CI = & get_instance();

    $image_path = 'caches/thumbs/admin/' . $type;
    if (!is_dir($image_path)) {
            mkdir($image_path, 0777);
        }
    $image_thumb = $image_path . '/' . $height . '_' . $width . '_' . $imgname;
    if (!file_exists($image_thumb)) {
        // LOAD LIBRARY
        $CI->load->library('image_lib');

        // CONFIGURE IMAGE LIBRARY
        $config['image_library'] = 'gd2';
        $config['source_image'] = MYN_UPLOAD_GALLERY . $imgname;
        $config['new_image'] = $image_thumb;
        $config['maintain_ratio'] = TRUE;
        $config['height'] = $height;
        $config['width'] = $width;
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        
        $CI->image_lib->clear();
    }

    return '<img src="' . base_url() . $image_thumb . '" alt="" />';
}


function check_login_admin(){
     $CI = &get_instance();
     $crrUrl = getCurrentUrl();
     $crrUrl = urlencode($crrUrl);
     $username = $CI->session->userdata('cp_username');
     $permit = $CI->session->userdata('cp_permit');
     if($username == '' || $permit != -1){
        redirect( admin_link('login?loginback='.$crrUrl), 'refresh');
        die;
     }else{
        return true;
     }
}
?>