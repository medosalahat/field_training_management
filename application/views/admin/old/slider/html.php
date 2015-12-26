<link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
<link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
<script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="<?= site_url('admin') ?>">Home</a></li>
        <li><a href="<?= site_url('admin/election') ?>">Election</a></li>
        <li><a href="<?= site_url('admin/college') ?>">College</a></li>
        <li><a href="<?= site_url('admin/specialty') ?>">Specialty</a></li>
        <li><a href="<?= site_url('admin/students') ?>">Students</a></li>
        <li class="active"><a href="<?= site_url('admin/slider') ?>">Slider</a></li>
        <li><a href="<?= site_url('admin/users') ?>">Users</a></li>
    </ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('table/tpl_slider');
    $tpl_slider = new tpl_slider();
    ?>
    <h2 class="sub-header">slider table</h2>

    <div id="toolbar">
        <button id="add_new_slider" class="btn btn-success btn-xs">New</button>
    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table" data-url="<?= site_url('admin/find_all_slider_table_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true" data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= $tpl_slider->id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= $tpl_slider->text() ?>" data-halign="center" data-sortable="true"> Text</th>
                <th data-field="<?= $tpl_slider->status() ?>"  data-width="10"
                    data-halign="center" data-sortable="true" data-formatter="operate<?= $tpl_slider->status() ?>"> Status
                </th>
                <th data-field="<?= $tpl_slider->image() ?>"
                    data-formatter="operate<?= $tpl_slider->image() ?>"
                    data-events="events<?= $tpl_slider->image() ?>"
                    data-width="10" data-halign="center" data-sortable="true"> Image
                </th>
                <th
                    data-field="operate"
                    data-formatter="operateFormatter"
                    data-events="operateEvents"
                    data-align="center"
                    data-width="10"
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

    .glyphicon-remove {

        color: #B94A48;
    }

    i.form-control-feedback.glyphicon.glyphicon-ok, i.form-control-feedback.glyphicon.glyphicon-remove {
        position: relative;
        top: -24px;
        float: right;
        right: 17px;
    }
</style>

<script type="text/javascript">
    function operate<?= $tpl_slider->status() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= $tpl_slider->id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?= $tpl_slider->id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id_slider, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/update_status_slider')?>', {id: id_slider, status: value}, function (result) {
                var $table = $('#table');
                $table.bootstrapTable('showLoading');
                $table.bootstrapTable('refresh');
            }).fail(function () {
                alert("Error");
            });
        });
    }
</script>

<script type="text/javascript">
    function operate<?= $tpl_slider->image() ?>(value, row) {
        return ['<a class="update ml10" href="javascript:void(0)" title="Remove">',
            '<img  src="<?=site_url()?>' + value + '" style="width: 100%" />', '</a>'].join('');
    }
    window.events<?= $tpl_slider->image() ?> = {
        'click .update': function (e, value, row, index) {

            $('#name_students').html(row.<?= $tpl_slider->text() ?>);
            $('#image_students').attr('src', '<?=site_url()?>' + row.<?= $tpl_slider->image() ?>);
            $('#update_image').modal('show');
            $('#id_image_update').val(row.<?=$tpl_slider->id()?>);
        }
    };

    $(document).ready(function () {
        $("#UploadImage").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?=site_url('admin/image_slider')?>",
                type: "POST"
                , data: new FormData(this), contentType: false,
                cache: false, processData: false,
                success: function (data) {
                    $w = $('#message_res');
                    $w.html('<div class="alert alert-success alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                        '<strong>' + data + '</strong></div>');
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    $('#update_image').modal('hide').delay(2000);

                }
            });


        }));

        $(function () {
            $("#image_update").change(function () {
                $("#message_res").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    $('#image_preview').attr('src', '<?=site_url('include/img/noimage.png')?>');
                    $("#message_res").html(
                        "<p id='error'>Please Select A valid Image File</p>"
                        + "<h4>Note</h4>" +
                        "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                }
                else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
    function imageIsLoaded(e) {
        $("#file").css("color", "green");
        $d2 = $('#image_students');
        $d = $('#image_preview');
        $d.css("display", "block");
        $d2.css("display", "none");
        $d.attr('src', e.target.result);
        $d.attr('width', '250px');

    }
    ;
</script>
<div class="modal fade" id="update_image" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="name_students"></h4>
            </div>
            <div class="modal-body">
                <img src="" id="image_students" class="img-responsive"
                     style="width: 50%;margin-left: auto;margin-right: auto;"/>
                <img src="" id="image_preview" class="img-responsive"
                     style="width: 50%;margin-left: auto;margin-right: auto; display: none"/>

                <form role="search" class="" id="UploadImage" method="post" enctype="multipart/form-data" action="">
                    <input type="hidden" name="id_image_update" id="id_image_update"/>

                    <div class="form-group" style=" margin-top: 13px;">
                        <div class="input-group">
                        <span class="btn btn-success-upload-file fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                               <span>Add files </span>
                            <input type="file" name="image_update" id="image_update"
                                   class="fileUpload"/>
                        </span>
                            <span class="input-group-addon">New Image</span>
                        </div>

                    </div>
                    <button type="submit" id="submit_btn_image" class="btn btn-default">Upload New Image</button>
                </form>
                <div id="message_res"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#add_new_slider').click(function () {
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
                text_n: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    $('#result_massages_save').html(data['massage']);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    location.reload();
                }
            }).fail(function () {
            });
        });
    });
</script>
<div class="modal fade" id="add" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New Slider
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post" action="<?= site_url('admin/add_new_slider') ?>">

                    <div class="form-group">
                        <label>Text : </label>
                        <textarea class="form-control" id="text_n" name="text_n"></textarea>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>update slider
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post" action="<?= site_url('admin/update_slider') ?>">

                    <div class="form-group">
                        <input type="hidden" name="id_update" id="id_update" value=""/>
                    </div>
                    <div class="form-group">
                        <label>text : </label>
                        <input type="text" class="form-control" id="text_update" name="text_update"/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                <div class="" id="result_massages_update"></div>
            </div>
        </div>
    </div>
</div>

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
                $.post('<?= site_url('admin/remove_slider_row')?>', {id: row.<?=$tpl_slider->id()?>}, function (data) {
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                });
            }
        },
        'click .update': function (e, value, row, index) {
            $('#update').modal('show');
            $('#id_update').val(row.<?=$tpl_slider->id()?>);
            $('#text_update').val(row.<?=$tpl_slider->text()?>);


        }
    };
    $(document).ready(function () {

        $('#update_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                id_update: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}},
                text_update: {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    $('#result_massages_save').html(data['massage']);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    location.reload();
                }
            }).fail(function () {
            });
        });

    });
</script>


<style type="text/css">
    .fileUpload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        font-size: 18px;
        width: 100%;
        opacity: 0;
        -ms-filter: 'alpha(opacity=0)';
        direction: ltr;
        cursor: pointer;
    }

    .btn-success-upload-file {
        color: #fff;
        background-color: #5cb85c;
        border-color: #4cae4c;
        border-radius: 3px 0px 0px 3px;
        width: 100%;
    }
</style>