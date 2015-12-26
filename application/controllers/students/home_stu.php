<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_stu extends CI_Controller
{
    private $use;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('site/students/sys/render_site_student');

        $this->use->use_lib('site/students/students_lib');

        $this->use->use_lib('site/students/sys/session_students');

    }

    public function index(){

        $lib_students = new session_students();

        if($lib_students->get_login_students()){

            $render_site_student = new render_site_student();

            $render_site_student->page_index();

        }else{

            redirect('site');
        }

    }


    public function login(){

        $lib = new students_lib();

        $lib->login_student();

    }

    public function logout(){

        $lib_students = new session_students();

        $lib_students->remove_login_students();

        redirect('site');
    }
}