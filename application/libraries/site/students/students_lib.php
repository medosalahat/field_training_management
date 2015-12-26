<?php

class students_lib
{
    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('system/date_time/date_time');

        $this->use->use_lib('site/students/sys/session_students');
    }

    public function new_students(){

        if(
        isset($_POST[tpl_students::students() . '_' . tpl_students::first_name()]) &&
        isset($_POST[tpl_students::students() . '_' . tpl_students::last_name()]) &&
        isset($_POST[tpl_students::students() . '_' . tpl_students::password()]) &&
        isset($_POST[tpl_students::students() . '_' . tpl_students::password().'_re']) &&
        isset($_POST[tpl_students::students().'_'.tpl_students::id_university()]) &&
        isset($_POST[tpl_students::students().'_'.tpl_students::id_college()]) &&
        isset($_POST[tpl_students::students().'_'.tpl_students::id_specialty()]) &&
        isset($_POST[tpl_category::category().'_'.tpl_category::id()]) &&
        isset($_POST[tpl_companies::companies().'_'.tpl_companies::id()]) &&
        isset($_POST[tpl_department::department().'_'.tpl_department::id()]) &&
        isset($_POST[tpl_section::section().'_'.tpl_section::id()])&&
        isset($_POST[tpl_students::students().'_'.tpl_students::username()])&&
        isset($_POST[tpl_students::students().'_'.tpl_students::email()])
        ){

            if(
                !empty($_POST[tpl_students::students() . '_' . tpl_students::first_name()]) &&
                !empty($_POST[tpl_students::students() . '_' . tpl_students::last_name()]) &&
                !empty($_POST[tpl_students::students() . '_' . tpl_students::password()]) &&
                !empty($_POST[tpl_students::students() . '_' . tpl_students::password().'_re']) &&
                !empty($_POST[tpl_students::students().'_'.tpl_students::id_university()]) &&
                !empty($_POST[tpl_students::students().'_'.tpl_students::id_college()]) &&
                !empty($_POST[tpl_students::students().'_'.tpl_students::id_specialty()]) &&
                !empty($_POST[tpl_category::category().'_'.tpl_category::id()]) &&
                !empty($_POST[tpl_companies::companies().'_'.tpl_companies::id()]) &&
                !empty($_POST[tpl_department::department().'_'.tpl_department::id()]) &&
                !empty($_POST[tpl_section::section().'_'.tpl_section::id()])&&
                !empty($_POST[tpl_students::students().'_'.tpl_students::username()])&&
                !empty($_POST[tpl_students::students().'_'.tpl_students::email()])
            ){

                if($_POST[tpl_students::students().'_'.tpl_students::password()] == $_POST[tpl_students::students().'_'.tpl_students::password().'_re']){
                    $db = new data_base(
                        tpl_students::students(),
                        array(
                            tpl_students::first_name()=>$_POST[tpl_students::students() . '_' . tpl_students::first_name()],
                            tpl_students::last_name()=>$_POST[tpl_students::students() . '_' . tpl_students::last_name()],
                            tpl_students::password()=>$this->hash_password($_POST[tpl_students::students() . '_' . tpl_students::password()]),
                            tpl_students::id_university()=>$_POST[tpl_students::students() . '_' . tpl_students::id_university()],
                            tpl_students::id_college()=>$_POST[tpl_students::students() . '_' . tpl_students::id_college()],
                            tpl_students::id_specialty()=>$_POST[tpl_students::students() . '_' . tpl_students::id_specialty()],
                            tpl_students::id_supervisor()=>$_POST[tpl_students::students() . '_' . tpl_students::id_supervisor()],
                            tpl_students::username()=>$_POST[tpl_students::students() . '_' . tpl_students::username()],
                            tpl_students::email()=>$_POST[tpl_students::students() . '_' . tpl_students::email()],
                        )
                    );

                    $id_student =   $db->add();

                    $db = new data_base(
                        tpl_models::models(),
                        array(
                            tpl_models::id_student()=>$id_student,
                            tpl_models::id_companies()=>$_POST[tpl_companies::companies().'_'.tpl_companies::id()],
                            tpl_models::id_department()=>$_POST[tpl_department::department().'_'.tpl_department::id()],
                            tpl_models::id_section()=>$_POST[tpl_section::section().'_'.tpl_section::id()],
                            tpl_models::id_supervisor()=>$_POST[tpl_students::students() . '_' . tpl_students::id_specialty()],
                        )
                    );

                    $session = new session_students();

                    $session->new_login_students();

                    $session->set_id_user($id_student);


                    echo json_encode(
                        array(
                            'valid' => true,
                            'title' => 'yes !!',
                            'massage' => $db->add()
                        )
                    );
                }else{
                    echo json_encode(
                        array(
                            'valid' => false,
                            'title' => 'Oops !!',
                            'massage' => 'password not combated'
                        )
                    );

                }

            }else{

                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'Was not username & password, please try again'
                    )
                );

            }

        }else{

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'Was not username & password, please try again'
                )
            );

        }
    }

    public function login_student()
    {


        if (isset($_POST['username_stu']) && isset($_POST[tpl_students::password() . '_stu'])) {

            $username = $_POST[tpl_students::username() . '_stu'];

            $password = $_POST[tpl_students::password() . '_stu'];

            if (!empty($username) && !empty($password)) {

                $db = new data_base(
                    tpl_students::students(),
                    array(
                        tpl_students::id(),
                        tpl_students::first_name()
                    )
                    ,
                    array(
                        tpl_students::username() => $username,
                        tpl_students::password() => $this->hash_password($password),
                        tpl_students::status() => 1,
                    )
                );

                $data = $db->get_where();

                if (!empty($data)) {

                    $session = new session_students();

                    $session->new_login_students();

                    $session->set_id_user($data[0][tpl_students::id()]);

                    if ($session->get_login_students()) {

                        echo json_encode(array('valid' => true, 'title' => 'Welcome !!', 'massage' => $data[0][tpl_students::first_name()]));
                    } else {

                        echo json_encode(array('valid' => false, 'title' => 'Oops !!',
                            'massage' => 'Was not username & password, please try again'));
                    }

                } else {
                    echo json_encode(
                        array(
                            'valid' => false,
                            'title' => 'Oops !!',
                            'massage' => 'Was not username & password, please try again'
                        )
                    );
                }

            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'Was not username & password, please try again'
                    )
                );
            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'Was not username & password, please try again'
                )
            );

        }

    }

    public static function hash_password($password)
    {


        return md5(md5(md5('2015') . md5('28') . md5('10')) . $password);

    }

    public function get_info()
    {
        $session = new session_students();

        $id_students = $session->Get_id_user();

        $db = new data_base(
            tpl_students::students(),

            array(
                tpl_students::id(),
                tpl_students::first_name(),
                tpl_students::last_name(),
                tpl_students::email(),
                tpl_students::id_college(),
                tpl_students::id_specialty(),
                tpl_students::id_supervisor(),
                tpl_students::id_university(),

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
            ), array(
                tpl_students::id() => $id_students
            )
        );

        return $db->get_where();

    }

    public function info_onus_designate()
    {


        $session = new session_students();

        $id = $session->Get_id_user();

        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::id(),
                tpl_onus_designate::id_degree(),
                tpl_onus_designate::id_models(),
                tpl_onus_designate::id_student(),
                tpl_onus_designate::id_onus(),
                data_base::select_multiple_table(
                    tpl_onus::onus(),
                    tpl_onus::onus() . '.' . tpl_onus::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_onus(),
                    tpl_onus::name(),
                    tpl_onus::onus() . '_' . tpl_onus::name()
                ),
                data_base::select_multiple_table(
                    tpl_onus::onus(),
                    tpl_onus::onus() . '.' . tpl_onus::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_onus(),
                    tpl_onus::description(),
                    tpl_onus::onus() . '_' . tpl_onus::description()
                ),
                data_base::select_multiple_table(
                    tpl_degree::degree(),
                    tpl_degree::degree() . '.' . tpl_degree::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_degree(),
                    tpl_degree::name(),
                    tpl_degree::degree() . '_' . tpl_degree::name()
                ),

            ), array(
                tpl_onus_designate::id_student() => $id,
                tpl_onus_designate::status() => 1,
            )
        );

        return $db->get_where();

    }

    public function info_companies()
    {


        $session = new session_students();

        $id = $session->Get_id_user();

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id(),
                tpl_models::id_student(),
                tpl_models::active(),
                tpl_models::id_companies(),
                tpl_models::id_department(),
                tpl_models::id_section(),

                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies() . '.' . tpl_companies::id(),
                    tpl_models::models() . '.' . tpl_models::id_companies(),
                    tpl_companies::name(),
                    tpl_companies::companies() . '_' . tpl_companies::name()
                ),

                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department() . '.' . tpl_department::id(),
                    tpl_models::models() . '.' . tpl_models::id_department(),
                    tpl_department::name(),
                    tpl_department::department() . '_' . tpl_department::name()
                ),

                data_base::select_multiple_table(
                    tpl_section::section(),
                    tpl_section::section() . '.' . tpl_section::id(),
                    tpl_models::models() . '.' . tpl_models::id_section(),
                    tpl_section::name(),
                    tpl_section::section() . '_' . tpl_section::name()
                ),

            ), array(
                tpl_models::id_student() => $id
            )
        );

        return $db->get_where();
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

    public function get_all_college()
    {

        if (isset($_POST['id_university'])) {

            $id = $_POST['id_university'];

            if (!empty($id)) {

                $db = new data_base(
                    tpl_college::college(),
                    array(
                        tpl_college::id(),
                        tpl_college::name(),
                    ), array(
                        tpl_college::id_university() => $id,
                        tpl_college::active() => 1
                    )
                );

                $data = $db->get_where();

                $w = '   <option></option>';

                foreach ($data as $row) {
                    $w = $w . '<option value="' . $row[tpl_college::id()] . '">' . $row[tpl_college::name()] . '</option>';
                }
                echo $w;


            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'error empty'
                    )
                );

            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'error isset'
                )
            );
        }


    }

    public function get_all_specialty()
    {

        if (isset($_POST['id_college'])) {

            $id = $_POST['id_college'];

            if (!empty($id)) {

                $db = new data_base(
                    tpl_specialty::specialty(),
                    array(
                        tpl_specialty::id(),
                        tpl_specialty::name(),
                    ), array(
                        tpl_specialty::id_college() => $id,
                        tpl_specialty::active() => 1
                    )
                );

                $data = $db->get_where();
                $w = '   <option></option>';
                foreach ($data as $row) {
                    $w = $w . '<option value="' . $row[tpl_specialty::id()] . '">' . $row[tpl_specialty::name()] . '</option>';
                }
                echo $w;


            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'error empty'
                    )
                );

            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'error isset'
                )
            );
        }


    }
    public function get_all_companies()
    {

        if (isset($_POST['id_category'])) {

            $id = $_POST['id_category'];

            if (!empty($id)) {

                $db = new data_base(
                    tpl_companies::companies(),
                    array(
                        tpl_companies::id(),
                        tpl_companies::name(),
                    ), array(
                        tpl_companies::id_category() => $id,
                        tpl_companies::active() => 1
                    )
                );

                $data = $db->get_where();
                $w = '   <option></option>';
                foreach ($data as $row) {
                    $w = $w . '<option value="' . $row[tpl_specialty::id()] . '">' . $row[tpl_specialty::name()] . '</option>';
                }
                echo $w;


            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'error empty'
                    )
                );

            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'error isset'
                )
            );
        }


    }
    public function get_all_department()
    {

        if (isset($_POST['id_companies'])) {

            $id = $_POST['id_companies'];

            if (!empty($id)) {

                $db = new data_base(
                    tpl_department::department(),
                    array(
                        tpl_department::id(),
                        tpl_department::name(),
                    ), array(
                        tpl_department::id_companies() => $id,
                        tpl_department::active() => 1
                    )
                );

                $data = $db->get_where();
                $w = '   <option></option>';
                foreach ($data as $row) {
                    $w = $w . '<option value="' . $row[tpl_department::id()] . '">' . $row[tpl_department::name()] . '</option>';
                }
                echo $w;


            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'error empty'
                    )
                );

            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'error isset'
                )
            );
        }


    }

    public function get_all_section()
    {

        if (isset($_POST['id_department'])) {

            $id = $_POST['id_department'];

            if (!empty($id)) {

                $db = new data_base(
                    tpl_section::section(),
                    array(
                        tpl_section::id(),
                        tpl_section::name(),
                    ), array(
                        tpl_section::id_department() => $id,
                        tpl_section::active() => 1
                    )
                );

                $data = $db->get_where();
                $w = '   <option></option>';
                foreach ($data as $row) {
                    $w = $w . '<option value="' . $row[tpl_department::id()] . '">' . $row[tpl_department::name()] . '</option>';
                }
                echo $w;


            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'error empty'
                    )
                );

            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'error isset'
                )
            );
        }


    }

    public function get_all_category()
    {


        $db = new data_base(
            tpl_category::category(),
            array(
                tpl_category::id(),
                tpl_category::name(),
            ), array(
                tpl_category::active() => 1
            )
        );

        $data = $db->get_where();
        $w = '   <option></option>';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_specialty::id()] . '">' . $row[tpl_specialty::name()] . '</option>';

            return $w;

        }


    }

    public function get_all_supervisor()
    {

        if (isset($_POST['id_university']) && isset($_POST['id_college'])) {

            $id_university = $_POST['id_university'];
            $id_college = $_POST['id_university'];

            if (!empty($id_university) && !empty($id_college)) {

                $db = new data_base(
                    tpl_supervisor::supervisor(),
                    array(
                        tpl_supervisor::id(),
                        tpl_supervisor::name(),
                    ), array(
                        tpl_supervisor::id_university() => $id_university,
                        tpl_supervisor::id_college() => $id_college,
                        tpl_supervisor::active() => 1
                    )
                );

                $data = $db->get_where();
                $w = '   <option></option>';
                foreach ($data as $row) {
                    $w = $w . '<option value="' . $row[tpl_specialty::id()] . '">' . $row[tpl_specialty::name()] . '</option>';
                }
                echo $w;


            } else {


                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => 'Oops !!',
                        'massage' => 'error empty'
                    )
                );

            }
        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'error isset'
                )
            );
        }


    }
}