<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dt_library
{
    private $CI;
    
    public function __construct()
    {
        $this->CI=&get_instance();
    }

    public function make_login_session($user)
    {
        if($this->CI->session->userdata('id')!=NULL) return;
        $this->CI->session->set_userdata(array(
            'id'=>$user->id,
            'name'=>$user->name
        ));
    }

    public function unset_login_session()
    {
        $this->CI->session->unset_userdata(array(
            'id',
            'name'
        ));
    }

    public function is_login()
    {
        if($this->CI->session->userdata('id')==NULL) return FALSE;
        else return TRUE;
    }
}
?>