<?php

class supervisor_lib
{
    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('system/date_time/date_time');

        $this->use->use_lib('site/supervisor/sys/session_supervisor');
    }

    public function login_supervisor()
    {
        if (isset($_POST[tpl_supervisor::username() . '_sup']) && isset($_POST[tpl_supervisor::password() . '_sup'])) {

            $username = $_POST[tpl_supervisor::username() . '_sup'];

            $password = $_POST[tpl_supervisor::password() . '_sup'];

            if (!empty($username) && !empty($password)) {

                $db = new data_base(
                    tpl_supervisor::supervisor(),
                    array(
                        tpl_supervisor::id(),
                        tpl_supervisor::name()
                    ), array(
                        tpl_supervisor::username() => $username,
                        tpl_supervisor::password() => $this->hash_password($password),
                        tpl_supervisor::active()=> 1,
                    )
                );

                $data = $db->get_where();

                if (!empty($data)) {

                    $session = new session_supervisor();

                    $session->new_login_supervisors();

                    $session->set_id_user($data[0][tpl_supervisor::id()]);

                    if ($session->get_login_supervisors()) {

                        echo json_encode(array('valid' => true, 'title' => 'Welcome !!', 'massage' => $data[0][tpl_supervisor::name()]));
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

    public function get_info(){


        $session = new session_supervisor();

        $id = $session->Get_id_user();

        $db = new data_base(
            tpl_supervisor::supervisor(),
            array(
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
            ),array(
                tpl_supervisor::id()=>$id
            )
        );

        return $db->get_where();
    }

    public function info_students(){

        $session = new session_supervisor();

        $id = $session->Get_id_user();

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id(),
                tpl_students::first_name(),
                tpl_students::last_name(),

                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college() . '.' . tpl_college::id(),
                    tpl_students::students() . '.' . tpl_students::id_college(),
                    tpl_college::name(),
                    tpl_college::college() . '_' . tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university() . '.' . tpl_university::id(),
                    tpl_students::students() . '.' . tpl_students::id_college(),
                    tpl_university::name(),
                    tpl_university::university() . '_' . tpl_university::name()
                ),
                data_base::select_multiple_table(
                    tpl_specialty::specialty(),
                    tpl_specialty::specialty() . '.' . tpl_specialty::id(),
                    tpl_students::students() . '.' . tpl_students::id_college(),
                    tpl_specialty::name(),
                    tpl_specialty::specialty() . '_' . tpl_specialty::name()
                ),
            ),array(
                tpl_students::id_supervisor()=>$id,
                tpl_students::status()=>1
            )
        );

        return $db->get_where();
    }

    public function info_onus_designate($id =null){



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

            ),array(
                tpl_onus_designate::id_student()=>$id
            )
        );

        return $db->get_where();

    }

    public static function hash_password($password)
    {


        return md5(md5(md5('2015') . md5('28') . md5('10')) . $password);

    }

}