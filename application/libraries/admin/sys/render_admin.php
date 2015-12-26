<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_admin
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_index()
    {

        $this->temp = new template_render_ajax('admin/index', 'content');

        $this->temp->render_page();

        $this->temp->name_page('Welcome To Admin panel');

        $this->temp->render();

    }

    public function page_university()
    {

        $this->temp = new template_render_ajax('admin/university', 'content');

        $this->temp->render_page();

        $this->temp->name_page('University');

        $this->temp->render();

    }

    public function page_view_student()
    {

        $this->temp = new template_render_ajax('admin/university/view', 'content');

        $this->temp->render_page();

        $this->temp->name_page('University');

        $this->temp->render();

    }

    public function page_college()
    {

        $this->temp = new template_render_ajax('admin/college', 'content');

        $this->temp->render_page();

        $this->temp->name_page('college');

        $this->temp->render();

    }

    public function page_college_view_student()
    {

        $this->temp = new template_render_ajax('admin/college/view', 'content');

        $this->temp->render_page();

        $this->temp->name_page('college');

        $this->temp->render();

    }

    public function page_specialty()
    {

        $this->temp = new template_render_ajax('admin/specialty', 'content');

        $this->temp->render_page();

        $this->temp->name_page('specialty');

        $this->temp->render();

    }

    public function page_specialty_view_student()
    {

        $this->temp = new template_render_ajax('admin/specialty/view', 'content');

        $this->temp->render_page();

        $this->temp->name_page('specialty');

        $this->temp->render();

    }
    public function page_supervisor()
    {

        $this->temp = new template_render_ajax('admin/supervisor', 'content');

        $this->temp->render_page();

        $this->temp->name_page('supervisor');

        $this->temp->render();

    }

    public function page_supervisor_view_student()
    {

        $this->temp = new template_render_ajax('admin/supervisor/view', 'content');

        $this->temp->render_page();

        $this->temp->name_page('supervisor');

        $this->temp->render();

    }

    public function page_companies()
    {

        $this->temp = new template_render_ajax('admin/companies', 'content');

        $this->temp->render_page();

        $this->temp->name_page('companies');

        $this->temp->render();

    }

    public function page_companies_view_student()
    {

        $this->temp = new template_render_ajax('admin/companies/view', 'content');

        $this->temp->render_page();

        $this->temp->name_page('companies');

        $this->temp->render();

    }

    public function page_category()
    {

        $this->temp = new template_render_ajax('admin/category', 'content');

        $this->temp->render_page();

        $this->temp->name_page('category');

        $this->temp->render();

    }

    public function page_department()
    {

        $this->temp = new template_render_ajax('admin/department', 'content');

        $this->temp->render_page();

        $this->temp->name_page('department');

        $this->temp->render();

    }

    public function page_section()
    {

        $this->temp = new template_render_ajax('admin/section', 'content');

        $this->temp->render_page();

        $this->temp->name_page('section');

        $this->temp->render();

    }

    public function page_models()
    {

        $this->temp = new template_render_ajax('admin/models', 'content');

        $this->temp->render_page();

        $this->temp->name_page('models');

        $this->temp->render();

    }

    public function page_onus()
    {

        $this->temp = new template_render_ajax('admin/onus', 'content');

        $this->temp->render_page();

        $this->temp->name_page('onus');

        $this->temp->render();

    }

    public function page_onus_designate()
    {

        $this->temp = new template_render_ajax('admin/onus_designate', 'content');

        $this->temp->render_page();

        $this->temp->name_page('onus designate');

        $this->temp->render();

    }


    public function page_degree()
    {

        $this->temp = new template_render_ajax('admin/degree', 'content');

        $this->temp->render_page();

        $this->temp->name_page('degree');

        $this->temp->render();

    }


   public function page_students()
    {

        $this->temp = new template_render_ajax('admin/students', 'content');

        $this->temp->render_page();

        $this->temp->name_page('students');

        $this->temp->render();

    }

    public function page_trainer()
    {

        $this->temp = new template_render_ajax('admin/trainer', 'content');

        $this->temp->render_page();

        $this->temp->name_page('trainer');

        $this->temp->render();

    }

    public function page_login()
    {

        $this->temp = new template_render_ajax('admin/login', 'content');

        $this->temp->render_page();

        $this->temp->name_page('Login');

        $this->temp->render();

    }


}