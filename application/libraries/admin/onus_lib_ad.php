<?php

class onus_lib_ad
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
            tpl_onus::onus(),
            array(
                tpl_onus::id(),
                tpl_onus::active(),
                tpl_onus::name(),
                tpl_onus::description(),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_onus::onus().'_'.tpl_onus::id()];
        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::id()
            ),array(
                tpl_onus::id()=>$id
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

        $name =  $_POST[tpl_onus::onus().'_'.tpl_onus::name()];
        $description =  $_POST[tpl_onus::onus().'_'.tpl_onus::description()];

        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::active()=>0,
                tpl_onus::name()=>$name,
                tpl_onus::description()=>$description,
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

        $id = $_POST[ tpl_onus::onus() . '_' . tpl_onus::id() . '_update'];

        $name = $_POST[ tpl_onus::onus() . '_' . tpl_onus::name() . '_update'];

        $description = $_POST[ tpl_onus::onus() . '_' . tpl_onus::description() . '_update'];


        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::name()=>$name,
                tpl_onus::description()=>$description ,
                tpl_onus::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_onus::id()=>$id
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

        $id= $_POST[tpl_onus::onus().'_'.tpl_onus::id()];
        $status= $_POST[tpl_onus::onus().'_'.tpl_onus::active()];

        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::active()=>$status,
            ),array(
                tpl_onus::id()=>$id
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