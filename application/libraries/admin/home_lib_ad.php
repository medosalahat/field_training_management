<?php
class home_lib_ad
{
    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');
    }

    public function ajax_category(){

        $db = new data_base(
            tpl_category::category(),
            array(
                tpl_category::id(),
                tpl_category::name()
            )
        );

        echo json_encode($db->get());

    }

    public function ajax_college(){

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::id(),
                tpl_college::name(),

                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university().'.'.tpl_university::id(),
                    tpl_college::college().'.'.tpl_college::id_university(),
                    tpl_university::name(),
                    tpl_university::university().'_'.tpl_university::name()
                )
            ),array(
                tpl_college::active()=>1
            )
        );

        echo json_encode($db->get_where());

    }

    public function ajax_companies(){

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::id(),

                data_base::select_multiple_table(
                    tpl_category::category(),
                    tpl_category::category().'.'.tpl_category::id(),
                    tpl_companies::companies().'.'.tpl_companies::id_category(),
                    tpl_category::name(),
                    tpl_category::category().'_'.tpl_category::name()
                ),
                tpl_companies::name()
            ),array(
                tpl_companies::active()=>1
            )
        );

        echo  json_encode($db->get_where());

    }

    public function ajax_degree(){

        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::id(),
                tpl_degree::name(),
                tpl_degree::star_number()
            ),array(
                tpl_degree::active()=>1
            )
        );

        echo  json_encode($db->get_where());

    }

    public function ajax_department(){

        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::id(),
                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies().'.'.tpl_companies::id(),
                    tpl_department::department().'.'.tpl_department::id_companies(),
                    tpl_companies::name(),
                    tpl_companies::companies().'_'.tpl_companies::name()
                ),
                tpl_department::name()
            ),array(
                tpl_department::active()=>1
            )
        );

        echo  json_encode($db->get_where());

    }

    public function ajax_models(){

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id(),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id(),
                    tpl_models::models().'.'.tpl_models::id_student(),
                    tpl_students::first_name(),
                    tpl_students::students().'_'.tpl_students::first_name()
                ),

                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies().'.'.tpl_companies::id(),
                    tpl_models::models().'.'.tpl_models::id_companies(),
                    tpl_companies::name(),
                    tpl_companies::companies().'_'.tpl_companies::name()
                ),

                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department().'.'.tpl_department::id(),
                    tpl_models::models().'.'.tpl_models::id_department(),
                    tpl_department::name(),
                    tpl_department::department().'_'.tpl_department::name()
                ),

                data_base::select_multiple_table(
                    tpl_section::section(),
                    tpl_section::section().'.'.tpl_section::id(),
                    tpl_models::models().'.'.tpl_models::id_section(),
                    tpl_section::name(),
                    tpl_section::section().'_'.tpl_section::name()
                ),

                data_base::select_multiple_table(
                    tpl_supervisor::supervisor(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id(),
                    tpl_models::models().'.'.tpl_models::id_supervisor(),
                    tpl_supervisor::name(),
                    tpl_supervisor::supervisor().'_'.tpl_supervisor::name()
                ),


            ),array(
                tpl_models::active()=>1
            )
        );

        echo  json_encode($db->get_where());

    }

    public function ajax_onus(){

        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::id(),
                tpl_onus::name(),
                tpl_onus::description(),
            ),array(
                tpl_onus::active()=>1
            )
        );

        echo json_encode($db->get_where());

    }

    public function ajax_onus_designate(){

        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id(),
                    tpl_onus_designate::onus_designate().'.'.tpl_onus_designate::id_student(),
                    tpl_students::first_name(),
                    tpl_students::students().'_'.tpl_students::first_name()
                ),

                data_base::select_multiple_table(
                    tpl_degree::degree(),
                    tpl_degree::degree().'.'.tpl_degree::id(),
                    tpl_onus_designate::onus_designate().'.'.tpl_onus_designate::id_degree(),
                    tpl_degree::name(),
                    tpl_degree::degree().'_'.tpl_degree::name()
                ),

                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department().'.'.tpl_department::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models().'.'.tpl_models::id(),
                        tpl_onus_designate::onus_designate().'.'.tpl_onus_designate::id_models(),
                        tpl_models::id_department()
                    ),
                    tpl_department::name(),
                    tpl_department::department().'_'.tpl_department::name()
                ),

                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies().'.'.tpl_companies::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models().'.'.tpl_models::id(),
                        tpl_onus_designate::onus_designate().'.'.tpl_onus_designate::id_models(),
                        tpl_models::id_companies()
                    ),
                    tpl_companies::name(),
                    tpl_companies::companies().'_'.tpl_companies::name()
                ),

                data_base::select_multiple_table(
                    tpl_section::section(),
                    tpl_section::section().'.'.tpl_section::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models().'.'.tpl_models::id(),
                        tpl_onus_designate::onus_designate().'.'.tpl_onus_designate::id_models(),
                        tpl_models::id_section()
                    ),
                    tpl_section::name(),
                    tpl_section::section().'_'.tpl_section::name()
                ),

                data_base::select_multiple_table(
                    tpl_supervisor::supervisor(),
                    tpl_supervisor::supervisor().'.'.tpl_section::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models().'.'.tpl_models::id(),
                        tpl_onus_designate::onus_designate().'.'.tpl_onus_designate::id_models(),
                        tpl_models::id_supervisor()
                    ),
                    tpl_supervisor::name(),
                    tpl_supervisor::supervisor().'_'.tpl_supervisor::name()
                )
            )
        );

        echo  json_encode($db->get());

    }

    public function ajax_section(){

        $db = new data_base(
            tpl_section::section(),
            array(
                tpl_section::id()
            )
        );

        return count($db->get());

    }

    public function ajax_specialty(){

        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::id()
            ),array(
                tpl_specialty::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function ajax_students(){

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id()
            )
        );

        return count($db->get());

    }

    public function ajax_supervisor(){

        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::id()
            ),array(
                tpl_supervisor::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function ajax_university(){

        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::id()
            ),array(
                tpl_university::active()=>1
            )
        );

        return count($db->get_where());

    }

    /**@counter functions*/

    public function count_category(){

        $db = new data_base(
            tpl_category::category(),
            array(
                tpl_category::id()
            ),array(
                tpl_category::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_college(){

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::id()
            ),array(
                tpl_college::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_companies(){

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::id()
            ),array(
                tpl_companies::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_degree(){

        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::id()
            ),array(
                tpl_degree::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_department(){

        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::id()
            ),array(
                tpl_department::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_models(){

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id()
            ),array(
                tpl_models::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_onus(){

        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::id()
            ),array(
                tpl_onus::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_onus_designate(){

        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::id()
            )
        );

        return count($db->get());

    }

    public function count_section(){

        $db = new data_base(
            tpl_section::section(),
            array(
                tpl_section::id()
            )
        );

        return count($db->get());

    }

    public function count_specialty(){

        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::id()
            ),array(
            tpl_specialty::active()=>1
        )
        );

        return count($db->get_where());

    }

    public function count_students(){

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id()
            )
        );

        return count($db->get());

    }

    public function count_supervisor(){

        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::id()
            ),array(
                tpl_supervisor::active()=>1
            )
        );

        return count($db->get_where());

    }

    public function count_university(){

        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::id()
            ),array(
                tpl_university::active()=>1
            )
        );

        return count($db->get_where());

    }

    /**@counter functions*/
}