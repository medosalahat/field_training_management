<?php

class degree_lib_ad
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

    public function find_all()
    {

    }

    public function find_all_ajax()
    {

        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::id(),
                tpl_degree::active(),
                tpl_degree::name(),
                tpl_degree::star_number(),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_degree::degree().'_'.tpl_degree::id()];
        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::id()
            ),array(
                tpl_degree::id()=>$id
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

        $name =  $_POST[tpl_degree::degree().'_'.tpl_degree::name()];
        $star_number =  $_POST[tpl_degree::degree().'_'.tpl_degree::star_number()];

        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::active()=>0,
                tpl_degree::name()=>$name,
                tpl_degree::star_number()=>$star_number,
                tpl_degree::date_in()=>date_time::Date_time_24(),
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

        $id = $_POST[ tpl_degree::degree() . '_' . tpl_degree::id() . '_update'];

        $name = $_POST[ tpl_degree::degree() . '_' . tpl_degree::name() . '_update'];

        $star_number = $_POST[ tpl_degree::degree() . '_' . tpl_degree::star_number() . '_update'];


        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::name()=>$name,
                tpl_degree::star_number()=>$star_number,
                tpl_degree::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_degree::id()=>$id
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

        $id= $_POST[tpl_degree::degree().'_'.tpl_degree::id()];
        $status= $_POST[tpl_degree::degree().'_'.tpl_degree::active()];

        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::active()=>$status,
            ),array(
                tpl_degree::id()=>$id
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

}