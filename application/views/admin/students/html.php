<div class="col-sm-12 main">
    <div class="row">
        <h2 class="page-header">students</h2>

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
                       data-url="<?= site_url('admin/students/ajax_all') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_students::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_students::first_name() ?>"
                            data-halign="center" data-sortable="true"> first name
                        </th>

                        <th data-field="<?= tpl_students::last_name() ?>"
                            data-halign="center" data-sortable="true"> last name
                        </th>
                        <th data-field="<?= tpl_students::password()?>"
                            data-halign="center" data-sortable="true"
                            data-formatter="operate<?= tpl_students::password() ?>"> password
                        </th>

                        <th data-field="<?= tpl_college::college() . '_' . tpl_college::name() ?>"
                            data-halign="center" data-sortable="true"> college
                        </th>

                        <th data-field="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() ?>"
                            data-halign="center" data-sortable="true"> supervisor
                        </th>

                        <th data-field="<?= tpl_specialty::specialty() . '_' . tpl_specialty::name() ?>"
                            data-halign="center" data-sortable="true"> specialty
                        </th>

                        <th data-field="<?= tpl_university::university() . '_' . tpl_university::name() ?>"
                            data-halign="center" data-sortable="true"> university
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
    function operate<?= tpl_students::password() ?>(value, row) {

        return '<small onclick="update_password(' + row.<?= tpl_students::id() ?> + ')">Click To Update !</small>';
    }
    function update_password(id) {
        $(document).ready(function () {
            $('#update_password').modal('show');
            $('#<?=tpl_students::students().'_'.tpl_students::id().'_update_password'?>').val(id);
        });
    }

    $(document).ready(function () {
    $('#update_password_form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            '<?=tpl_students::students().'_'.tpl_students::password().'_update_password'?>': {
                validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
            }
            , '<?=tpl_students::students().'_'.tpl_students::id().'_update_password'?>': {
                validators: {
                    notEmpty: {message: 'The field is required and can\'t be empty'}

                }
            }
            , '<?=tpl_students::students().'_'.tpl_students::password().'_r_update_password'?>': {
                validators: {
                    notEmpty: {message: 'The field is required and can\'t be empty'},
                    identical: {
                        field: '<?=tpl_students::students().'_'.tpl_students::password().'_update_password'?>',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post($form.attr('action'), $form.serialize(), function (result) {
            var data = JSON.parse(result);

            if (data['valid']) {
                $('#result_massages_update_password').html(<?=class_massage::info('title','massage')?>);
                var $table = $('#table');
                $table.bootstrapTable('showLoading');
                $table.bootstrapTable('refresh');
                window.setTimeout(function () {
                    $('#update_password').modal('hide');
                    $('#result_massages_update_password').html('');
                }, 2000);
            } else {
                $('#result_massages_update_password').html(<?=class_massage::danger('title','massage')?>);
            }
        }).fail(function () {
        });
    });
    });

</script>

<script type="text/javascript">
    function operateFormatter(value, row, index) {
        return [
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove"></i>',
            '</a>',
            '<a class="update ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-edit"></i>',
            '</a>'

        ].join('');
    }

    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
            if (confirm("Did you actually want to delete the College!")) {
                $.post('<?= site_url('admin/'.tpl_students::students().'/remove')?>', {'<?=tpl_students::students().'_'.tpl_students::id()?>': row.<?=tpl_students::id()?>}, function (result) {
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
            $('#<?=tpl_students::students().'_'.tpl_students::id().'_update'?>').val(row.<?=tpl_students::id()?>);
            $('#<?=tpl_students::students().'_'.tpl_students::first_name().'_update'?>').val(row.<?=tpl_students::first_name()?>);
            $('#<?=tpl_students::students().'_'.tpl_students::last_name().'_update'?>').val(row.<?=tpl_students::last_name()?>);
            $('#<?=tpl_students::students().'_'.tpl_students::id_college().'_update'?>').val(row.<?=tpl_students::id_college()?>);
            $('#<?=tpl_students::students().'_'.tpl_students::id_university().'_update'?>').val(row.<?=tpl_students::id_university()?>);
            $('#<?=tpl_students::students().'_'.tpl_students::id_specialty().'_update'?>').val(row.<?=tpl_students::id_specialty()?>);
            $('#<?=tpl_students::students().'_'.tpl_students::id_supervisor().'_update'?>').val(row.<?=tpl_students::id_supervisor()?>);


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
                '<?=tpl_students::students().'_'.tpl_students::first_name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_students::students().'_'.tpl_students::last_name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }, '<?=tpl_students::students().'_'.tpl_students::id_college()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }, '<?=tpl_students::students().'_'.tpl_students::id_supervisor()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }, '<?=tpl_students::students().'_'.tpl_students::id_specialty()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }, '<?=tpl_students::students().'_'.tpl_students::id_university()?>': {
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
                '<?=tpl_students::students().'_'.tpl_students::first_name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_students::students().'_'.tpl_students::last_name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_students::students().'_'.tpl_students::id_college().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_students::students().'_'.tpl_students::id_specialty().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_students::students().'_'.tpl_students::id_supervisor().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_students::students().'_'.tpl_students::id_university().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_students::students().'_'.tpl_students::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
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
                <h4>New <?= tpl_students::students() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_students::students() . '/insert') ?>">

                    <div class="form-group">
                        <label for=""><?= tpl_students::first_name() . ' ' . tpl_students::students() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::first_name()  ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::first_name()  ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_students::last_name() . ' ' . tpl_students::students() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::last_name()  ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::last_name()  ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_students::password() . ' ' . tpl_students::students() ?> : </label>
                        <input type="password" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::password()  ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::password()  ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_college()?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_college()?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_college()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>specialty <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_specialty()?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_specialty()?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_specialty()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>university <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_university()?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_university()?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_university()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>supervisor <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_supervisor()?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_supervisor()?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_supervisor()?>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                <div class="" id="result_massages_save"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="update" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Update <?= tpl_students::students() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_students::students() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_students::students() . '_' . tpl_students::id() . '_update' ?>"
                               id="<?= tpl_students::students() . '_' . tpl_students::id() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_students::first_name() . ' ' . tpl_students::students() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::first_name() . '_update' ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::first_name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_students::last_name() . ' ' . tpl_students::students() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::last_name() . '_update' ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::last_name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_college(). '_update'?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_college(). '_update'?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_college()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>specialty <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_specialty(). '_update'?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_specialty(). '_update'?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_specialty()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>university <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_university(). '_update'?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_university(). '_update'?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_university()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>supervisor <?=tpl_students::students()?> : </label>
                        <select name="<?=tpl_students::students().'_'.tpl_students::id_supervisor(). '_update'?>"
                                id="<?=tpl_students::students().'_'.tpl_students::id_supervisor(). '_update'?>"
                                class="form-control">
                            <?php $new = new students_lib_ad(); echo $new->find_supervisor()?>
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



<div class="modal fade" id="update_password" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Update <?= tpl_students::students() ?> Password
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_password_form" method="post"
                      action="<?= site_url('admin/' . tpl_students::students() . '/update_password') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_students::students() . '_' . tpl_students::id() . '_update_password' ?>"
                               id="<?= tpl_students::students() . '_' . tpl_students::id() . '_update_password' ?>"
                               value=""/>
                    </div>

                    <div class="form-group">
                        <label for="">New Password <?= tpl_students::students() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::password() . '_update_password' ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::password() . '_update_password' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Retype New Password <?= tpl_students::students() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_students::students() . '_' . tpl_students::password() . '_r_update_password' ?>"
                               name="<?= tpl_students::students() . '_' . tpl_students::password() . '_r_update_password' ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                </br>
                <div class="" id="result_massages_update_password"></div>
            </div>
        </div>
    </div>
</div>