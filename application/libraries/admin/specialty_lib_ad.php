<?php

class specialty_lib_ad
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
            tpl_specialty::specialty(),
            array(
                tpl_specialty::id(),
                tpl_specialty::active(),
                tpl_specialty::name(),
                tpl_specialty::id_college(),
                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    tpl_specialty::specialty().'.'.tpl_specialty::id_college(),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_specialty::specialty().'_'.tpl_specialty::id()];
        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::id()
            ),array(
                tpl_specialty::id()=>$id
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

        $name =  $_POST[tpl_specialty::specialty().'_'.tpl_specialty::name()];
        $id_college =  $_POST[tpl_specialty::specialty().'_'.tpl_specialty::id_college()];

        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::active()=>0,
                tpl_specialty::name()=>$name,
                tpl_specialty::id_college()=>$id_college,
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

        $id = $_POST[ tpl_specialty::specialty() . '_' . tpl_specialty::id() . '_update'];

        $name = $_POST[ tpl_specialty::specialty() . '_' . tpl_specialty::name() . '_update'];
        $id_college = $_POST[ tpl_specialty::specialty() . '_' . tpl_specialty::id_college() . '_update'];


        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::name()=>$name,
                tpl_specialty::id_college()=>$id_college,
            ),array(
                tpl_specialty::id()=>$id
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

        $id= $_POST[tpl_specialty::specialty().'_'.tpl_specialty::id()];
        $status= $_POST[tpl_specialty::specialty().'_'.tpl_specialty::active()];

        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::active()=>$status,
            ),array(
                tpl_specialty::id()=>$id
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
            tpl_specialty::specialty(),
            array(
                tpl_specialty::id(),
                tpl_specialty::active(),
                tpl_specialty::name(),
                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    tpl_specialty::specialty().'.'.tpl_specialty::id_college(),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),
                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id_specialty(),
                    tpl_specialty::specialty().'.'.tpl_specialty::id(),
                    'COUNT('.tpl_students::id().')',
                    tpl_students::students().'_'.tpl_students::id()
                ),

            )
        );

        echo json_encode($db->get());

    }

    public function find($id){

        $db = new data_base(
            tpl_specialty::specialty(),array(
            "*"
        ),array(
                tpl_specialty::id()=>$id
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
                tpl_students::id_specialty(),
                tpl_students::id_college(),

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
                    tpl_college::college().'_'.tpl_specialty::name()
                ),
            ),array(
                tpl_students::id_specialty()=>$_GET['id']
            )
        );

        echo json_encode($db->get_where());

    }

    public function find_college(){

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::id(),
                tpl_college::active(),
                tpl_college::name(),
            ),array(
                tpl_college::active()=>1
            )
        );

        $data = $db->get_where();

        $w='';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_college::id()].'">'.$row[tpl_college::name()].'</option>';

        }

        return $w;

    }


}