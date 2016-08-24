<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller {
    private $data;
    function Comment() {
        parent::__construct ();
        $this->load->library('Homelayout');
        $this->lang->load('home');
        $this->load->model('comment_model');
    }
	
    function add(){
		$captcha = $this->input->post('captcha');
		$captchasave = $this->session->userdata('captcha_code_home');
		$name = getSaveSqlStr($this->input->post('name', true));
		$email = getSaveSqlStr($this->input->post('email', true));
		$detail = getSaveSqlStr($this->input->post('detail', true));
		$site_id = (int) $this->input->post('site_id');
		$post_id = (int) $this->input->post('post_id');
		if(is_bool($name) || is_bool($email) || is_bool($detail) || is_bool($site_id) || is_bool($post_id)){
			echo "Bình luận thất bại. Xin hãy bình luận lại lại !";
			redirect($this->config->base_url());
			return;
		}
		if ($captcha != $captchasave){
			echo "Captcha không đúng !";
			return;
		}	
		$time = time();
		$array = array(
			'name' => $name,
			'email'    => $email,
			'detail'    => $detail,
			'site_id'    => $site_id,
			'post_id'    => $post_id,
			'status' => 0,
			'time_created'=> $time
		);
		$flag = $this->comment_model->add($array);
		echo $flag;
    }
	
	function captcha()
	{
	 $md5_hash = md5(rand(0,999));
	 $security_code = substr($md5_hash, 15, 5);
	 $_SESSION["security_code"] = $security_code;
	 $this->session->set_userdata('captcha_code_home', $security_code);
	 $width = 60;
	 $height = 30;
	 $image = ImageCreate($width, $height);
	 $fontcolor = ImageColorAllocate($image, 255, 255, 255);
	 $bgcolor = ImageColorAllocate($image, 0, 0, 0);
	 ImageFill($image, 0, 0, $bgcolor);
	 ImageString($image, 5, 8, 6, $security_code, $fontcolor);
	 for($i=0;$i<20;$i++) imageline ($image , rand(0,80), rand(0,80), rand(0,80), rand(0,80), ImageColorAllocate($image, rand(0,255), rand(0,255), rand(0,255)));
	 header("Content-Type: image/jpeg");
	 ImageJpeg($image);
	 ImageDestroy($image);
	}
}