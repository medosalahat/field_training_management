<?php

class models_lib_ad
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
            tpl_models::models(),
            array(
                tpl_models::id(),
                tpl_models::active(),
                tpl_models::id_student(),
                tpl_models::id_companies(),
                tpl_models::id_department(),
                tpl_models::id_section(),
                tpl_models::id_supervisor(),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id(),
                    tpl_models::models().'.'.tpl_models::id_student(),
                    tpl_students::first_name(),
                    tpl_students::students().'_'.tpl_students::first_name()
                ),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id(),
                    tpl_models::models().'.'.tpl_models::id_student(),
                    tpl_students::last_name(),
                    tpl_students::students().'_'.tpl_students::last_name()
                ),

                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university().".".tpl_university::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_university()
                    ),
                    tpl_university::name(),
                    tpl_university::university().'_'.tpl_university::name()
                ),

                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().".".tpl_college::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_college()
                    ),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_specialty::specialty(),
                    tpl_specialty::specialty().".".tpl_specialty::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_specialty()
                    ),
                    tpl_specialty::name(),
                    tpl_specialty::specialty().'_'.tpl_specialty::name()
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

            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id =  $_POST[tpl_models::models().'_'.tpl_models::id()];

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id()
            ),array(
                tpl_models::id()=>$id
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

        $id_student =  $_POST[tpl_models::models().'_'.tpl_models::id_student()];
        $id_companies =  $_POST[tpl_models::models().'_'.tpl_models::id_companies()];
        $id_department =  $_POST[tpl_models::models().'_'.tpl_models::id_department()];
        $id_section =  $_POST[tpl_models::models().'_'.tpl_models::id_section()];
        $id_supervisor =  $_POST[tpl_models::models().'_'.tpl_models::id_supervisor()];

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::active()=>0,
                tpl_models::id_student()=>$id_student,
                tpl_models::id_companies()=>$id_companies,
                tpl_models::id_department()=>$id_department,
                tpl_models::id_section()=>$id_section,
                tpl_models::id_supervisor()=>$id_supervisor,
                tpl_models::date_in()=>date_time::Date_time_24(),

            )
        );

        $results = $db->add();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Add '.$id_student

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$id_student.', please try again'
                )
            );

        }

    }

    public function update()
    {

        $id = $_POST[ tpl_category::category() . '_' . tpl_category::id() . '_update'];

        $id_student =  $_POST[tpl_models::models().'_'.tpl_models::id_student() . '_update'];

        $id_companies =  $_POST[tpl_models::models().'_'.tpl_models::id_companies() . '_update'];

        $id_department =  $_POST[tpl_models::models().'_'.tpl_models::id_department() . '_update'];

        $id_section =  $_POST[tpl_models::models().'_'.tpl_models::id_section() . '_update'];

        $id_supervisor =  $_POST[tpl_models::models().'_'.tpl_models::id_supervisor() . '_update'];


        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id_student()=>$id_student,
                tpl_models::id_companies()=>$id_companies,
                tpl_models::id_department()=>$id_department,
                tpl_models::id_section()=>$id_section,
                tpl_models::id_supervisor()=>$id_supervisor,
                tpl_models::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_models::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$id_student
                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not Update '.$id_student.', please try again'
                )
            );

        }
    }

    public function update_status(){

        $id= $_POST[tpl_models::models().'_'.tpl_models::id()];

        $status= $_POST[tpl_models::models().'_'.tpl_models::active()];

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::active()=>$status,
            ),array(
                tpl_models::id()=>$id
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
            tpl_models::models(),array(
            "*"
        ),array(
                tpl_models::id()=>$id
            )
        );

        $results = $db->get_where();

        if(!empty($results)){

            return $results;

        }else{

            return false;

        }

    }

    public function find_students(){

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id(),
                tpl_students::first_name(),
                tpl_students::last_name(),
            ),array(
                tpl_students::status()=>1
            )
        );

        $data = $db->get_where();

        $w='<option></option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_students::id()].'">'.$row[tpl_students::first_name()].' '.$row[tpl_students::last_name()].'</option>';

        }

        return $w;

    }

    public function find_companies(){

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::id(),
                tpl_companies::name(),

            ),array(
                tpl_companies::active()=>1
            )
        );

        $data = $db->get();

        $w='<option></option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_companies::id()].'">'.$row[ tpl_companies::name()].'</option>';

        }

        return $w;

    }

    public function find_department(){

        if(isset($_POST[tpl_companies::id().'_'.tpl_companies::companies()])){

            $id = $_POST[tpl_companies::id().'_'.tpl_companies::companies()];

            if(!empty($id)){


                $db = new data_base(
                    tpl_department::department(),
                    array(
                        tpl_department::id(),
                        tpl_department::name(),

                    ),array(
                        tpl_department::active()=>1,
                        tpl_department::id_companies()=>$id
                    )
                );

                $data = $db->get_where();

                $w='<option></option>';

                foreach($data as $row){

                    $w=$w.'<option value="'.$row[tpl_department::id()].'">'.$row[ tpl_department::name()].'</option>';

                }

                echo $w;



            }else{

                echo 'error';
                exit;
            }

        }else{
            echo 'error';
            exit;
        }



    }

    public function find_section(){

        if(isset($_POST[tpl_department::id()."_".tpl_department::department()])){

            $id = $_POST[tpl_department::id()."_".tpl_department::department()];

            if(!empty($_POST[tpl_department::id()."_".tpl_department::department()])){

                $db = new data_base(
                    tpl_section::section(),
                    array(
                        tpl_section::id(),
                        tpl_section::name(),

                    ),array(
                        tpl_section::active()=>1,
                        tpl_section::id_department()=>$id
                    )
                );

                $data = $db->get_where();

                $w='<option></option>';

                foreach($data as $row){

                    $w=$w.'<option value="'.$row[tpl_section::id()].'">'.$row[ tpl_section::name()].'</option>';

                }

                echo  $w;


            }else{

                echo 'error';

                die();
            }

        }else{
            echo 'error';

            die();
        }



    }

    public function     find_supervisor(){

        if(isset($_POST[tpl_students::id().'_'.tpl_students::students()])){

            $id = $_POST[tpl_students::id().'_'.tpl_students::students()];



            if(!empty($id)){

                $db = new data_base(
                    tpl_students::students(),
                    array(
                        tpl_students::id(),
                        tpl_students::id_supervisor(),

                        data_base::select_multiple_table(
                            tpl_supervisor::supervisor(),
                            tpl_supervisor::supervisor().'.'.tpl_supervisor::id(),
                            tpl_students::students().'.'.tpl_students::id_supervisor(),
                            tpl_supervisor::name(),
                            tpl_supervisor::supervisor().'_'.tpl_supervisor::name()
                        ),

                    ),array(
                        tpl_students::status()=>1,
                        tpl_students::id()=>$id
                    )
                );

                $data = $db->get_where();

                $w='<option></option>';

                foreach($data as $row){

                    $w=$w.'<option value="'.$row[tpl_students::id_supervisor()].'">'.$row[ tpl_supervisor::supervisor().'_'.tpl_supervisor::name()].'</option>';

                }

                echo $w;

            }else{
                echo 'error empty';
                die();
            }
        }else{
            echo 'error isset';
            exit;
        }



    }


}