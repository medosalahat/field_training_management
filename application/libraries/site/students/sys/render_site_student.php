<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_site_student
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_index()
    {

        $temp = new template_render('site/students/index', 'content');

        $temp->render_page();

        $temp->name_page('Welcome student');

        $temp->render();

    }
}