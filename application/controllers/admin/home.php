<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    private $use;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/home_lib_ad');
    }

    public function index()
    {

        $session = new class_sessions_admin();

        if ($session->get_login_admin_in()) {

            $page = new render_admin();

            $page->page_index();
        } else {

            $this->login();
        }
    }

    public function login()
    {


        $session = new class_sessions_admin();

        if (!$session->get_login_admin_in()) {

            $page = new render_admin();

            $page->page_login();

        } else {

            redirect('admin/home');
        }
    }

    public function login_now()
    {

        $this->use->use_lib('admin/user_lib_ad');

        $user = new user_lib_ad();

        if ($user->set(tpl_user_site::user_site() . '_' . tpl_user_site::username(), 'post') &&

            $user->set(tpl_user_site::user_site() . '_' . tpl_user_site::password(), 'post')
        ) {

            echo $user->find_users_login();

        } else {

            echo json_encode(array('valid' => false, 'massage' => class_massage::danger('Oops !!', 'Check Input Now ')));
        }


    }

    public function logout()
    {

        $session = new class_sessions_admin();

        $session->remove_login_admin();

        redirect(site_url('admin/home'));


    }

    public function ajax_category()
    {

        $lib = new home_lib_ad();

        $lib->ajax_category();

    }

    public function ajax_college()
    {

        $lib = new home_lib_ad();

        $lib->ajax_college();

    }

    public function ajax_companies()
    {

        $lib = new home_lib_ad();

        $lib->ajax_companies();

    }

    public function ajax_degree()
    {

        $lib = new home_lib_ad();

        $lib->ajax_degree();

    }


    public function ajax_department()
    {

        $lib = new home_lib_ad();

        $lib->ajax_department();

    }

    public function ajax_models()
    {

        $lib = new home_lib_ad();

        $lib->ajax_models();

    }

    public function ajax_onus()
    {

        $lib = new home_lib_ad();

        $lib->ajax_onus();

    }

    public function ajax_onus_designate()
    {

        $lib = new home_lib_ad();

        $lib->ajax_onus_designate();

    }


}