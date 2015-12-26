<?php

class supervisor_lib_ad
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
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::id(),

                tpl_supervisor::active(),

                tpl_supervisor::name(),

                tpl_supervisor::id_college(),

                tpl_supervisor::id_university(),

                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id_college(),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university().'.'.tpl_university::id(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id_university(),
                    tpl_university::name(),
                    tpl_university::university().'_'.tpl_university::name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_supervisor::supervisor().'_'.tpl_supervisor::id()];
        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::id()
            ),array(
                tpl_supervisor::id()=>$id
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

        $name =  $_POST[tpl_supervisor::supervisor().'_'.tpl_supervisor::name()];
        $id_college =  $_POST[tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college()];
        $id_university =  $_POST[tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university()];

        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::active()=>0,
                tpl_supervisor::name()=>$name,
                tpl_supervisor::id_college()=>$id_college,
                tpl_supervisor::id_university()=>$id_university,
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

        $id = $_POST[ tpl_supervisor::supervisor() . '_' . tpl_supervisor::id() . '_update'];

        $name = $_POST[ tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() . '_update'];

        $id_college = $_POST[ tpl_supervisor::supervisor() . '_' . tpl_supervisor::id_college() . '_update'];

        $id_university = $_POST[ tpl_supervisor::supervisor() . '_' . tpl_supervisor::id_university() . '_update'];


        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::name()=>$name,
                tpl_supervisor::id_college()=>$id_college,
                tpl_supervisor::id_university()=>$id_university,
            ),array(
                tpl_supervisor::id()=>$id
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

        $id= $_POST[tpl_supervisor::supervisor().'_'.tpl_supervisor::id()];
        $status= $_POST[tpl_supervisor::supervisor().'_'.tpl_supervisor::active()];

        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::active()=>$status,
            ),array(
                tpl_supervisor::id()=>$id
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
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::id(),
                tpl_supervisor::name(),
                tpl_supervisor::id_university(),
                tpl_supervisor::id_college(),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id_supervisor(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id(),
                    'COUNT('.tpl_students::id().')',
                    tpl_students::students().'_'.tpl_students::id()
                ),
                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id_college(),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university().'.'.tpl_university::id(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id_university(),
                    tpl_university::name(),
                    tpl_university::university().'_'.tpl_university::name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function find($id){

        $db = new data_base(
            tpl_supervisor::supervisor(),array(
            "*"
        ),array(
                tpl_supervisor::id()=>$id
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
                tpl_students::id_supervisor()=>$_GET['id']
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

    public function find_university(){

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

        $w='';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_university::id()].'">'.$row[tpl_university::name()].'</option>';

        }

        return $w;

    }


}