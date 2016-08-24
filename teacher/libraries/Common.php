<?php
/**
 * Created by PhpStorm.
 * User: ThinhNK
 * Date: 1/26/15
 * Time: 9:22 PM
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Common{
    private $CI;
    public function __construct() {
        $this->CI = & get_instance();
    }

    function checkPermit($uid, $postID, $postType){
        $uInfo = $this->CI->common_model->getUserInfo($uid);
        if(empty($uInfo)){
            show_error('Bạn cần kiểm tra lại thông tin đăng nhập!');
        }
        if($uInfo['permit'] != -1){
            $postInfo = $this->CI->common_model->getPostInfo($postID);
            if(empty($postInfo)){
                show_error('Không tìm thấy trang bạn yêu cầu!');
            }elseif($postInfo['post_type'] != $postType){
                show_error('Không tìm thấy trang bạn yêu cầu!');
            }elseif($postInfo['user_id'] != $uid){
                show_error('Bạn không có quyền truy cập đến trang này!');
            }
        }
    }

    function checkLogin(){
        if((int) $this->CI->session->userdata('uid') == 0){
            $loginBack = urlencode(getCurrentUrl());
            redirect(site_url('login').'?loginback='.$loginBack);
        }
    }
	
	function isUrl($url) {
		return (preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) ? true : false;
	}
}