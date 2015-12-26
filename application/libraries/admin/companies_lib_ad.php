<?php

class companies_lib_ad
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
            tpl_companies::companies(),
            array(
                tpl_companies::id(),
                tpl_companies::name(),
                tpl_companies::description(),
                tpl_companies::address(),
                tpl_companies::mobile(),
                tpl_companies::phone(),
                tpl_companies::active(),
                tpl_companies::id_category(),
                data_base::select_multiple_table(
                    tpl_category::category(),
                    tpl_category::category() . '.' . tpl_category::id(),
                    tpl_companies::companies() . '.' . tpl_companies::id_category(),
                    tpl_companies::name(),
                    tpl_category::category() . '_' . tpl_category::name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id = $_POST[tpl_companies::companies() . '_' . tpl_companies::id()];
        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::id()
            ), array(
                tpl_companies::id() => $id
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

        $name = $_POST[tpl_companies::companies() . '_' . tpl_companies::name()];
        $id_category = $_POST[tpl_companies::companies() . '_' . tpl_companies::id_category()];
        $description = $_POST[tpl_companies::companies() . '_' . tpl_companies::description()];
        $mobile = $_POST[tpl_companies::companies() . '_' . tpl_companies::mobile()];
        $phone = $_POST[tpl_companies::companies() . '_' . tpl_companies::phone()];
        $address = $_POST[tpl_companies::companies() . '_' . tpl_companies::address()];

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::active() => 0,
                tpl_companies::name() => $name,
                tpl_companies::id_category() => $id_category,
                tpl_companies::description() => $description,
                tpl_companies::mobile() => $mobile,
                tpl_companies::phone() => $phone,
                tpl_companies::address() => $address,
            )
        );

        $results = $db->add();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Add ' . $name

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $name . ', please try again'
                )
            );

        }

    }

    public function update()
    {

        $id = $_POST[tpl_companies::companies() . '_' . tpl_companies::id() . '_update'];

        $name = $_POST[tpl_companies::companies() . '_' . tpl_companies::name() . '_update'];

        $id_category = $_POST[tpl_companies::companies() . '_' . tpl_companies::id_category() . '_update'];

        $description = $_POST[tpl_companies::companies() . '_' . tpl_companies::description() . '_update'];

        $mobile = $_POST[tpl_companies::companies() . '_' . tpl_companies::mobile() . '_update'];

        $phone = $_POST[tpl_companies::companies() . '_' . tpl_companies::phone() . '_update'];

        $address = $_POST[tpl_companies::companies() . '_' . tpl_companies::address() . '_update'];


        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::name() => $name,
                tpl_companies::id_category() => $id_category,
                tpl_companies::description() => $description,
                tpl_companies::mobile() => $mobile,
                tpl_companies::phone() => $phone,
                tpl_companies::address() => $address,
            ), array(
                tpl_companies::id() => $id
            )
        );

        $results = $db->change();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $name
                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update ' . $name . ', please try again'
                )
            );

        }
    }

    public function update_status()
    {

        $id = $_POST[tpl_companies::companies() . '_' . tpl_companies::id()];
        $status = $_POST[tpl_companies::companies() . '_' . tpl_companies::active()];

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::active() => $status,
            ), array(
                tpl_companies::id() => $id
            )
        );

        $results = $db->change();

        $status_data = $status == 1 ? 'active' : 'dative';

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $status_data

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update ' . $status_data . ', please try again'
                )
            );

        }

    }

    public function find_category()
    {

        $db = new data_base(
            tpl_category::category(),
            array(
                tpl_category::id(),
                tpl_category::active(),
                tpl_category::name(),
            ), array(
                tpl_category::active() => 1
            )
        );

        $data = $db->get_where();

        $w = '';

        foreach ($data as $row) {

            $w = $w . '<option value="' . $row[tpl_category::id()] . '">' . $row[tpl_category::name()] . '</option>';

        }

        return $w;

    }

    public function ajax_models()
    {

        $db = new data_base(
            tpl_companies::companies(),
            array(
                tpl_companies::id(),
                tpl_companies::name(),
                data_base::select_multiple_table(
                    tpl_models::models(),
                    tpl_models::models() . '.' . tpl_models::id_companies(),
                    tpl_companies::companies() . '.' . tpl_companies::id(),
                    'COUNT(' . tpl_models::id() . ')',
                    tpl_models::models() . '_' . tpl_models::id()
                ),

            )
        );

        echo json_encode($db->get());

    }

    public function find($id)
    {

        $db = new data_base(
            tpl_companies::companies(), array(
            "*"
        ), array(
                tpl_companies::id() => $id
            )
        );

        $results = $db->get_where();

        if (!empty($results)) {

            return $results;

        } else {

            return false;

        }

    }

    public function ajax_find_students()
    {

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id(),
                tpl_models::id_companies(),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students().'.'.tpl_students::id(),
                    tpl_models::models().'.'.tpl_models::id_student(),
                    tpl_students::first_name(),
                    tpl_students::students().'_'.tpl_students::first_name()
                )
                ,
                   data_base::select_multiple_table(
                       tpl_students::students(),
                       tpl_students::students().'.'.tpl_students::id(),
                       tpl_models::models().'.'.tpl_models::id_student(),
                       tpl_students::last_name(),
                       tpl_students::students().'_'.tpl_students::last_name()
                   ),

                data_base::select_multiple_table(
                    tpl_supervisor::supervisor(),
                    tpl_supervisor::supervisor().'.'.tpl_supervisor::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_supervisor()
                    ),
                    tpl_supervisor::name(),
                    tpl_supervisor::supervisor().'_'.tpl_supervisor::name()
                ),


                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university().'.'.tpl_university::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_supervisor()
                    ),
                    tpl_university::name(),
                    tpl_university::university().'_'.tpl_university::name()
                ),


                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college().'.'.tpl_college::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_supervisor()
                    ),
                    tpl_college::name(),
                    tpl_college::college().'_'.tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_specialty::specialty(),
                    tpl_specialty::specialty().'.'.tpl_specialty::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_supervisor()
                    ),
                    tpl_specialty::name(),
                    tpl_specialty::specialty().'_'.tpl_specialty::name()
                ),


                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department().'.'.tpl_department::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_supervisor()
                    ),
                    tpl_department::name(),
                    tpl_department::department().'_'.tpl_department::name()
                ),

                data_base::select_multiple_table(
                    tpl_section::section(),
                    tpl_section::section().'.'.tpl_section::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students().'.'.tpl_students::id(),
                        tpl_models::models().'.'.tpl_models::id_student(),
                        tpl_students::id_supervisor()
                    ),
                    tpl_section::name(),
                    tpl_section::section().'_'.tpl_section::name()
                ),





                /*data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students() . '.' . tpl_students::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models() . '.' . tpl_models::id_companies(),
                        tpl_companies::companies() . '.' . tpl_companies::id(),
                        tpl_models::id_student()
                    ),
                    tpl_students::first_name(),
                    tpl_students::students() . '_' . tpl_students::first_name()
                ),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students() . '.' . tpl_students::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models() . '.' . tpl_models::id_companies(),
                        tpl_companies::companies() . '.' . tpl_companies::id(),
                        tpl_models::id_student()
                    ),
                    tpl_students::last_name(),
                    tpl_students::students() . '_' . tpl_students::last_name()
                ),


                data_base::select_multiple_table(
                    tpl_department::department(),
                    tpl_department::department() . '.' . tpl_department::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models() . '.' . tpl_models::id_companies(),
                        tpl_companies::companies() . '.' . tpl_companies::id(),
                        tpl_models::id_department()
                    ),
                    tpl_department::name(),
                    tpl_department::department() . '_' . tpl_department::name()
                ),


                data_base::select_multiple_table(
                    tpl_section::section(),
                    tpl_section::section() . '.' . tpl_section::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models() . '.' . tpl_models::id_companies(),
                        tpl_companies::companies() . '.' . tpl_companies::id(),
                        tpl_models::id_section()
                    ),
                    tpl_section::name(),
                    tpl_section::section() . '_' . tpl_section::name()
                ),

                data_base::select_multiple_table(
                    tpl_college::college(),
                    tpl_college::college() . '.' . tpl_college::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students() . '.' . tpl_students::id(),
                        data_base::select_multiple_table(
                            tpl_models::models(),
                            tpl_models::models() . '.' . tpl_models::id_companies(),
                            tpl_companies::companies() . '.' . tpl_companies::id(),
                            tpl_models::id_student()
                        ),
                        tpl_students::id_college()
                    ),
                    tpl_college::name(),
                    tpl_college::college() . '_' . tpl_college::name()
                ),

                data_base::select_multiple_table(
                    tpl_university::university(),
                    tpl_university::university() . '.' . tpl_university::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students() . '.' . tpl_students::id(),
                        data_base::select_multiple_table(
                            tpl_models::models(),
                            tpl_models::models() . '.' . tpl_models::id_companies(),
                            tpl_companies::companies() . '.' . tpl_companies::id(),
                            tpl_models::id_student()
                        ),
                        tpl_students::id_university()
                    ),
                    tpl_university::name(),
                    tpl_university::university() . '_' . tpl_university::name()
                ),

                data_base::select_multiple_table(
                    tpl_specialty::specialty(),
                    tpl_specialty::specialty() . '.' . tpl_specialty::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students() . '.' . tpl_students::id(),
                        data_base::select_multiple_table(
                            tpl_models::models(),
                            tpl_models::models() . '.' . tpl_models::id_companies(),
                            tpl_companies::companies() . '.' . tpl_companies::id(),
                            tpl_models::id_student()
                        ),
                        tpl_students::id_specialty()
                    ),
                    tpl_specialty::name(),
                    tpl_specialty::specialty() . '_' . tpl_specialty::name()
                ),


                data_base::select_multiple_table(
                    tpl_supervisor::supervisor(),
                    tpl_supervisor::supervisor() . '.' . tpl_supervisor::id(),
                    data_base::select_multiple_table(
                        tpl_students::students(),
                        tpl_students::students() . '.' . tpl_students::id(),
                        data_base::select_multiple_table(
                            tpl_models::models(),
                            tpl_models::models() . '.' . tpl_models::id_companies(),
                            tpl_companies::companies() . '.' . tpl_companies::id(),
                            tpl_models::id_student()
                        ),
                        tpl_students::id_supervisor()
                    ),
                    tpl_supervisor::name(),
                    tpl_supervisor::supervisor() . '_' . tpl_supervisor::name()
                ),
                */

            ), array(
                tpl_models::id_companies() => $_GET['id']
            )
        );

        echo json_encode($db->get_where());

    }


}