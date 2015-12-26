<?php

class trainer_lib_ad
{
    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('system/date_time/date_time');
    }

    public function find_all_ajax()
    {

        $db = new data_base(
            tpl_trainer::trainer(),
            array(
                tpl_trainer::id(),
                tpl_trainer::status(),
                tpl_trainer::name(),
                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department() . '.' . tpl_department::id(),
                    tpl_trainer::trainer() . '.' . tpl_trainer::id_department(),
                    tpl_department::name(),
                    tpl_department::department() . '_' . tpl_department::name()
                ),

                data_base::select_multiple_table(
                    tpl_section::section(),
                    tpl_section::section() . '.' . tpl_section::id(),
                    tpl_trainer::trainer() . '.' . tpl_trainer::id_section(),
                    tpl_section::name(),
                    tpl_section::section() . '_' . tpl_section::name()
                ),

                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies() . '.' . tpl_companies::id(),
                    tpl_trainer::trainer() . '.' . tpl_trainer::id_companies(),
                    tpl_companies::name(),
                    tpl_companies::companies() . '_' . tpl_companies::name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_trainer::trainer().'_'.tpl_trainer::id()];
        $db = new data_base(
            tpl_trainer::trainer(),
            array(
                tpl_trainer::id()
            ),array(
                tpl_trainer::id()=>$id
            )
        );

        $data = $db->delete();

        if($data){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Deleted '

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not Update, please try again'
                )
            );

        }
    }

    public function insert()
    {

        $name =  $_POST[tpl_trainer::trainer().'_'.tpl_trainer::name()];

        $username =  $_POST[tpl_trainer::trainer().'_'.tpl_trainer::username()];

        $id_companies =  $_POST[tpl_trainer::trainer().'_'.tpl_trainer::id_companies()];

        $id_department =  $_POST[tpl_trainer::trainer().'_'.tpl_trainer::id_department()];

        $id_section =  $_POST[tpl_trainer::trainer().'_'.tpl_trainer::id_section()];


        $db = new data_base(
            tpl_trainer::trainer(),
            array(
                tpl_trainer::status()=>0,
                tpl_trainer::name()=>$name,
                tpl_trainer::username()=>$username,
                tpl_trainer::id_companies()=>$id_companies,
                tpl_trainer::id_department()=>$id_department,
                tpl_trainer::id_section()=>$id_section,
                tpl_trainer::date_in()=>date_time::Date_time_24(),
            )
        );

        $results = $db->add();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Add '.$name

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$name.', please try again'
                )
            );

        }

    }

    public function update()
    {

        $id = $_POST[tpl_trainer::trainer() . '_' . tpl_trainer::id() . '_update'];

        $name = $_POST[tpl_trainer::trainer() . '_' . tpl_trainer::name() . '_update'];

        $id_companies = $_POST[tpl_trainer::trainer() . '_' . tpl_trainer::id_companies() . '_update'];

        $id_department = $_POST[tpl_trainer::trainer() . '_' . tpl_trainer::id_department() . '_update'];

        $id_section = $_POST[tpl_trainer::trainer() . '_' . tpl_trainer::id_section() . '_update'];


        $db = new data_base(
            tpl_trainer::trainer(),
            array(
                tpl_trainer::name()=>$name,
                tpl_trainer::id_companies()=>$id_companies,
                tpl_trainer::id_department()=>$id_department,
                tpl_trainer::id_section()=>$id_section,
                tpl_trainer::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_trainer::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$name
                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not Update '.$name.', please try again'
                )
            );

        }
    }

    public function update_status(){

        $id= $_POST[tpl_trainer::trainer().'_'.tpl_trainer::id()];
        $status= $_POST[tpl_trainer::trainer().'_'.tpl_trainer::status()];

        $db = new data_base(
            tpl_trainer::trainer(),
            array(
                tpl_trainer::status()=>$status,
            ),array(
                tpl_trainer::id()=>$id
            )
        );

        $results = $db->change();

        $status_data = $status == 1 ? 'active' : 'dative';

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$status_data

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not Update '.$status_data.', please try again'
                )
            );

        }

    }


    public function find($id){

        $db = new data_base(
            tpl_trainer::trainer(),array(
            "*"
        ),array(
                tpl_trainer::trainer()=>$id
            )
        );

        $results = $db->get_where();

        if(!empty($results)){

            return $results;

        }else{

            return false;

        }

    }


}