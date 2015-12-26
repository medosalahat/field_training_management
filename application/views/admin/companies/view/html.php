<?PHP
$use = new class_loader();
$use->use_lib('admin/companies_lib_ad');
$lib = new companies_lib_ad();
$data = $lib->find($_GET['id']);
if ($data == false) {
    redirect('admin/companies');
}
$data = array_shift($data);
?>
<div class="col-sm-12 main">
    <div class="row page-header">
        <div class="col-sm-2"><h5><b><a href="<?= site_url('admin/companies') ?>">Companies : </a> </b></h5></div>
        <div class="col-sm-2"><h5> <?= $data[tpl_companies::name()] ?> </h5></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <h3 class="page-header">Number Students</h3>

                <div class="table-responsive">
                    <table id="table_srudent" data-toggle="table"
                           data-url="<?= site_url('admin/companies/ajax_models') ?>"
                           data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                           data-search="true" data-flat="true" data-toolbar="#toolbar">
                        <thead>
                        <tr>
                            <th data-field="<?= tpl_companies::id() ?>" data-halign="center" data-sortable="true"> id
                            </th>
                            <th data-field="<?= tpl_companies::name() ?>"
                                data-formatter="operate<?= tpl_companies::companies()?>"
                                data-halign="center" data-sortable="true"> name
                            </th>
                            <th data-field="<?= tpl_models::models() . '_' . tpl_models::id() ?>"
                                data-halign="center"
                                data-sortable="true"># students
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <h3 class="page-header">Students</h3>

            <div class="table-responsive">
                <table id="table_srudent" data-toggle="table"
                       data-url="<?= site_url('admin/companies/ajax_find_students/?id=' . $_GET['id']) ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_companies::id() ?>" data-halign="center" data-sortable="true"> id</th>
                        <th data-field="<?= tpl_students::students() . '_' . tpl_students::first_name() ?>"
                            data-halign="center" data-sortable="true">
                            first name
                        </th>
                        <th data-field="<?= tpl_students::students() . '_' . tpl_students::last_name() ?>"
                            data-halign="center" data-sortable="true">
                            last name
                        </th>


                        <th data-field="<?= tpl_supervisor::supervisor() . '_' . tpl_supervisor::name() ?>"
                            data-halign="center" data-sortable="true">
                            supervisor
                        </th>

                        <th data-field="<?= tpl_university::university() . '_' . tpl_university::name() ?>"
                            data-halign="center" data-sortable="true">
                            university
                        </th>

                        <th data-field="<?= tpl_college::college() . '_' . tpl_college::name() ?>"
                            data-halign="center" data-sortable="true">
                            college
                        </th>

                        <th data-field="<?= tpl_specialty::specialty() . '_' . tpl_specialty::name() ?>"
                            data-halign="center" data-sortable="true">
                            specialty
                        </th>
                        <th data-field="<?= tpl_department::department() . '_' . tpl_department::name() ?>"
                            data-halign="center" data-sortable="true">
                            department
                        </th>
                        <th data-field="<?= tpl_section::section() . '_' . tpl_section::name() ?>"
                            data-halign="center" data-sortable="true">
                            section
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

        return '<a href="<?=site_url('admin/companies/view/?id=')?>' + row.<?=tpl_college::id() ?> + '">' + value + '</a>'
    }

</script>
