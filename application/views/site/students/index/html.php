<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome</title>
    <link href="<?= site_url('include/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/main.css') ?>" rel="stylesheet">
    <script src="<?= site_url('include/js/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?= site_url('include/js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('include/form_validation/dist/js/bootstrapValidator.min.js') ?>"></script>
    <link href="<?= site_url('include/form_validation/src/css/bootstrapValidator.css') ?>" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url('students/home_stu') ?>">Students
                <small>( field training management )</small>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url('students/home_stu') ?>">Home</a></li>
                <li><a href="<?= site_url('students/home_stu/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
        <link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
        <script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
        <?PHP $use = new class_loader();
        $use->use_lib('site/students/students_lib');
        $lib = new students_lib();
        $data = array_shift($lib->get_info());

        $data_co = array_shift($lib->info_companies());
        ?>
        <div class="col-sm-12 main">
            <div class="col-sm-6">

                    <h4>Name : <?= $data[tpl_students::first_name()] . ' ' . $data[tpl_students::last_name()] ?></h4>
                    <h4>Supervisor : <?= $data[tpl_supervisor::supervisor() . '_' . tpl_supervisor::name()] ?></h4>
                    <h4>Specialty : <?= $data[tpl_specialty::specialty() . '_' . tpl_specialty::name()] ?></h4>
                    <h4>University : <?= $data[tpl_university::university() . '_' . tpl_university::name()] ?></h4>
                    <h4>College : <?= $data[tpl_college::college() . '_' . tpl_college::name()] ?></h4>


            </div>

            <div class="col-sm-6">
                    <h4>companies : <?= $data_co[ tpl_companies::companies().'_'.tpl_companies::name()] ?></h4>
                    <h4>Department : <?= $data_co[ tpl_department::department().'_'.tpl_department::name()] ?></h4>
                    <h4>Section : <?= $data_co[    tpl_section::section().'_'.tpl_section::name()] ?></h4>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>onus name</td>
                        <td>onus description</td>
                        <td>degree name</td>

                    </tr>
                    </thead>
                    <tbody>
                    <?PHP foreach ($lib->info_onus_designate() as $row): ?>
                        <tr>
                            <td><?= $row[tpl_onus::onus() . '_' . tpl_onus::name()] ?></td>
                            <td><?= $row[tpl_onus::onus() . '_' . tpl_onus::description()] ?></td>
                            <td><?= $row[tpl_degree::degree() . '_' . tpl_degree::name()] ?></td>
                        </tr>
                    <?PHP endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
