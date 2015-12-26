<?php

class onus_designate_lib_ad
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
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::id(),

                tpl_onus_designate::id_onus(),

                tpl_onus_designate::id_student(),

                tpl_onus_designate::id_models(),

                tpl_onus_designate::id_degree(),

                tpl_onus_designate::status(),

                data_base::select_multiple_table(
                    tpl_onus::onus(),
                    tpl_onus::onus() . '.' . tpl_onus::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_onus(),
                    tpl_onus::name(),
                    tpl_onus::onus() . '_' . tpl_onus::name()
                ),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students() . '.' . tpl_students::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_student(),
                    tpl_students::first_name(),
                    tpl_students::students() . '_' . tpl_students::first_name()
                ),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students() . '.' . tpl_students::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_student(),
                    tpl_students::last_name(),
                    tpl_students::students() . '_' . tpl_students::last_name()
                ),
                data_base::select_multiple_table(
                    tpl_degree::degree(),
                    tpl_degree::degree() . '.' . tpl_degree::id(),
                    tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_degree(),
                    tpl_degree::name(),
                    tpl_degree::degree() . '_' . tpl_degree::name()
                ),

                data_base::select_multiple_table(
                    tpl_companies::companies(),
                    tpl_companies::companies() . '.' . tpl_companies::id(),
                    data_base::select_multiple_table(
                        tpl_models::models(),
                        tpl_models::models() . '.' . tpl_models::id(),
                        tpl_onus_designate::onus_designate() . '.' . tpl_onus_designate::id_models(),
                        tpl_models::id_companies()
                    ), tpl_companies::name(),
                    tpl_companies::companies() . '_' . tpl_companies::name()
                ),


            )
        );

        echo json_encode($db->get());

    }

    public function remove()
    {
        $id = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id()];
        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::id()
            ), array(
                tpl_onus_designate::id() => $id
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

        $id_degree = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_degree()];
        $id_models = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_models()];
        $id_student = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_student()];
        $id_onus = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_onus()];


        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::status() => 0,
                tpl_onus_designate::id_degree() => $id_degree,
                tpl_onus_designate::id_student() => $id_student,
                tpl_onus_designate::id_models() => $id_models,
                tpl_onus_designate::id_onus() => $id_onus,
                tpl_onus_designate::date_in() => date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Add ' . $id_degree

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $id_degree . ', please try again'
                )
            );

        }

    }

    public function update()
    {

        $id = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id() . '_update'];
        $id_degree = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_degree() . '_update'];
        $id_student = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_student() . '_update'];
        $id_onus = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_onus() . '_update'];
        $id_models = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id_models() . '_update'];

        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::id_degree() => $id_degree,
                tpl_onus_designate::id_student() => $id_student,
                tpl_onus_designate::id_onus() => $id_onus,
                tpl_onus_designate::id_models() => $id_models,
                tpl_onus_designate::date_in() => date_time::Date_time_24()
            ), array(
                tpl_onus::id() => $id
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

    public function update_status()
    {
        $id = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::id()];
        $status = $_POST[tpl_onus_designate::onus_designate() . '_' . tpl_onus_designate::status()];

        $db = new data_base(
            tpl_onus_designate::onus_designate(),
            array(
                tpl_onus_designate::status() => $status,
            ), array(
                tpl_onus_designate::id() => $id
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


    public function find_students()
    {

        $db = new data_base(
            tpl_students::students(),
            array(
                tpl_students::id(),
                tpl_students::first_name(),
                tpl_students::last_name(),
            )
        );

        $data = $db->get();

        $w = '';

        foreach ($data as $row) {

            $w = $w . '<option value="' . $row[tpl_students::id()] . '">' . $row[tpl_students::first_name()] . ' ' . $row[tpl_students::last_name()] . '</option>';

        }

        return $w;

    }

    public function find_degree()
    {

        $db = new data_base(
            tpl_degree::degree(),
            array(
                tpl_degree::id(),
                tpl_degree::name(),

            ), array(
                tpl_degree::active() => 1
            )
        );
        $data = $db->get();
        $w = '';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_degree::id()] . '">' . $row[tpl_degree::name()] . '</option>';
        }
        return $w;
    }


    public function find_models()
    {

        $db = new data_base(
            tpl_models::models(),
            array(
                tpl_models::id(),

                data_base::select_multiple_table(
                    tpl_students::students(),
                    tpl_students::students() . '.' . tpl_students::id(),
                    tpl_models::models() . '.' . tpl_models::id_student(),
                    tpl_students::first_name(),
                    tpl_students::students() . '_' . tpl_students::first_name()
                ),

            ), array(
                tpl_models::active() => 1
            )
        );

        $data = $db->get();

        $w = '';

        foreach ($data as $row) {

            $w = $w . '<option value="' . $row[tpl_models::id()] . '">' . $row[tpl_students::students() . '_' . tpl_students::first_name()] . '</option>';

        }

        return $w;

    }

    public function find_onus()
    {

        $db = new data_base(
            tpl_onus::onus(),
            array(
                tpl_onus::id(),
                tpl_onus::name(),

            ), array(
                tpl_onus::active() => 1
            )
        );

        $data = $db->get();

        $w = '';

        foreach ($data as $row) {

            $w = $w . '<option value="' . $row[tpl_onus::id()] . '">' . $row[tpl_onus::name()] . '</option>';

        }

        return $w;

    }

}