<?php

class department_lib_ad
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
            tpl_department::department(),
            array(
                tpl_department::id(),
                tpl_department::active(),
                tpl_department::name(),
                tpl_department::id_companies(),
                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies().'.'.tpl_companies::id(),
                    tpl_department::department().'.'.tpl_department::id_companies(),
                    tpl_companies::name(),
                    tpl_companies::companies().'_'.tpl_companies::name()
                )
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_department::department().'_'.tpl_department::id()];
        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::id()
            ),array(
                tpl_department::id()=>$id
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

        $name =  $_POST[tpl_department::department().'_'.tpl_department::name()];
        $id_companies =  $_POST[tpl_department::department().'_'.tpl_department::id_companies()];

        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::active()=>0,
                tpl_department::name()=>$name,
                tpl_department::id_companies()=>$id_companies,

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

        $id = $_POST[ tpl_department::department() . '_' . tpl_department::id() . '_update'];

        $name = $_POST[ tpl_department::department() . '_' . tpl_department::name() . '_update'];
        $id_companies = $_POST[ tpl_department::department() . '_' . tpl_department::id_companies() . '_update'];


        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::name()=>$name,
                tpl_department::id_companies()=>$id_companies,

            ),array(
                tpl_department::id()=>$id
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

        $id= $_POST[tpl_department::department().'_'.tpl_department::id()];
        $status= $_POST[tpl_department::department().'_'.tpl_department::active()];

        $db = new data_base(
            tpl_department::department(),
            array(
                tpl_department::active()=>$status,
            ),array(
                tpl_department::id()=>$id
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
            tpl_department::department(),array(
            "*"
        ),array(
                tpl_department::id()=>$id
            )
        );

        $results = $db->get_where();

        if(!empty($results)){

            return $results;

        }else{

            return false;

        }

    }

    public function find_companies(){

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::id(),
                tpl_companies::active(),
                tpl_companies::name(),
            ),array(
                tpl_companies::active()=>1
            )
        );

        $data = $db->get_where();

        $w='';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_companies::id()].'">'.$row[tpl_companies::name()].'</option>';

        }

        return $w;

    }


}