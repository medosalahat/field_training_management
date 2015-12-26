<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_site
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_index()
    {

        $this->temp = new template_render('site/index', 'content');

        $this->temp->render_page();

        $this->temp->name_page('Field Training Management');

        $this->temp->render();

    }

    public function page_login()
    {

        $this->temp = new template_render('admin/login', 'content');

        $this->temp->render_page();

      //  $this->temp->name_page('Login');

        $this->temp->render();

    }


}