<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_site_supervisor
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_index()
    {

        $temp = new template_render('site/supervisor/index', 'content');

        $temp->render_page();

        $temp->name_page('Welcome supervisor');

        $temp->render();

    }
}