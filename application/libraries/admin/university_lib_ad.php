<?php

class university_lib_ad
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
            tpl_university::university(),
            array(
                tpl_university::id(),
                tpl_university::active(),
                tpl_university::address(),
                tpl_university::date_in(),
                tpl_university::name(),
                tpl_university::phone(),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_university::university().'_'.tpl_university::id()];
        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::id()
            ),array(
                tpl_university::id()=>$id
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
        $address =  $_POST[tpl_university::university().'_'.tpl_university::address()];
        $name =  $_POST[tpl_university::university().'_'.tpl_university::name()];
        $phone =  $_POST[tpl_university::university().'_'.tpl_university::phone()];



        $db = new data_base(
            tpl_university::university(),
            array(

                tpl_university::active()=>0,
                tpl_university::address()=>$address,
                tpl_university::name()=>$name,
                tpl_university::phone()=>$phone,
                tpl_university::date_in()=>date_time::Date_time_24(),
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

        $id = $_POST[ tpl_university::university() . '_' . tpl_university::id() . '_update'];
        $phone = $_POST[ tpl_university::university() . '_' . tpl_university::phone() . '_update'];
        $name = $_POST[ tpl_university::university() . '_' . tpl_university::name() . '_update'];
        $address = $_POST[ tpl_university::university() . '_' . tpl_university::address() . '_update'];

        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::name()=>$name,
                tpl_university::address()=>$address,
                tpl_university::phone()=>$phone,
                tpl_university::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_university::id()=>$id
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

        $id= $_POST[tpl_university::university().'_'.tpl_university::id()];
        $status= $_POST[tpl_university::university().'_'.tpl_university::active()];

        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::active()=>$status,
                tpl_university::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_university::id()=>$id
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
            tpl_university::university(),
            array(
                tpl_university::id(),
                tpl_university::active(),
                tpl_university::address(),
                tpl_university::date_in(),
                tpl_university::name(),
                tpl_university::phone(),
                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id_university(),
                    tpl_university::university().'.'.tpl_university::id(),
                    'COUNT('.tpl_students::id().')',
                    tpl_students::students().'_'.tpl_students::id()
                ),

            )
        );

        echo json_encode($db->get());

    }

    public function find($id){

        $db = new data_base(
            tpl_university::university(),array(
                "*"
            ),array(
                tpl_university::id()=>$id
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
                tpl_students::id_university()=>$_GET['id']
            )
        );

        echo json_encode($db->get_where());

    }

    public function select(){

        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::id(),
                tpl_university::name(),

            ),array(
                tpl_university::active()=>1
            )
        );

        $data = $db->get_where();

        $w = '<option value="">Select '.tpl_university::university().'</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_university::id()].'">'.$row[tpl_university::name()].'</option>';

        }

        return $w;
    }



}