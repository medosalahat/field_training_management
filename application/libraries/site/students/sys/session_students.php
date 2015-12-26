<?php

class session_students
{
    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $index = 'session';

        $this->use->use_lib($index);

    }

    public function get_login_students()
    {

        $data = $this->CI->session->userdata('login_student_ftm');


        if (!$data) {

            return 0;
        }

        return 1;
    }

    public function get_login_students_in()
    {

        $data = $this->CI->session->userdata('login_student_ftm');

        if ($data==1) {

            return true;
        }

        return false;
    }



    public function remove_login_students()
    {

        $this->CI->session->set_userdata('login_student_ftm', false);

        $this->CI->session->unset_userdata('login_student_ftm');

        return true;

    }

    public function new_login_students()
    {

        $this->CI->session->set_userdata('login_student_ftm', true);

        return true;

    }

    public function set_id_user($id_user){

        $this->CI->session->set_userdata('id_student_ftm',$id_user);

    }

    public function Get_id_user(){


        return $this->CI->session->userdata('id_student_ftm');

    }
}
