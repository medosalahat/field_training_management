<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller
{
    private $use;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('site/sys/render_site');

        $this->use->use_lib('site/students/sys/session_students');

        $this->use->use_lib('site/supervisor/sys/session_supervisor');

        $this->use->use_lib('site/students/students_lib');

    }

    public function index(){



        $lib_students = new session_students();

        $lib_supervisor = new session_supervisor();

        if($lib_students->get_login_students()){

            redirect('students/home_stu');

        }else  if($lib_supervisor->get_login_supervisors()){

            redirect('supervisor/home_sup');

        }else{

            $template = new render_site();

            $template->page_index();
        }


    }

    public function get_all_college(){

        $class= new students_lib();

        $class->get_all_college();


    }

    public function get_all_specialty(){

        $class= new students_lib();

        $class->get_all_specialty();


    }


    public function get_all_supervisor(){

        $class= new students_lib();

        $class->get_all_supervisor();


    }

    public function get_all_companies(){

        $class= new students_lib();

        $class->get_all_companies();


    }

    public function get_all_department(){

        $class= new students_lib();

        $class->get_all_department();


    }

    public function get_all_section(){

        $class= new students_lib();

        $class->get_all_section();


    }

    public function new_students(){



        $class= new students_lib();

        $class->new_students();

    }

    public function register_student(){

        echo  md5(md5(md5('2015').md5('28').md5('10')).'123');
    }
}