<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $name_page ?></title>
    <link href="<?= site_url('include/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/main.css') ?>" rel="stylesheet">
    <script src="<?= site_url('include/js/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?= site_url('include/js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('include/form_validation/dist/js/bootstrapValidator.min.js') ?>"></script>
    <link href="<?= site_url('include/form_validation/src/css/bootstrapValidator.css') ?>" rel="stylesheet">


</head>

<body>

<?php
$use = new class_loader();

$use->use_lib('admin/sys/class_sessions_admin');

$session = new class_sessions_admin();

if ($session->get_login_admin_in()){
?>
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
            <a class="navbar-brand" href="<?= site_url('admin/home') ?>">Admin
                <small>(  field training management )</small>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url('admin/home') ?>">Home</a></li>
                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-link dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">University <span
                                class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('admin/university') ?>">University</a></li>
                            <li><a href="<?= site_url('admin/college') ?>">College</a></li>
                            <li><a href="<?= site_url('admin/specialty') ?>">Specialty</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= site_url('admin/supervisor') ?>">Supervisor</a></li>
                            <li><a href="<?= site_url('admin/students') ?>">Students</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-link dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Companies <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('admin/companies') ?>">Companies</a></li>
                            <li><a href="<?= site_url('admin/category') ?>">Category</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=site_url('admin/department')?>">Department</a></li>
                            <li><a href="<?=site_url('admin/section')?>">Section</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-link dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Training <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?=site_url('admin/models')?>">Models</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=site_url('admin/onus')?>">Onus</a></li>
                            <li><a href="<?=site_url('admin/onus_designate')?>">Onus designate</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=site_url('admin/degree')?>">Degree</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-link dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            System <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('admin/users') ?>">User</a></li>
                            <li><a href="<?= site_url('admin/home/logout') ?>">Logout</a></li>

                        </ul>
                    </div>
                </li>



            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
        <link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
        <script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
        <?PHP } ?>

        <?= $content ?>
    </div>
</div>
</body>
</html>
