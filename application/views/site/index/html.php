<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Field Training Management</title>
    <link rel="stylesheet" href="<?= site_url('include/web/css/bootstrap.min.css') ?>" type="text/css">
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" href="<?= site_url('include/web/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= site_url('include/web/css/animate.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= site_url('include/web/css/creative.css') ?>" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top">

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="<?= site_url() ?>">Field Training Management</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="page-scroll" href="#about">About</a></li>
                <li><a class="page-scroll" href="#services">Services</a></li>
                <li><a class="page-scroll" href="#contact">Contact</a></li>
                <li><a class="page-scroll" id="Students">Students</a></li>
                <li><a class="page-scroll" id="Supervisor">Supervisor</a></li>
                <li><a class="page-scroll" id="register_stu">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Welcome field training management </h1>
            <hr>
            <p> start going, no strings attached! start going, no strings attached! start going, no strings attached!
                start going, no strings attached!</p>
            <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">We've got what you need!</h2>
                <hr class="light">
                <p class="text-faded">Start Bootstrap has everything you need to get your new website up and running in
                    no time! All of the templates and themes on Start Bootstrap are open source, free to download, and
                    easy to use. No strings attached!</p>
                <a id="register_stu" class="btn btn-default btn-xl">Get Started!</a>
            </div>
        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">At Your Service</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>

                    <h3>Sturdy Templates</h3>

                    <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>

                    <h3>Ready to Ship</h3>

                    <p class="text-muted">You can use this theme as is, or you can make changes!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>

                    <h3>Up to Date</h3>

                    <p class="text-muted">We update dependencies to keep things fresh.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>

                    <h3>Made with Love</h3>

                    <p class="text-muted">You have to make your websites with love these days!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">Let's Get In Touch!</h2>
                <hr class="primary">
                <p>sadsadsadsa sadasd sad asd sa d asd sa d sad as d sad asd as d asd sad</p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <i class="fa fa-phone fa-3x wow bounceIn"></i>

                <p>123-456-6789</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>

                <p><a href="mailto:your-email@your-domain.com">feedback@gmail.com</a></p>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="<?= site_url('include/web/js/jquery.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= site_url('include/web/js/bootstrap.min.js') ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?= site_url('include/web/js/jquery.easing.min.js') ?>"></script>
<script src="<?= site_url('include/web/js/jquery.fittext.js') ?>"></script>
<script src="<?= site_url('include/web/js/wow.min.js') ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= site_url('include/form_validation/dist/js/bootstrapValidator.min.js') ?>"></script>
<link href="<?= site_url('include/form_validation/src/css/bootstrapValidator.css') ?>" rel="stylesheet">

<script type="text/javascript">
    //login_stu

    $(document).ready(function () {

        $('#Students').click(function () {
            $('#login_stu_m').modal('show');
        });

        $('#Supervisor').click(function () {
            $('#login_sup_m').modal('show');
        });
        $('#Trainer').click(function () {
            $('#login_tra_m').modal('show');
        });

        $('#register_stu').click(function () {
            $('#register_stu_m').modal('show');
        });


        $('#login_student').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username_stu: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},
                password_stu: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    location.reload();
                }
                else {
                    $('#massage').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
                alert('error');
            });
        });

        $('#login_sup').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username_sup: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},
                password_sup: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    location.reload();
                }
                else {
                    $('#massage').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
                alert('error');
            });
        });

        $('#register_student').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?= tpl_students::students() . '_' . tpl_students::first_name()  ?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},
                '<?= tpl_students::students() . '_' . tpl_students::last_name()  ?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},
                '<?= tpl_students::students() . '_' . tpl_students::first_name()  ?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?= tpl_students::students() . '_' . tpl_students::password()  ?>': {
                    validators: {
                        notEmpty: {message: 'The field is required and can\'t be empty'}

                    }
                },

                '<?= tpl_students::students() . '_' . tpl_students::password().'_re'?>': {
                    validators: {
                        notEmpty: {message: 'The field is required and can\'t be empty'}
                    },
                    identical: {
                        field: '<?=tpl_students::students().'_'.tpl_students::password()?>',
                        message: 'The password and its confirm are not the same'
                    }
                },

                '<?=tpl_students::students().'_'.tpl_students::id_university()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},


                '<?=tpl_students::students().'_'.tpl_students::id_college()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?=tpl_students::students().'_'.tpl_students::id_specialty()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},


                '<?=tpl_students::students().'_'.tpl_students::id_supervisor()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?=tpl_category::category().'_'.tpl_category::id()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?=tpl_companies::companies().'_'.tpl_companies::id()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?=tpl_department::department().'_'.tpl_department::id()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?=tpl_section::section().'_'.tpl_section::id()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},

                '<?=tpl_students::students().'_'.tpl_students::username()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},
                '<?=tpl_students::students().'_'.tpl_students::email()?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}

            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    location.reload();
                }
                else {

                    $('#result_massages_tra_12').html(
                        <?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
                alert('error');
            });
        });

        $('#<?=tpl_students::students().'_'.tpl_students::id_university()?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('site/get_all_college')?>', {id_university: id}, function (result) {
                $('.College').css('display', 'block');
                $('#<?=tpl_students::students().'_'.tpl_students::id_college()?>').html(result);
            });
        });

        $('#<?=tpl_students::students().'_'.tpl_students::id_college()?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('site/get_all_specialty')?>', {id_college: id}, function (result) {
                $('.Specialty').css('display', 'block');
                $('#<?=tpl_students::students().'_'.tpl_students::id_specialty()?>').html(result);
            });
        });


        $('#<?=tpl_students::students().'_'.tpl_students::id_specialty()?>').change(function () {
            var id_university = $('#<?=tpl_students::students().'_'.tpl_students::id_university()?>').val();

            var id_college = $('#<?=tpl_students::students().'_'.tpl_students::id_college()?>').val();

            $.post('<?=site_url('site/get_all_supervisor')?>', {
                id_university: id_university,
                id_college: id_college
            }, function (result) {
                $('.Supervisor').css('display', 'block');
                $('#<?=tpl_students::students().'_'.tpl_students::id_supervisor()?>').html(result);
            });
        });


        $('#<?=tpl_students::students().'_'.tpl_students::id_supervisor()?>').change(function () {
            $('.Category').css('display', 'block');
        });


        $('#<?=tpl_category::category().'_'.tpl_category::id()?>').change(function () {

            var id = $(this).val();
            $.post('<?=site_url('site/get_all_companies')?>', {id_category: id}, function (result) {
                $('.companies').css('display', 'block');
                $('#<?=tpl_companies::companies().'_'.tpl_companies::id()?>').html(result);
            });
        });


        $('#<?=tpl_companies::companies().'_'.tpl_companies::id()?>').change(function () {

            var id = $(this).val();

            $.post('<?=site_url('site/get_all_department')?>', {id_companies: id}, function (result) {
                $('.department').css('display', 'block');
                $('#<?=tpl_department::department().'_'.tpl_department::id()?>').html(result);
            });
        });

        $('#<?=tpl_department::department().'_'.tpl_department::id()?>').change(function () {

            var id = $(this).val();

            $.post('<?=site_url('site/get_all_section')?>', {id_department: id}, function (result) {
                $('.section').css('display', 'block');
                $('#<?=tpl_section::section().'_'.tpl_section::id()?>').html(result);
            });
        });


    });
</script>

<div class="modal fade" id="login_stu_m" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2>Login Student</h2>
            </div>
            <div class="modal-body">
                <form class="form" id="login_student" method="post" action="<?= site_url('students/home_stu/login') ?>">
                    <div class="form-group">
                        <label>Username : </label>
                        <input type="text" class="form-control" id="username_stu" name="username_stu"/>
                    </div>
                    <div class="form-group">
                        <label>Password : </label>
                        <input type="password" class="form-control" id="password_stu" name="password_stu"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="login" name="login">Login Now!!</button>
                </form>
                </br>
                </br>
                <div class="" id="result_massages_stu"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="login_sup_m" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2>Login Supervisor</h2>
            </div>
            <div class="modal-body">
                <form class="form" id="login_sup" method="post" action="<?= site_url('supervisor/home_sup/login') ?>">
                    <div class="form-group">
                        <label>Username : </label>
                        <input type="text" class="form-control" id="username_sup" name="username_sup"/>
                    </div>
                    <div class="form-group">
                        <label>Password : </label>
                        <input type="password" class="form-control" id="password_sup" name="password_sup"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="login" name="login">Login Now!!</button>
                </form>
                </br>
                </br>
                <div class="" id="result_massages_sup"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="login_tra_m" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2>Login Trainer</h2>
            </div>
            <div class="modal-body">
                <form class="form" id="login_tra" method="post" action="<?= site_url() ?>">
                    <div class="form-group">
                        <label>Username : </label>
                        <input type="text" class="form-control" id="username_tra" name="username_tra"/>
                    </div>
                    <div class="form-group">
                        <label>Password : </label>
                        <input type="password" class="form-control" id="password_tra" name="password_tra"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="login" name="login">Login Now!!</button>
                </form>
                </br>
                </br>
                <div class="" id="result_massages_tra"></div>
            </div>
        </div>
    </div>
</div>
<?= $use = new class_loader();
$use->use_lib('site/students/students_lib');

$class_students = new students_lib();

?>
<div class="modal fade" id="register_stu_m" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:30%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2>Register student</h2>
            </div>
            <div class="modal-body">
                <form class="form" id="register_student" method="post" action="<?= site_url('site/new_students') ?>">

                    <div class="form-group">
                        <label for="">First name : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::first_name() ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::first_name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""> Last name : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::last_name() ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::last_name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""> Username : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::username() ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::username() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""> Email : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::email() ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::email() ?>"/>
                    </div>


                    <div class="form-group">
                        <label for="">Password : </label>
                        <input type="password" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::password() ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::password() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Password re: </label>
                        <input type="password" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::password() . '_re' ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::password() . '_re' ?>"/>
                    </div>


                    <div class="form-group">
                        <label>University : </label>
                        <select name="<?= tpl_students::students() . '_' . tpl_students::id_university() ?>"
                                id="<?= tpl_students::students() . '_' . tpl_students::id_university() ?>"
                                class="form-control">
                            <option></option>
                            <?php print $class_students->find_university() ?>
                        </select>
                    </div>

                    <div class="form-group College" style="display: none">
                        <label>College : </label>
                        <select name="<?= tpl_students::students() . '_' . tpl_students::id_college() ?>"
                                id="<?= tpl_students::students() . '_' . tpl_students::id_college() ?>"
                                class="form-control">
                        </select>
                    </div>

                    <div class="form-group Specialty" style="display: none">
                        <label>Specialty : </label>
                        <select name="<?= tpl_students::students() . '_' . tpl_students::id_specialty() ?>"
                                id="<?= tpl_students::students() . '_' . tpl_students::id_specialty() ?>"
                                class="form-control">

                        </select>
                    </div>


                    <div class="form-group Supervisor" style="display: none">
                        <label>Supervisor : </label>
                        <select name="<?= tpl_students::students() . '_' . tpl_students::id_supervisor() ?>"
                                id="<?= tpl_students::students() . '_' . tpl_students::id_supervisor() ?>"
                                class="form-control">

                        </select>
                    </div>


                    <div class="form-group Category" style="display: none">
                        <label>Category : </label>
                        <select name="<?= tpl_category::category() . '_' . tpl_category::id() ?>"
                                id="<?= tpl_category::category() . '_' . tpl_category::id() ?>"
                                class="form-control">
                            <?= $class_students->get_all_category() ?>
                        </select>
                    </div>

                    <div class="form-group companies" style="display: none">
                        <label>Companies : </label>
                        <select name="<?= tpl_companies::companies() . '_' . tpl_companies::id() ?>"
                                id="<?= tpl_companies::companies() . '_' . tpl_companies::id() ?>"
                                class="form-control">

                        </select>
                    </div>

                    <div class="form-group department" style="display: none">
                        <label>Department : </label>
                        <select name="<?= tpl_department::department() . '_' . tpl_department::id() ?>"
                                id="<?= tpl_department::department() . '_' . tpl_department::id() ?>"
                                class="form-control">

                        </select>
                    </div>

                    <div class="form-group section" style="display: none">
                        <label>Section : </label>
                        <select name="<?= tpl_section::section() . '_' . tpl_section::id() ?>"
                                id="<?= tpl_section::section() . '_' . tpl_section::id() ?>"
                                class="form-control">

                        </select>
                    </div>


                    <button type="submit" class="btn btn-success btn-block" id="login" name="login">Register Now!!
                    </button>
                </form><br><br> <div class="" id="result_massages_tra_12" style="display: block"></div>

            </div>
        </div>
    </div>
</div>

</body>

</html>
