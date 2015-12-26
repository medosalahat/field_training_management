<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_sup extends CI_Controller
{
    private $use;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('site/supervisor/sys/render_site_supervisor');

        $this->use->use_lib('site/supervisor/supervisor_lib');

        $this->use->use_lib('site/supervisor/sys/session_supervisor');

    }

    public function index(){

        $lib_supervisor = new session_supervisor();

        if($lib_supervisor->get_login_supervisors()){

            $render_site_supervisor = new render_site_supervisor();

            $render_site_supervisor->page_index();

        }else{

            redirect('site');
        }

    }


    public function login(){

        $lib = new supervisor_lib();

        $lib->login_supervisor();

    }

    public function logout(){

        $lib_supervisor = new session_supervisor();

        $lib_supervisor->remove_login_supervisors();

        redirect('site');
    }
}