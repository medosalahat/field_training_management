<div class="col-sm-12 main">
    <div class="row">
        <h2 class="page-header">department</h2>
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
                       data-url="<?= site_url('admin/department/ajax_all') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_department::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_department::name() ?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?= tpl_companies::companies().'_'.tpl_companies::name() ?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?= tpl_department::active() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_department::active() ?>"
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
    function operate<?= tpl_department::active() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_department::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_department::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_department::department().'/update_status')?>',
                {
                    '<?=tpl_department::department().'_'.tpl_department::id() ?>': id,
                    '<?=tpl_department::department().'_'.tpl_department::active()?>': value
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
                $.post('<?= site_url('admin/'.tpl_department::department().'/remove')?>', {'<?=tpl_department::department().'_'.tpl_department::id()?>': row.<?=tpl_department::id()?>}, function (result) {
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
            $('#<?=tpl_department::department().'_'.tpl_department::id().'_update'?>').val(row.<?=tpl_department::id()?>);
            $('#<?=tpl_department::department().'_'.tpl_department::name().'_update'?>').val(row.<?=tpl_department::name()?>);
            $('#<?=tpl_department::department().'_'.tpl_department::id_companies().'_update'?>').val(row.<?=tpl_department::id_companies()?>);


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
                '<?=tpl_department::department().'_'.tpl_department::name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
,
                '<?=tpl_department::department().'_'.tpl_department::id_companies()?>': {
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
                '<?=tpl_department::department().'_'.tpl_department::name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_department::department().'_'.tpl_department::id_companies().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_department::department().'_'.tpl_department::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
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
                <h4>New <?= tpl_department::department() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_department::department() . '/insert') ?>">
                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_department::name() . ' ' . tpl_department::department() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_department::department() . '_' . tpl_department::name() ?>"
                               name="<?= tpl_department::department() . '_' . tpl_department::name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_department::department()?> : </label>
                        <select name="<?=tpl_department::department().'_'.tpl_department::id_companies()?>"
                                id="<?=tpl_department::department().'_'.tpl_department::id_companies()?>"
                                class="form-control">
                            <?php $new = new department_lib_ad(); echo $new->find_companies()?>
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
                <h4>Update <?= tpl_department::department() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_department::department() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_department::department() . '_' . tpl_department::id() . '_update' ?>"
                               id="<?= tpl_department::department() . '_' . tpl_department::id() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_department::name() . ' ' . tpl_department::department() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_department::department() . '_' . tpl_department::name() . '_update' ?>"
                               name="<?= tpl_department::department() . '_' . tpl_department::name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_department::department()?> : </label>
                        <select name="<?=tpl_department::department().'_'.tpl_department::id_companies(). '_update'?>"
                                id="<?=tpl_department::department().'_'.tpl_department::id_companies(). '_update'?>"
                                class="form-control">
                            <?php $new = new department_lib_ad(); echo $new->find_companies()?>
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
