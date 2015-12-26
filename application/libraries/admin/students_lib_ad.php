<?php

class students_lib_ad
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
            tpl_students::students(),
            array(
                tpl_students::id(),
                tpl_students::first_name(),
                tpl_students::last_name(),
                tpl_students::id_college(),
                tpl_students::id_supervisor(),
                tpl_students::id_specialty(),
                tpl_students::id_university(),
                tpl_students::password(),
                tpl_students::status(),

                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college() . '.' . tpl_college::id(),
                    tpl_students::students() . '.' . tpl_students::id_college(),
                    tpl_college::name(),
                    tpl_college::college() . '_' . tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_supervisor::supervisor(),
                    tpl_supervisor::supervisor() . '.' . tpl_supervisor::id(),
                    tpl_students::students() . '.' . tpl_students::id_supervisor(),
                    tpl_supervisor::name(),
                    tpl_supervisor::supervisor() . '_' . tpl_supervisor::name()
                ),
                data_base::select_multiple_table(
                    tpl_specialty::specialty(),
                    tpl_specialty::specialty() . '.' . tpl_specialty::id(),
                    tpl_students::students() . '.' . tpl_students::id_specialty(),
                    tpl_specialty::name(),
                    tpl_specialty::specialty() . '_' . tpl_specialty::name()
                ),
                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university() . '.' . tpl_university::id(),
                    tpl_students::students() . '.' . tpl_students::id_university(),
                    tpl_university::name(),
                    tpl_university::university() . '_' . tpl_university::name()
                )
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id = $_POST[tpl_students::students() . '_' . tpl_students::id()];
        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id()
            ), array(
                tpl_students::id() => $id
            )
        );

        $data = $db->delete();

        if ($data) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Deleted '

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update, please try again'
                )
            );

        }
    }

    public function insert()
    {

        $first_name = $_POST[tpl_students::students() . '_' . tpl_students::first_name()];
        $last_name = $_POST[tpl_students::students() . '_' . tpl_students::last_name()];
        $id_specialty = $_POST[tpl_students::students() . '_' . tpl_students::id_specialty()];
        $id_college = $_POST[tpl_students::students() . '_' . tpl_students::id_college()];
        $id_supervisor = $_POST[tpl_students::students() . '_' . tpl_students::id_supervisor()];
        $id_university = $_POST[tpl_students::students() . '_' . tpl_students::id_university()];
        $password= $_POST[tpl_students::students() . '_' . tpl_students::password()];

        $db = new data_base(
            tpl_students::students(),
            array(

                tpl_students::first_name() => $first_name,
                tpl_students::last_name() => $last_name,
                tpl_students::id_specialty() => $id_specialty,
                tpl_students::id_college() => $id_college,
                tpl_students::id_supervisor() => $id_supervisor,
                tpl_students::id_university() => $id_university,
                tpl_students::password() => md5($password),
            )
        );

        $results = $db->add();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Add ' . $first_name

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $first_name . ', please try again'
                )
            );

        }

    }

    public function update()
    {

        $id = $_POST[tpl_students::students() . '_' . tpl_students::id() . '_update'];

        $first_name = $_POST[tpl_students::students() . '_' . tpl_students::first_name() . '_update'];

        $last_name = $_POST[tpl_students::students() . '_' . tpl_students::last_name() . '_update'];

        $id_supervisor = $_POST[tpl_students::students() . '_' . tpl_students::id_supervisor() . '_update'];

        $id_university = $_POST[tpl_students::students() . '_' . tpl_students::id_university() . '_update'];

        $id_college = $_POST[tpl_students::students() . '_' . tpl_students::id_college() . '_update'];

        $id_specialty = $_POST[tpl_students::students() . '_' . tpl_students::id_specialty() . '_update'];


        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::first_name() => $first_name,
                tpl_students::last_name() => $last_name,
                tpl_students::id_supervisor() => $id_supervisor,
                tpl_students::id_university() => $id_university,
                tpl_students::id_college() => $id_college,
                tpl_students::id_specialty() => $id_specialty

            ), array(
                tpl_students::id() => $id
            )
        );

        $results = $db->change();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $first_name
                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update ' . $first_name . ', please try again'
                )
            );

        }
    }

    public function update_password()
    {

        $id = $_POST[tpl_students::students().'_'.tpl_students::id().'_update_password'];
        $password = $_POST[tpl_students::students().'_'.tpl_students::password().'_update_password'];

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::password() => md5($password),
            ), array(
                tpl_students::id() => $id
            )
        );

        $results = $db->change();


        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $id

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update ' . $id . ', please try again'
                )
            );

        }

    }

    public function find_supervisor()
    {

        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
                tpl_supervisor::id(),
                tpl_supervisor::name(),
            ), array(
                tpl_supervisor::active() => 1
            )
        );
        $data = $db->get_where();
        $w = '';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_supervisor::id()] . '">' . $row[tpl_supervisor::name()] . '</option>';
        }
        return $w;
    }

    public function find_university()
    {

        $db = new data_base(
            tpl_university::university(),
            array(
                tpl_university::id(),
                tpl_university::name(),
            ), array(
                tpl_university::active() => 1
            )
        );
        $data = $db->get_where();
        $w = '';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_university::id()] . '">' . $row[tpl_university::name()] . '</option>';
        }
        return $w;
    }

    public function find_college()
    {

        $db = new data_base(
            tpl_college::college(),
            array(
                tpl_college::id(),
                tpl_college::name(),
            ), array(
                tpl_college::active() => 1
            )
        );
        $data = $db->get_where();
        $w = '';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_college::id()] . '">' . $row[tpl_college::name()] . '</option>';
        }
        return $w;
    }

    public function find_specialty()
    {

        $db = new data_base(
            tpl_specialty::specialty(),
            array(
                tpl_specialty::id(),
                tpl_specialty::name(),
            ), array(
                tpl_specialty::active() => 1
            )
        );
        $data = $db->get_where();
        $w = '';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_specialty::id()] . '">' . $row[tpl_specialty::name()] . '</option>';
        }
        return $w;
    }

    public function update_status(){

        $id= $_POST[tpl_students::students().'_'.tpl_students::id()];
        $status= $_POST[tpl_students::students().'_'.tpl_students::status()];

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::status()=>$status,
            ),array(
                tpl_students::id()=>$id
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