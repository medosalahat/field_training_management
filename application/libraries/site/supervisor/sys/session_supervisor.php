<?php

class session_supervisor
{
    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('session');

    }

    public function get_login_supervisors()
    {

        $data = $this->CI->session->userdata('login_supervisor_ftm');


        if (!$data) {

            return 0;
        }

        return 1;
    }

    public function get_login_supervisors_in()
    {

        $data = $this->CI->session->userdata('login_supervisor_ftm');

        if ($data==1) {

            return true;
        }

        return false;
    }

    public function test(){

        print_r($this->CI->session->userdata);
    }

    public function remove_login_supervisors()
    {

        $this->CI->session->set_userdata('login_supervisor_ftm', false);

        $this->CI->session->unset_userdata('login_supervisor_ftm');

        return true;

    }

    public function new_login_supervisors()
    {

        $this->CI->session->set_userdata('login_supervisor_ftm', true);

        return true;

    }

    public function set_id_user($id_user){

        $this->CI->session->set_userdata('id_supervisor_ftm',$id_user);

    }

    public function Get_id_user(){


        return $this->CI->session->userdata('id_supervisor_ftm');

    }
}
