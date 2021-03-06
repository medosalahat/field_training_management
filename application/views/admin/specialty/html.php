<div class="col-sm-12 main">
    <div class="row">
        <h2 class="page-header">specialty</h2>

        <div class="col-sm-6">
            <h3 class="page-header">Number Students</h3>
            <div class="table-responsive">
                <table id="table_srudent" data-toggle="table"
                       data-url="<?= site_url('admin/specialty/ajax_students') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_specialty::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_specialty::name() ?>"
                            data-formatter="operate<?= tpl_specialty::specialty()?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?= tpl_college::college().'_'.tpl_college::name() ?>"
                            data-formatter="operate<?= tpl_college::college()?>"
                            data-halign="center" data-sortable="true">College
                        </th>

                        <th data-field="<?= tpl_students::students().'_'.tpl_students::id() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_specialty::specialty()?>"
                            data-sortable="true"># students
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="col-sm-6">
            <h3 class="page-header">Number specialty</h3>

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
                       data-url="<?= site_url('admin/specialty/ajax_all') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_specialty::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_specialty::name() ?>"
                            data-formatter="operate<?= tpl_specialty::specialty()?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?= tpl_college::college().'_'.tpl_college::name() ?>"
                            data-formatter="operate<?= tpl_college::college()?>"
                            data-halign="center" data-sortable="true"> college
                        </th>

                        <th data-field="<?= tpl_specialty::active() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_specialty::active() ?>"
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
    function operate<?= tpl_specialty::specialty()?>(value, row) {

        return '<a href="<?=site_url('admin/specialty/view_student/?id=')?>'+row.<?=tpl_specialty::id() ?>+'">'+value+'</a>'
    }

    function operate<?= tpl_college::college()?>(value, row) {

        return '<a href="<?=site_url('admin/college/view_student/?id=')?>'+row.<?=tpl_specialty::id() ?>+'">'+value+'</a>'
    }
</script>
<script type="text/javascript">
    function operate<?= tpl_specialty::active() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_specialty::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_specialty::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_specialty::specialty().'/update_status')?>',
                {
                    '<?=tpl_specialty::specialty().'_'.tpl_specialty::id() ?>': id,
                    '<?=tpl_specialty::specialty().'_'.tpl_specialty::active()?>': value
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
                $.post('<?= site_url('admin/'.tpl_specialty::specialty().'/remove')?>', {'<?=tpl_specialty::specialty().'_'.tpl_specialty::id()?>': row.<?=tpl_specialty::id()?>}, function (result) {
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
            $('#<?=tpl_specialty::specialty().'_'.tpl_specialty::id().'_update'?>').val(row.<?=tpl_specialty::id()?>);
            $('#<?=tpl_specialty::specialty().'_'.tpl_specialty::name().'_update'?>').val(row.<?=tpl_specialty::name()?>);
            $('#<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college().'_update'?>').val(row.<?=tpl_specialty::id_college()?>);


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
                '<?=tpl_specialty::specialty().'_'.tpl_specialty::name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college()?>': {
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
                '<?=tpl_specialty::specialty().'_'.tpl_specialty::name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,'<?=tpl_specialty::specialty().'_'.tpl_specialty::id().'_update'?>':
                {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
                ,'<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college().'_update'?>':
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
                <h4>New <?= tpl_specialty::specialty() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_specialty::specialty() . '/insert') ?>">
                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_specialty::name() . ' ' . tpl_specialty::specialty() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_specialty::specialty() . '_' . tpl_specialty::name() ?>"
                               name="<?= tpl_specialty::specialty() . '_' . tpl_specialty::name() ?>"/>
                    </div>


                    <div class="form-group">
                        <label>College <?=tpl_specialty::specialty()?> : </label>
                        <select name="<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college()?>"
                                id="<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college()?>"
                                class="form-control">
                            <?php $new = new specialty_lib_ad(); echo $new->find_college()?>
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
                <h4>Update <?= tpl_specialty::specialty() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_specialty::specialty() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_specialty::specialty() . '_' . tpl_specialty::id() . '_update' ?>"
                               id="<?= tpl_specialty::specialty() . '_' . tpl_specialty::id() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_specialty::name() . ' ' . tpl_specialty::specialty() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_specialty::specialty() . '_' . tpl_specialty::name() . '_update' ?>"
                               name="<?= tpl_specialty::specialty() . '_' . tpl_specialty::name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label>College <?=tpl_specialty::specialty()?> : </label>
                        <select name="<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college(). '_update'?>"
                                id="<?=tpl_specialty::specialty().'_'.tpl_specialty::id_college(). '_update'?>"
                                class="form-control">
                            <?php $new = new specialty_lib_ad(); echo $new->find_college()?>
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
