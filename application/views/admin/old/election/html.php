<link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
<link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
<script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="<?= site_url('admin') ?>">Home</a></li>
        <li class="active"><a href="<?= site_url('admin/election') ?>">Election</a></li>
        <li><a href="<?= site_url('admin/college') ?>">College</a></li>
        <li><a href="<?= site_url('admin/specialty') ?>">Specialty</a></li>
        <li><a href="<?= site_url('admin/students') ?>">Students</a></li>
        <li><a href="<?= site_url('admin/slider') ?>">Slider</a></li>
        <li><a href="<?= site_url('admin/users') ?>">Users</a></li>
    </ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('table/tpl_students');
    $use->use_lib('table/tpl_election');
    $tpl_students = new tpl_students();
    $tpl_election = new tpl_election();
    ?>
    <h2 class="sub-header">Election table</h2>

    <div class="table-responsive">
        <table id="table" data-toggle="table" data-url="<?= site_url('admin/find_election_table_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true">
            <thead>
            <tr>
                <th data-field="<?= $tpl_election->id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= $tpl_students->first_name() ?>" data-halign="center" data-sortable="true"> First
                    Name
                </th>
                <th data-field="<?= $tpl_students->last_name() ?>" data-halign="center" data-sortable="true"> Last
                    Name
                </th>
                <th data-field="<?= $tpl_students->first_name() . '_' . $tpl_students->elect() ?>" data-halign="center"
                    data-sortable="true"> First Name Elect
                </th>
                <th data-field="<?= $tpl_students->last_name() . '_' . $tpl_students->elect() ?>" data-halign="center"
                    data-sortable="true"> Last Name Elect
                </th>
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
    .glyphicon-remove {
        position: inherit;
        right: 25px;
        top: 8px;
        color: #B94A48;
    }
</style>
<script type="text/javascript">
    function operateFormatter(value, row, index) {
        return [
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove"></i>',
            '</a>'

        ].join('');
    }
    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
            if (confirm("Did you actually want to delete the Election!")) {
                $.post('<?= site_url('admin/remove_election_row')?>', {id: row.<?=$tpl_election->id()?>}, function (data) {
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                });
            }
        }
    };
</script>