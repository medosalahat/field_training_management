<div class="col-sm-12 main">
    <div class="row">
        <h2 class="page-header">Models</h2>
        <div class="col-sm-12">
            <div class="col-sm-12">
                <p id="status_massage"></p>
                </br>
            </div>
            <div id="toolbar">
                <button id="add_new_btn" class="btn btn-success btn-xs">Add</button>
                </br>
            </div>
            <div class="table-responsive">
                <table id="table" data-toggle="table"
                       data-url="<?= site_url('admin/models/ajax_all') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_models::id() ?>" data-halign="center" data-sortable="true"> id</th>

                        <th data-field="<?= tpl_students::students().'_'.tpl_students::first_name() ?>"
                            data-halign="center" data-sortable="true"> first name
                        </th>

                        <th data-field="<?=  tpl_students::students().'_'.tpl_students::last_name() ?>"
                            data-halign="center" data-sortable="true"> Last name
                        </th>

                        <th data-field="<?=  tpl_companies::companies().'_'.tpl_companies::name() ?>"
                            data-halign="center" data-sortable="true"> Companies
                        </th>
                        <th data-field="<?=   tpl_university::university().'_'.tpl_university::name() ?>"
                            data-halign="center" data-sortable="true"> University
                        </th>

                        <th data-field="<?=      tpl_college::college().'_'.tpl_college::name() ?>"
                            data-halign="center" data-sortable="true"> college
                        </th>


                        <th data-field="<?=       tpl_specialty::specialty().'_'.tpl_specialty::name() ?>"
                            data-halign="center" data-sortable="true"> specialty
                        </th>

                        <th data-field="<?=  tpl_department::department().'_'.tpl_department::name() ?>"
                            data-halign="center" data-sortable="true"> Department
                        </th>

                        <th data-field="<?=  tpl_section::section().'_'.tpl_section::name() ?>"
                            data-halign="center" data-sortable="true"> Section
                        </th>

                        <th data-field="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::name()?>"
                            data-halign="center" data-sortable="true"> Supervisor
                        </th>

                        <th data-field="<?= tpl_models::active() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_models::active() ?>"
                            data-sortable="true">active
                        </th>


                        <th data-field="operate"
                            data-formatter="operateFormatter"
                            data-events="operateEvents"
                            data-align="center">Action
                        </th>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function operate<?= tpl_models::active() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_models::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_models::id() ?> + ',1)" type="checkbox"/>';
    }

    function update_status(id, value) {
        $(document).ready(function () {

            $.post('<?= site_url('admin/'.tpl_models::models().'/update_status')?>',
                {
                    '<?=tpl_models::models().'_'.tpl_models::id() ?>': id,
                    '<?=tpl_models::models().'_'.tpl_models::active()?>': value
                }, function (result) {


                    var data = JSON.parse(result);
                    if (data['valid']) {
                        $('#status_massage').html(<?=class_massage::info('title','massage')?>);
                        window.setTimeout(function () {
                            $('#status_massage').html('');
                        }, 2000);
                        var $table = $('#table');
                        $table.bootstrapTable('showLoading');
                        $table.bootstrapTable('refresh');
                    } else {
                        $('#status_massage').html(<?=class_massage::danger('title','massage')?>);
                    }

                }).fail(function () {
                    alert("Error");
                });
        });
    }
</script>
<script type="text/javascript">


    function operateFormatter(value, row, index) {
        return [
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove" title="Remove Row"></i>',
            '</a>',

            '<a class="update ml10" href="javascript:void(0)" title="Update row">',
            '<i class="glyphicon glyphicon-edit" title="Update Row"></i>',
            '</a>'

        ].join('');
    }



    window.operateEvents = {

        'click .remove': function (e, value, row, index) {


            if (confirm("Did you actually want to delete the Models!")) {


                $.post('<?= site_url('admin/'.tpl_models::models().'/remove')?>',
                    {'<?=tpl_models::models().'_'.tpl_models::id()?>': row.<?=tpl_models::id()?>}, function (result) {
                    var data = JSON.parse(result);
                    if (data['valid']) {
                        $('#status_massage').html(<?=class_massage::info('title','massage')?>);
                        window.setTimeout(function () {
                            $('#status_massage').html('');
                        }, 2000);
                    } else {
                        $('#status_massage').html(<?=class_massage::danger('title','massage')?>);
                    }
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');

                    var $table2 = $('#table_srudent');
                    $table2.bootstrapTable('showLoading');
                    $table2.bootstrapTable('refresh');
                });
            }
        },


        'click .update': function (e, value, row, index) {

            $('#update').modal('show');

            $('#<?=tpl_models::models().'_'.tpl_models::id().'_update'?>').val(row.<?=tpl_models::id()?>);

            $('#<?=tpl_models::models().'_'.tpl_models::id_student().'_update'?>').val(row.<?=tpl_models::id_student()?>);

            $('#<?=tpl_models::models().'_'.tpl_models::id_companies().'_update'?>').val(row.<?=tpl_models::id_companies()?>);

            $('#<?=tpl_models::models().'_'.tpl_models::id_department().'_update'?>').val(row.<?=tpl_models::id_department()?>);

            $('#<?=tpl_models::models().'_'.tpl_models::id_section().'_update'?>').val(row.<?=tpl_models::id_section()?>);

            $('#<?=tpl_models::models().'_'.tpl_models::id_supervisor().'_update'?>').val(row.<?=tpl_models::id_supervisor()?>);

            var id = $('#<?=tpl_models::models().'_'.tpl_models::id_student().'_update'?>').val();
            $.post('<?=site_url('admin/models/find_supervisor')?>', {id_students: id}, function (result) {
                $('.supervisor').css('display', 'block');
                $('#<?=tpl_models::models().'_'.tpl_models::id_supervisor().'_update'?>').html(result);
            });

        }
    };

    $(document).ready(function () {

        $('#add_new_btn').click(function () {
            $('#add').modal('show');
        });
        $('#add_new').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_models::models().'_'.tpl_models::id_student()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },'<?=tpl_models::models().'_'.tpl_models::id_companies()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },'<?=tpl_models::models().'_'.tpl_models::id_department()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },'<?=tpl_models::models().'_'.tpl_models::id_section()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },'<?=tpl_models::models().'_'.tpl_models::id_supervisor()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

            }

        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    $('#result_massages_save').html(<?=class_massage::info('title','massage')?>);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    var $table2 = $('#table_srudent');
                    $table2.bootstrapTable('showLoading');
                    $table2.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#add').modal('hide');
                    }, 2000);
                } else {
                    $('#result_massages_save').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });

        $('#update_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_models::models().'_'.tpl_models::id_student().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,'<?=tpl_models::models().'_'.tpl_models::id().'_update'?>':
                {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
                ,'<?=tpl_models::models().'_'.tpl_models::id_companies().'_update'?>':
                {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
                ,'<?=tpl_models::models().'_'.tpl_models::id_department().'_update'?>':
                {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
                ,'<?=tpl_models::models().'_'.tpl_models::id_section().'_update'?>':
                {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
                ,'<?=tpl_models::models().'_'.tpl_models::id_supervisor().'_update'?>':
                {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);

                if (data['valid']) {
                    $('#result_massages_update').html(<?=class_massage::info('title','massage')?>);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    var $table2 = $('#table_srudent');
                    $table2.bootstrapTable('showLoading');
                    $table2.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#update').modal('hide');
                    }, 2000);
                } else {
                    $('#result_massages_update').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });
    });
</script>

<div class="modal fade" id="add" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New <?= tpl_models::models() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>


            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_models::models() . '/insert') ?>">

                    <div class="form-group">
                        <label>Student <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_student()?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_student()?>"
                                class="form-control">
                            <?php
                            $new = new models_lib_ad();
                            echo $new->find_students()
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>companies <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_companies()?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_companies()?>"
                                class="form-control">
                            <?php
                            $new = new models_lib_ad();
                            echo $new->find_companies()
                            ?>
                        </select>
                    </div>

                    <div class="form-group department" style="display: none">
                        <label>Department <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_department()?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_department()?>"
                                class="form-control">

                        </select>
                    </div>

                    <div class="form-group section" style="display: none">
                        <label>section <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_section()?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_section()?>"
                                class="form-control">

                        </select>
                    </div>

                    <div class="form-group supervisor" style="display: none">
                        <label>Supervisor <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_supervisor()?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_supervisor()?>"
                                class="form-control">
                            <?php //$new = new models_lib_ad(); echo $new->find_supervisor()?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                <div class="" id="result_massages_save"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function () {

        $('#<?=tpl_models::models().'_'.tpl_models::id_companies()?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('admin/models/find_department')?>', {id_companies: id}, function (result) {
                $('.department').css('display', 'block');
                $('#<?=tpl_models::models().'_'.tpl_models::id_department()?>').html(result);
            });
        });


        $('#<?=tpl_models::models().'_'.tpl_models::id_department()?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('admin/models/find_section')?>', {id_department: id}, function (result) {
                $('.section').css('display', 'block');
                $('#<?=tpl_models::models().'_'.tpl_models::id_section()?>').html(result);
            });
        });

        $('#<?=tpl_models::models().'_'.tpl_models::id_student()?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('admin/models/find_supervisor')?>', {id_students: id}, function (result) {
                $('.supervisor').css('display', 'block');
                $('#<?=tpl_models::models().'_'.tpl_models::id_supervisor()?>').html(result);
            });
        });





    });
    //
</script>


<script type="text/javascript">


    $(document).ready(function () {

        $('#<?=tpl_models::models().'_'.tpl_models::id_companies().'_update'?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('admin/models/find_department')?>', {id_companies: id}, function (result) {

                $('#<?=tpl_models::models().'_'.tpl_models::id_department().'_update'?>').html(result);
            });
        });


        $('#<?=tpl_models::models().'_'.tpl_models::id_department().'_update'?>').change(function () {
            var id = $(this).val();
            $.post('<?=site_url('admin/models/find_section')?>', {id_department: id}, function (result) {

                $('#<?=tpl_models::models().'_'.tpl_models::id_section().'_update'?>').html(result);
            });
        });











    });
    //
</script>




<div class="modal fade" id="update" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Update <?= tpl_category::category() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_models::models() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_models::models() . '_' . tpl_models::id() . '_update' ?>"
                               id="<?= tpl_models::models() . '_' . tpl_models::id() . '_update' ?>"/>
                    </div>


                    <div class="form-group">
                        <label>Student <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_student().'_update'?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_student().'_update'?>"
                                class="form-control">
                            <?php $new = new models_lib_ad(); echo $new->find_students()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>companies <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_companies().'_update'?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_companies().'_update'?>"
                                class="form-control">
                            <?php $new = new models_lib_ad(); echo $new->find_companies()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>department <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_department().'_update'?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_department().'_update'?>"
                                class="form-control">
                            <?php// $new = new models_lib_ad(); echo $new->find_department()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>section <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_section().'_update'?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_section().'_update'?>"
                                class="form-control">
                            <?php //$new = new models_lib_ad(); echo $new->find_section()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Supervisor <?=tpl_models::models()?> : </label>
                        <select name="<?=tpl_models::models().'_'.tpl_models::id_supervisor().'_update'?>"
                                id="<?=tpl_models::models().'_'.tpl_models::id_supervisor().'_update'?>"
                                class="form-control">
                            <?php //$new = new models_lib_ad(); echo $new->find_supervisor()?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                </br>
                </br>
                <div class="" id="result_massages_update"></div>
            </div>
        </div>
    </div>
</div>
