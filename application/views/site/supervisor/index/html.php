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
            <a class="navbar-brand" href="<?= site_url('supervisor/home_sup') ?>">Supervisor
                <small>( field training management )</small>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url('supervisor/home_sup') ?>">Home</a></li>
                <li><a href="<?= site_url('supervisor/home_sup/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
        <link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
        <script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
        <?PHP
        $use = new class_loader();
        $use->use_lib('site/supervisor/supervisor_lib');
        $lib = new supervisor_lib();
        $data = array_shift($lib->get_info());

        ?>
        <div class="col-sm-12 main">
            <div class="row">
            <div class="col-sm-6">
                <h4>Name : <?= $data[tpl_supervisor::name()] ?></h4>
                <h4>University : <?= $data[tpl_university::university() . '_' . tpl_university::name()] ?></h4>
                <h4>College : <?= $data[tpl_college::college() . '_' . tpl_college::name()] ?></h4>
            </div>
            </div>
            <?PHP foreach ($lib->info_students() as $row): ?>
            <div class="row">
                <hr>
                <h4>Name : <?= $row[tpl_students::first_name()] . ' ' . $row[tpl_students::last_name()] ?></h4>
                <h4>Specialty : <?= $row[tpl_specialty::specialty() . '_' . tpl_specialty::name()] ?></h4>
                <h4>University : <?= $row[tpl_university::university() . '_' . tpl_university::name()] ?></h4>
                <h4>College : <?= $row[tpl_college::college() . '_' . tpl_college::name()] ?></h4>


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>onus name</td>
                        <td>onus description</td>
                        <td>degree name</td>

                    </tr>
                    </thead>
                    <tbody>
                    <?PHP foreach ($lib->info_onus_designate($row[tpl_students::id()]) as $rows): ?>
                        <tr>
                            <td><?=$rows[tpl_onus::onus() . '_' . tpl_onus::name()] ?></td>
                            <td><?=$rows[tpl_onus::onus() . '_' . tpl_onus::description()] ?></td>
                            <td><?=$rows[tpl_degree::degree() . '_' . tpl_degree::name()] ?></td>
                        </tr>
                    <?PHP endforeach ?>
                    </tbody>
                </table>

            </div>
            <?PHP endforeach ?>
        </div>
    </div>
</div>
</body>
</html>
