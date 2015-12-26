<?PHP
$use = new class_loader();
$use->use_lib('admin/college_lib_ad');
$lib = new college_lib_ad();
$data = $lib->find($_GET['id']);
if($data == false){redirect('admin/college');}
$data = array_shift($data);
?>
<div class="col-sm-12 main">
    <div class="row page-header">
        <div class="col-sm-2"><h5><b><a href="<?=site_url('admin/college')?>">College : </a> </b> </h5></div>
        <div class="col-sm-2"><h5> <?=$data[tpl_college::name()]?> </h5></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h3 class="page-header">Number Students</h3>
            <div class="table-responsive">
                <table id="table_srudent" data-toggle="table"
                       data-url="<?= site_url('admin/college/ajax_students') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_college::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_college::name() ?>"
                            data-formatter="operate<?= tpl_college::college()?>"
                            data-halign="center" data-sortable="true"> name
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
            <h3 class="page-header">Students</h3>
            <div class="table-responsive">
                <table id="table_srudent" data-toggle="table"
                       data-url="<?= site_url('admin/college/ajax_find_students/?id='.$_GET['id']) ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_college::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_students::first_name() ?>" data-halign="center" data-sortable="true">
                            first_name
                        </th>
                        <th data-field="<?=  tpl_students::last_name() ?>" data-halign="center" data-sortable="true">
                            last_name
                        </th>
                        <th data-field="<?=   tpl_college::college().'_'.tpl_college::name() ?>"
                            data-halign="center" data-sortable="true">
                            college
                        </th>
                        <th data-field="<?= tpl_specialty::specialty().'_'.tpl_specialty::name() ?>"
                            data-halign="center" data-sortable="true">
                            specialty
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

        return '<a href="<?=site_url('admin/college/view_student/?id=')?>'+row.<?=tpl_college::id() ?>+'">'+value+'</a>'
    }

</script>
