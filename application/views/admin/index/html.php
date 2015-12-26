<?PHP
$use = new class_loader();
$use->use_lib('admin/home_lib_ad');
$lib = new home_lib_ad();
?>
<div class="col-sm-12 main">
    <h2 class="page-header">Welcome to dashboard</h2>

    <div class="row">
        <div class="row placeholders">
            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total category <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_category() ?></div>
            </div>
            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total college <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_college() ?></div>
            </div>


            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total degree <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_degree() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total companies <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_companies() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total department <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_department() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total models <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_models() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total onus <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_onus() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total section <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_section() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total specialty <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_specialty() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total students <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_students() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total supervisor <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_supervisor() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total university <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_university() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total onus designate <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_onus_designate() ?></div>
            </div>

            <div class="col-sm-3 block_counter">
                <div class="row row_block_counter">
                    <h3>Total degree <br>
                        <small>( Achieved )</small>
                    </h3>
                </div>
                <div class="row"><?= $lib->count_degree() ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <h3 class="page-header">Category</h3>
                <div class="table-responsive">
                    <table id="tpl_category" data-toggle="table"
                           data-url="<?= site_url('admin/home/ajax_category') ?>"
                           data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                           data-search="true" data-flat="true">
                        <thead>
                        <tr>
                            <th data-field="<?= tpl_category::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                            <th data-field="<?= tpl_category::name() ?>" data-halign="center" data-sortable="true"> Name
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-sm-4">
                <h3 class="page-header">college</h3>
                <div class="table-responsive">
                    <table id="tpl_college" data-toggle="table"
                           data-url="<?= site_url('admin/home/ajax_college') ?>"
                           data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                           data-search="true" data-flat="true">
                        <thead>
                        <tr>
                            <th data-field="<?= tpl_college::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                            <th data-field="<?= tpl_college::name() ?>" data-halign="center" data-sortable="true"> Name
                            <th data-field="<?=  tpl_university::university().'_'.tpl_university::name() ?>"
                                data-halign="center" data-sortable="true"> university
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="col-sm-4">
                <h3 class="page-header">Companies</h3>
                <div class="table-responsive">
                    <table id="tpl_college" data-toggle="table"
                           data-url="<?= site_url('admin/home/ajax_companies') ?>"
                           data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                           data-search="true" data-flat="true">
                        <thead>
                        <tr>
                            <th data-field="<?=tpl_companies::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                            <th data-field="<?= tpl_companies::name() ?>" data-halign="center" data-sortable="true"> Name
                            <th data-field="<?=tpl_category::category().'_'.tpl_university::name() ?>"
                                data-halign="center" data-sortable="true"> Category
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

       <div class="row">
           <div class="col-sm-4">
               <h3 class="page-header">Degree</h3>
               <div class="table-responsive">
                   <table id="tpl_college" data-toggle="table"
                          data-url="<?= site_url('admin/home/ajax_degree') ?>"
                          data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                          data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                          data-search="true" data-flat="true">
                       <thead>
                       <tr>
                           <th data-field="<?=tpl_degree::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                           <th data-field="<?=tpl_degree::name() ?>" data-halign="center" data-sortable="true"> Name
                           <th data-field="<?=tpl_degree::star_number()?>" data-halign="center" data-sortable="true"># star </th>
                       </tr>
                       </thead>
                   </table>
               </div>
           </div>

           <div class="col-sm-4">
               <h3 class="page-header">Department</h3>
               <div class="table-responsive">
                   <table id="tpl_ajax_department" data-toggle="table"
                          data-url="<?= site_url('admin/home/ajax_department') ?>"
                          data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                          data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                          data-search="true" data-flat="true">
                       <thead>
                       <tr>
                           <th data-field="<?=tpl_department::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                           <th data-field="<?=tpl_department::name() ?>" data-halign="center" data-sortable="true"> Name
                           <th data-field="<?= tpl_companies::companies().'_'.tpl_companies::name()?>" data-halign="center" data-sortable="true"> companies Name </th>
                       </tr>
                       </thead>
                   </table>
               </div>
           </div>

           <div class="col-sm-4">
               <h3 class="page-header">Onus</h3>
               <div class="table-responsive">
                   <table id="tpl_ajax_department" data-toggle="table"
                          data-url="<?= site_url('admin/home/ajax_onus') ?>"
                          data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                          data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                          data-search="true" data-flat="true">
                       <thead>
                       <tr>
                           <th data-field="<?=tpl_onus::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                           <th data-field="<?=tpl_onus::name() ?>" data-halign="center" data-sortable="true"> Name
                           <th data-field="<?= tpl_onus::description()?>" data-halign="center" data-sortable="true"> Description </th>
                       </tr>
                       </thead>
                   </table>
               </div>
           </div>
       </div>
           <div class="col-sm-12">
               <h3 class="page-header">onus designate</h3>
               <div class="table-responsive">
                   <table id="tpl_ajax_department" data-toggle="table"
                          data-url="<?= site_url('admin/home/ajax_onus_designate') ?>"
                          data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                          data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                          data-search="true" data-flat="true">
                       <thead>
                       <tr>
                           <th data-field="<?=tpl_students::students().'_'.tpl_students::first_name() ?>" data-halign="center" data-sortable="true">Student</th>
                           <th data-field="<?=tpl_supervisor::supervisor().'_'.tpl_supervisor::name() ?>" data-halign="center" data-sortable="true">supervisor</th>
                           <th data-field="<?=   tpl_companies::companies().'_'.tpl_companies::name()?>" data-halign="center" data-sortable="true"> companies </th>
                           <th data-field="<?=  tpl_department::department().'_'.tpl_department::name()?>" data-halign="center" data-sortable="true"> department </th>
                           <th data-field="<?=  tpl_section::section().'_'.tpl_section::name()?>" data-halign="center" data-sortable="true"> Section </th>
                           <th data-field="<?=  tpl_degree::degree().'_'.tpl_degree::name()?>" data-halign="center" data-sortable="true"> Degree</th>

                       </tr>
                       </thead>
                   </table>
               </div>
           </div>


        <div class="col-sm-12">
            <h3 class="page-header">Models</h3>
            <div class="table-responsive">
                <table id="tpl_ajax_department" data-toggle="table"
                       data-url="<?= site_url('admin/home/ajax_models') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true">
                    <thead>
                    <tr>
                        <th data-field="<?=tpl_department::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                        <th data-field="<?=tpl_students::students().'_'.tpl_students::first_name() ?>" data-halign="center" data-sortable="true"> Student Name
                        <th data-field="<?=tpl_companies::companies().'_'.tpl_companies::name() ?>" data-halign="center" data-sortable="true"> companies Name
                        <th data-field="<?=tpl_department::department().'_'.tpl_department::name() ?>" data-halign="center" data-sortable="true">department  Name
                        <th data-field="<?= tpl_section::section().'_'.tpl_section::name()?>" data-halign="center" data-sortable="true">section  Name
                        <th data-field="<?= tpl_supervisor::supervisor().'_'.tpl_supervisor::name()?>" data-halign="center" data-sortable="true">supervisor  Name

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<style>
    .block_counter {
        border: 1px solid rgba(132, 232, 232, 0.29);
        padding: 20px;
        padding-top: 0px;
    }

    .row_block_counter > h3 {
        border-bottom: 1px solid rgba(132, 232, 232, 0.33);
        padding-bottom: 10px;
    }
</style>