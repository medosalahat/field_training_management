<?php

class college_lib_ad
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
            tpl_college::college(),
            array(
                tpl_college::id(),
                tpl_college::active(),
                tpl_college::name(),

                tpl_college::id_university(),
                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university().'.'.tpl_university::id(),
                    tpl_college::college().'.'.tpl_college::id_university(),
                    tpl_university::name(),
                    tpl_university::university().'_'.tpl_university::name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_college::college().'_'.tpl_college::id()];
        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::id()
            ),array(
                tpl_college::id()=>$id
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

        $name =  $_POST[tpl_college::college().'_'.tpl_college::name()];
        $id_university =  $_POST[tpl_college::college().'_'.tpl_college::id_university()];

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::active()=>0,
                tpl_college::name()=>$name,
                tpl_college::id_university()=>$id_university,
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

        $id = $_POST[ tpl_college::college() . '_' . tpl_college::id() . '_update'];

        $name = $_POST[ tpl_college::college() . '_' . tpl_college::name() . '_update'];
        $id_university = $_POST[ tpl_college::college() . '_' . tpl_college::id_university() . '_update'];


        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::name()=>$name,
                tpl_college::id_university()=>$id_university,
            ),array(
                tpl_college::id()=>$id
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

        $id= $_POST[tpl_college::college().'_'.tpl_college::id()];
        $status= $_POST[tpl_college::college().'_'.tpl_college::active()];

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::active()=>$status,
            ),array(
                tpl_college::id()=>$id
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

    public function ajax_students(){

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::id(),
                tpl_college::active(),
                tpl_college::name(),
                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id_college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    'COUNT('.tpl_students::id().')',
                    tpl_students::students().'_'.tpl_students::id()
                ),

            )
        );

        echo json_encode($db->get());

    }

    public function find($id){

        $db = new data_base(
            tpl_college::college(),array(
                "*"
            ),array(
                tpl_college::id()=>$id
            )
        );

        $results = $db->get_where();

        if(!empty($results)){

            return $results;

        }else{

            return false;

        }

    }

    public function ajax_find_students(){

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id(),
                tpl_students::first_name(),
                tpl_students::last_name(),
                tpl_students::id_college(),
                tpl_students::id_specialty(),

                data_base::select_multiple_table(
                    tpl_specialty::specialty(),
                    tpl_specialty::specialty().'.'.tpl_specialty::id(),
                    tpl_students::students().'.'.tpl_students::id_specialty(),
                    tpl_specialty::name(),
                    tpl_specialty::specialty().'_'.tpl_specialty::name()
                ),
                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    tpl_students::students().'.'.tpl_students::id_college(),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),
            ),array(
                tpl_students::id_college()=>$_GET['id']
            )
        );

        echo json_encode($db->get_where());

    }




}