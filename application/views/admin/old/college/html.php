<link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
<link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
<script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="<?= site_url('admin') ?>">Home</a></li>
        <li ><a href="<?= site_url('admin/election') ?>">Election</a></li>
        <li class="active"><a href="<?= site_url('admin/college') ?>">College</a></li>
        <li><a href="<?= site_url('admin/specialty') ?>">Specialty</a></li>
        <li><a href="<?= site_url('admin/students') ?>">Students</a></li>
        <li><a href="<?= site_url('admin/slider') ?>">Slider</a></li>
        <li><a href="<?= site_url('admin/users') ?>">Users</a></li>
    </ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('table/tpl_college');
    $tpl_college = new tpl_college();
    ?>
    <h2 class="sub-header">College table</h2>
    <div id="toolbar">
        <button id="add_new_college" class="btn btn-success btn-xs">New</button>
    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table" data-url="<?= site_url('admin/find_all_college_table_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true"  data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= $tpl_college->id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= $tpl_college->name() ?>" data-halign="center" data-sortable="true"> College</th>
                <th
                    data-field="operate"
                    data-formatter="operateFormatter"
                    data-events="operateEvents"
                    data-align="center"
                    >Action
                </th>

            </tr>
            </thead>
        </table>
    </div>
</div>
</div>
</div>
<style>
    .glyphicon-ok {

        color: green;
    }

    .glyphicon-remove{

        color: #B94A48;
    }
    i.form-control-feedback.glyphicon.glyphicon-ok ,i.form-control-feedback.glyphicon.glyphicon-remove{
        position: absolute;
        top: 57px;
        right: 29px;
    }
</style>
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
                $.post('<?= site_url('admin/remove_college_row')?>', {id: row.<?=$tpl_college->id()?>}, function (data) {
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                });
            }
        },
        'click .update': function (e, value, row, index) {
            $('#update').modal('show');
            $('#id').val(row.<?=$tpl_college->id()?>);
            $('#name_update').val(row.<?=$tpl_college->name()?>);
        }
    };

    $(document).ready(function(){

        $('#add_new_college').click(function(){$('#add').modal('show');});

        $('#add_new').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons:{
                valid:'glyphicon glyphicon-ok',
                invalid:'glyphicon glyphicon-remove',
                validating:'glyphicon glyphicon-refresh'},
            fields:{name_college:{validators:{notEmpty:{message:'The field is required and can\'t be empty'}}}}
        }).on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function(result) {
                var data = JSON.parse(result);
                if(data['valid']){
                    $('#result_massages_save').html(data['massage']);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                }
            }).fail(function() {});
        });

        $('#update_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons:{
                valid:'glyphicon glyphicon-ok',
                invalid:'glyphicon glyphicon-remove',
                validating:'glyphicon glyphicon-refresh'},
            fields:{name_update:{validators:{notEmpty:{message:'The field is required and can\'t be empty'}}}
            ,id:{validators:{notEmpty:{message:'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function(result) {
                var data = JSON.parse(result);
                $('#update').modal('hide');
                if(data['valid']){
                    $('#result_massages_save').html(data['massage']);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                }
            }).fail(function() {});
        });
        });
</script>


<div class="modal fade" id="add" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New College<small id="TitlePostSmall"></small></h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post" action="<?=site_url('admin/add_new_college')?>">
                    <div class="form-group">
                        <label for="Edit_NameCategory">Name College : </label>
                        <input type="text" class="form-control" id="name_college" name="name_college"/>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                <div class="" id="result_massages_save"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="update" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New College<small id="TitlePostSmall"></small></h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post" action="<?=site_url('admin/update_college')?>">

                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value=""/>
                    </div>

                    <div class="form-group">
                        <label for="Edit_NameCategory">Name College : </label>
                        <input type="text" class="form-control" id="name_update" name="name_update"/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                <div class="" id="result_massages_update"></div>
            </div>
        </div>
    </div>
</div>