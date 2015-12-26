<div class="col-sm-12 main">
    <div class="row">
        <h2 class="page-header">companies</h2>



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
                       data-url="<?= site_url('admin/companies/ajax_all') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_companies::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_companies::name() ?>"
                            data-formatter="operate<?= tpl_companies::companies()?>"
                            data-halign="center" data-sortable="true"> name
                        </th>

                        <th data-field="<?=tpl_companies::description()?>"
                            data-halign="center" data-sortable="true"> description
                        </th>

                        <th data-field="<?= tpl_companies::mobile() ?>"

                            data-halign="center" data-sortable="true"> mobile
                        </th>

                        <th data-field="<?= tpl_companies::phone() ?>"

                            data-halign="center" data-sortable="true"> phone
                        </th>

                        <th data-field="<?= tpl_companies::address() ?>"

                            data-halign="center" data-sortable="true"> address
                        </th>

                        <th data-field="<?=       tpl_category::category().'_'.tpl_category::name() ?>"

                            data-halign="center" data-sortable="true"> category
                        </th>

                        <th data-field="<?= tpl_companies::active() ?>"
                            data-halign="center"
                            data-formatter="operate<?= tpl_companies::active() ?>"
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

        <div class="col-sm-12">
            <h3 class="page-header">Number Students</h3>
            <div class="table-responsive">
                <table id="table_srudent" data-toggle="table"
                       data-url="<?= site_url('admin/companies/ajax_models') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_companies::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_companies::name() ?>"
                            data-formatter="operate<?= tpl_companies::companies()?>"
                            data-halign="center" data-sortable="true"> name
                        </th>
                        <th data-field="<?=tpl_models::models().'_'.tpl_models::id() ?>"
                            data-halign="center"
                            data-sortable="true"># students
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function operate<?= tpl_companies::companies()?>(value, row) {

        return '<a href="<?=site_url('admin/companies/view/?id=')?>'+row.<?=tpl_companies::id() ?>+'">'+value+'</a>'
    }
</script>
<script type="text/javascript">
    function operate<?= tpl_companies::active() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_companies::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_companies::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_companies::companies().'/update_status')?>',
                {
                    '<?=tpl_companies::companies().'_'.tpl_companies::id() ?>': id,
                    '<?=tpl_companies::companies().'_'.tpl_companies::active()?>': value
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
                $.post('<?= site_url('admin/'.tpl_companies::companies().'/remove')?>', {'<?=tpl_companies::companies().'_'.tpl_companies::id()?>': row.<?=tpl_companies::id()?>}, function (result) {
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
            $('#<?=tpl_companies::companies().'_'.tpl_companies::id().'_update'?>').val(row.<?=tpl_companies::id()?>);
            $('#<?=tpl_companies::companies().'_'.tpl_companies::name().'_update'?>').val(row.<?=tpl_companies::name()?>);
            $('#<?=tpl_companies::companies().'_'.tpl_companies::description().'_update'?>').val(row.<?=tpl_companies::description()?>);
            $('#<?=tpl_companies::companies().'_'.tpl_companies::address().'_update'?>').val(row.<?=tpl_companies::address()?>);
            $('#<?=tpl_companies::companies().'_'.tpl_companies::mobile().'_update'?>').val(row.<?=tpl_companies::mobile()?>);
            $('#<?=tpl_companies::companies().'_'.tpl_companies::phone().'_update'?>').val(row.<?=tpl_companies::phone()?>);
            $('#<?=tpl_companies::companies().'_'.tpl_companies::id_category().'_update'?>').val(row.<?=tpl_companies::id_category()?>);


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
                '<?=tpl_companies::companies().'_'.tpl_companies::name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::description()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::address()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::mobile()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::phone()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                , '<?=tpl_companies::companies().'_'.tpl_companies::id_category()?>': {
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
                '<?=tpl_companies::companies().'_'.tpl_companies::name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::description().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::address().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::mobile().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::phone().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::id_category().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_companies::companies().'_'.tpl_companies::id().'_update'?>':
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
                <h4>New <?= tpl_companies::companies() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_companies::companies() . '/insert') ?>">
                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::name() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::name() ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::description() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::description() ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::description() ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::address() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::address() ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::address() ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::mobile() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::mobile() ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::mobile() ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::phone() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::phone() ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::phone() ?>"/>
                    </div>

                    <div class="form-group">
                        <label>Category <?=tpl_companies::companies()?> : </label>
                        <select name="<?=tpl_companies::companies().'_'.tpl_companies::id_category()?>"
                                id="<?=tpl_companies::companies().'_'.tpl_companies::id_category()?>"
                                class="form-control">
                            <?php $new = new companies_lib_ad(); echo $new->find_category()?>
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
                <h4>Update <?= tpl_companies::companies() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_companies::companies() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::id() . '_update' ?>"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::id() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for=""><?= tpl_companies::name() . ' ' . tpl_companies::companies() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::name() . '_update' ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::description() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::description(). '_update' ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::description(). '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::address() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::address(). '_update' ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::address(). '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::mobile() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::mobile(). '_update' ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::mobile(). '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="Edit_NameCategory"><?= tpl_companies::phone() . ' ' . tpl_companies::companies() ?>
                            : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_companies::companies() . '_' . tpl_companies::phone(). '_update' ?>"
                               name="<?= tpl_companies::companies() . '_' . tpl_companies::phone(). '_update' ?>"/>
                    </div>


                    <div class="form-group">
                        <label>Category <?=tpl_companies::companies()?> : </label>
                        <select name="<?=tpl_companies::companies().'_'.tpl_companies::id_category(). '_update'?>"
                                id="<?=tpl_companies::companies().'_'.tpl_companies::id_category(). '_update'?>"
                                class="form-control">
                            <?php $new = new companies_lib_ad(); echo $new->find_category()?>
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
