<div class="col-sm-12 main">
    <div class="row">
        <h2 class="page-header">supervisor</h2>

        <div class="col-sm-6">
            <h3 class="page-header">Number Students</h3>
            <div class="table-responsive">
                <table id="table_srudent" data-toggle="table"
                       data-url="<?= site_url('admin/supervisor/ajax_students') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_supervisor::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_supervisor::name() ?>"
                            data-formatter="operate<?= tpl_supervisor::supervisor()?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?=  tpl_college::college().'_'.tpl_college::name() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_college::college()?>"
                            data-sortable="true">college
                        </th>

                        <th data-field="<?=   tpl_university::university().'_'.tpl_university::name() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_university::university()?>"
                            data-sortable="true">university
                        </th>

                        <th data-field="<?= tpl_students::students().'_'.tpl_students::id() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_college::college()?>"
                            data-sortable="true"># students
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="col-sm-6">
            <h3 class="page-header">Number college</h3>

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
                       data-url="<?= site_url('admin/supervisor/ajax_all') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_supervisor::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_supervisor::name() ?>"
                            data-formatter="operate<?= tpl_supervisor::supervisor()?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?=  tpl_college::college().'_'.tpl_college::name() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_college::college()?>"
                            data-sortable="true">college
                        </th>

                        <th data-field="<?=   tpl_university::university().'_'.tpl_university::name() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_university::university()?>"
                            data-sortable="true">university
                        </th>

                        <th data-field="<?= tpl_supervisor::active() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_supervisor::active() ?>"
                            data-sortable="true">active
                        </th>
                        <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"
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
    function operate<?= tpl_college::college()?>(value, row) {

        return '<a href="<?=site_url('admin/college/view_student/?id=')?>'+row.<?=tpl_supervisor::id_college() ?>+'">'+value+'</a>'
    }

    function operate<?= tpl_university::university()?>(value, row) {

        return '<a href="<?=site_url('admin/university/view_student/?id=')?>'+row.<?=tpl_supervisor::id_university() ?>+'">'+value+'</a>'
    }

    function operate<?= tpl_supervisor::supervisor()?>(value, row) {

        return '<a href="<?=site_url('admin/supervisor/view_student/?id=')?>'+row.<?=tpl_supervisor::id() ?>+'">'+value+'</a>'
    }
</script>
<script type="text/javascript">
    function operate<?= tpl_supervisor::active() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_supervisor::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_supervisor::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_supervisor::supervisor().'/update_status')?>',
                {
                    '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id() ?>': id,
                    '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::active()?>': value
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
                $.post('<?= site_url('admin/'.tpl_supervisor::supervisor().'/remove')?>', {'<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id()?>': row.<?=tpl_supervisor::id()?>}, function (result) {
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
            $('#<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id().'_update'?>').val(row.<?=tpl_supervisor::id()?>);
            $('#<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::name().'_update'?>').val(row.<?=tpl_supervisor::name()?>);
            $('#<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college().'_update'?>').val(row.<?=tpl_supervisor::id_college()?>);
            $('#<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university().'_update'?>').val(row.<?=tpl_supervisor::id_university()?>);


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
                '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
,
                '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
,
                '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university()?>': {
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
                '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }, '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
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
                <h4>New <?= tpl_supervisor::supervisor() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_supervisor::supervisor() . '/insert') ?>">
                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_supervisor::name() . ' ' . tpl_supervisor::supervisor() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() ?>"
                               name="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_supervisor::supervisor()?> : </label>
                        <select name="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college()?>"
                                id="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college()?>"
                                class="form-control">
                            <?php $new = new supervisor_lib_ad(); echo $new->find_college()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_supervisor::supervisor()?> : </label>
                        <select name="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university()?>"
                                id="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university()?>"
                                class="form-control">
                            <?php $new = new supervisor_lib_ad(); echo $new->find_university()?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                </br></br>
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
                <h4>Update <?= tpl_supervisor::supervisor() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_supervisor::supervisor() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::id() . '_update' ?>"
                               id="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::id() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_supervisor::name() . ' ' . tpl_supervisor::supervisor() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() . '_update' ?>"
                               name="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_supervisor::supervisor()?> : </label>
                        <select name="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college(). '_update'?>"
                                id="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_college(). '_update'?>"
                                class="form-control">
                            <?php $new = new supervisor_lib_ad(); echo $new->find_college()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_supervisor::supervisor()?> : </label>
                        <select name="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university(). '_update'?>"
                                id="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::id_university(). '_update'?>"
                                class="form-control">
                            <?php $new = new supervisor_lib_ad(); echo $new->find_university()?>
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
