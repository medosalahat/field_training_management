<?php

class section_lib_ad
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
            tpl_section::section(),
            array(
                tpl_section::id(),
                tpl_section::active(),
                tpl_section::name(),
                tpl_section::id_department(),
                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department().'.'.tpl_department::id(),
                    tpl_section::section().'.'.tpl_section::id_department(),
                    tpl_department::name(),
                    tpl_department::department().'_'.tpl_department::name()
                )
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_section::section().'_'.tpl_section::id()];
        $db = new data_base(
            tpl_section::section(),
            array(
                tpl_section::id()
            ),array(
                tpl_section::id()=>$id
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

        $name =  $_POST[tpl_section::section().'_'.tpl_section::name()];
        $id_department =  $_POST[tpl_section::section().'_'.tpl_section::id_department()];

        $db = new data_base(
            tpl_section::section(),
            array(
                tpl_section::active()=>0,
                tpl_section::name()=>$name,
                tpl_section::id_department()=>$id_department,

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

        $id = $_POST[ tpl_section::section() . '_' . tpl_section::id() . '_update'];

        $name = $_POST[ tpl_section::section() . '_' . tpl_section::name() . '_update'];
        $id_department = $_POST[ tpl_section::section() . '_' . tpl_section::id_department() . '_update'];


        $db = new data_base(
            tpl_section::section(),
            array(
                tpl_section::name()=>$name,
                tpl_section::id_department()=>$id_department,

            ),array(
                tpl_section::id()=>$id
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

        $id= $_POST[tpl_section::section().'_'.tpl_section::id()];
        $status= $_POST[tpl_section::section().'_'.tpl_section::active()];

        $db = new data_base(
            tpl_section::section(),
            array(
                tpl_section::active()=>$status,
            ),array(
                tpl_section::id()=>$id
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
            tpl_section::section(),array(
            "*"
        ),array(
                tpl_section::id()=>$id
            )
        );

        $results = $db->get_where();

        if(!empty($results)){

            return $results;

        }else{

            return false;

        }

    }

    public function find_department(){

        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::id(),
                tpl_department::active(),
                tpl_department::name(),
            ),array(
                tpl_department::active()=>1
            )
        );

        $data = $db->get_where();

        $w='';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_department::id()].'">'.$row[tpl_department::name()].'</option>';

        }

        return $w;

    }


}