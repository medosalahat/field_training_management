<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {

    private $use;

    public function __construct(){

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/category_lib_ad');

        $session = new class_sessions_admin();

        if(!$session->get_login_admin_in()){

            redirect('admin/home/login');
        }
    }

    public function index(){

        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $page= new render_admin();

            $page->page_category();
        }else{

            redirect('admin/home/login');
        }
    }

    public function ajax_all(){

        $lib = new category_lib_ad();

        $lib->find_all_ajax();


    }

    public function remove(){


        $lib = new category_lib_ad();

        $lib->remove();

    }

    public function update(){

        $lib = new category_lib_ad();

        $lib->update();
    }

    public function insert(){
        $lib = new category_lib_ad();

        $lib->insert();


    }

    public function update_status(){
        $lib = new category_lib_ad();

        $lib->update_status();
    }




}