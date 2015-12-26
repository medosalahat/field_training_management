<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Students extends CI_Controller {

    private $use;

    public function __construct(){

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/students_lib_ad');

        $session = new class_sessions_admin();

        if(!$session->get_login_admin_in()){

            redirect('admin/home/login');
        }
    }

    public function index(){

        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $page= new render_admin();

            $page->page_students();
        }else{

            redirect('admin/home/login');
        }
    }

    public function ajax_all(){

        $lib = new students_lib_ad();

        $lib->find_all_ajax();


    }

    public function remove(){


        $lib = new students_lib_ad();

        $lib->remove();

    }

    public function update(){

        $lib = new students_lib_ad();

        $lib->update();
    }

    public function insert(){

        $lib = new students_lib_ad();

        $lib->insert();


    }

    public function update_password(){

        $lib = new students_lib_ad();

        $lib->update_password();
    }




}