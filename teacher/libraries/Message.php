<?php
/**
 * Created by PhpStorm.
 * User: ThinhNK
 * Date: 3/8/15
 * Time: 4:25 PM
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Message{
    private $CI, $data;
    public function __construct() {
        $this->CI = & get_instance();
        $this->data = $this->CI->session->userdata('message');
    }

    function setSuccess($msg){
        $this->data['success'] = $msg;
        $this->CI->session->set_userdata('message', $this->data );
    }

    function setError($msg){
        $this->data['error'] = $msg;
        $this->CI->session->set_userdata('message', $this->data );
    }

    function reset(){
        $this->data = array();
        $this->CI->session->set_userdata('message', $this->data );
    }
    function getAndReset(){
        $data = $this->CI->session->userdata('message');
        $this->reset();
        return $data;
    }
}
