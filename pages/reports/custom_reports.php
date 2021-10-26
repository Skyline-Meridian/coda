<?php
include '../../header.php';
include '../../db_config.php';
?>
<!-- Navbar -->
<?php include '../../navbar.php'; ?>
<div class="container-fluid page-body-wrapper">

    <!-- sidebar offcampus  -->
    <?php include '../../sidebar-offcanvas.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- heading text starts -->
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4">
                        <h3 class="font-weight-bold">Custom Reports</h3>
                        <h6 class="font-weight-normal mb-0">Select the fields you want to search for.</h6>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="justify-content-between d-flex">
                            <div class="field-group p-3 bg-white">
                                <div class="date-start mr-2 mb-2">
                                    <label for="date_start">Start Date</label><br>
                                    <input type="date" class="form-control form-control-sm" id="date_start" name="date_start" value="<?php echo date('Y-m-d', strtotime("-100 year", strtotime(date('Y-m-d')))); ?>">
                                </div>
                                <div class="date-end mr-2 mb-2">
                                    <label for="date_end">End Date</label><br>
                                    <input type="date" class="form-control form-control-sm" id="date_end" name="date_end" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="submit mt-4">
                                    <button type="submit" class="btn btn-info p-4" id="search_submit">Show Reports</button>
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field1">And / Or</label><br>
                                    <select id="operator_field1" class="form-control form-control-sm" name="operator_field1">
                                        <option class="dropdown-item" value="AND" >AND</option>
                                        <option class="dropdown-item" value="OR" >OR</option>
                                    </select>   
                                </div>
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field1">Select Field</label><br>
                                    <select id="select_field1" class="form-control form-control-sm" name="select_field1">
                                        <option selected disabled hidden>Select Field</option>
                                        <?php
                                        $coda_tables = ['Remarks', 'Communication', 'Rubans', 'Newsletter'];
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value1">Field Value</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value1" name="select_field_value1">
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field2">And / Or</label><br>
                                    <select id="operator_field2" class="form-control form-control-sm" name="operator_field2">
                                        <option class="dropdown-item" value="AND" >AND</option>
                                        <option class="dropdown-item" value="OR" >OR</option>
                                    </select>   
                                </div>
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field2">Select Field</label><br>
                                    <select id="select_field2" class="form-control form-control-sm" name="select_field2">
                                        <option selected disabled hidden>Select Field</option>
                                        <?php
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value2">Field Value</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value2" name="select_field_value2">
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field3">And / Or</label><br>
                                    <select id="operator_field3" class="form-control form-control-sm" name="operator_field3">
                                        <option class="dropdown-item" value="AND" >AND</option>
                                        <option class="dropdown-item" value="OR" >OR</option>
                                    </select>   
                                </div>
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field3">Select Field</label><br>
                                    <select id="select_field3" class="form-control form-control-sm" name="select_field3">
                                        <option selected disabled hidden>Select Field</option>
                                        <?php
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value3">Field Value</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value3" name="select_field_value3">
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field4">And / Or</label><br>
                                    <select id="operator_field4" class="form-control form-control-sm" name="operator_field4">
                                        <option class="dropdown-item" value="AND" >AND</option>
                                        <option class="dropdown-item" value="OR" >OR</option>
                                    </select>   
                                </div>
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field4">Select Field</label><br>
                                    <select id="select_field4" class="form-control form-control-sm" name="select_field4">
                                        <option selected disabled hidden>Select Field</option>
                                        <?php
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value4">Field Value</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value4" name="select_field_value4">
                                </div>
                                
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- Coda upload and basic data display -->
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="col-12 my-4">
                                <h3 class="font-weight-bold">Members List</h3>
                                <h6 class="font-weight-normal mb-0">Select the year from the dropdown to get complete report of all transactions done in that year.</h6>
                            </div> -->
                            <div class="col-12 my-3">
                                <div class="table-responsive">
                                    <table id="custom_report_table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">Title</th>
                                                <th width="20%">Intitule</th>
                                                <th width="20%">Addresse</th>
                                                <th width="10%">CP</th>
                                                <th width="10%">Localite</th>
                                                <th width="10%">Divers</th>
                                                <th width="10%">Dons</th>
                                                <th width="10%">Cumulvst</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div id="download_buttons" class="justify-content-between pt-4">
                                        <a href="../../services/reports/downloadxlsreports.php" class="btn btn-info">Download report as CSV</a>
                                        <button class="btn btn-info" id="download_xls">Download report as XLS</button>
                                        <button class="btn btn-info" id="save_query">Save Search Report</button>
                                        <!-- <a href="downloadxlsreports.php" class="btn btn-info">Download report as Excel</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

            <!-- Save Query Modal -->
            <div class="modal fade" id="saveQueryModal" tabindex="-1" role="dialog" aria-labelledby="saveQueryModal1" aria-hidden="true">
            <div class="modal-dialog modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Save Custom Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="save_query_name mr-2 mb-2" >
                        <label for="save_query_name">Give name to your search</label><br>
                        <input type="text" class="form-control form-control-sm" id="save_query_name" name="save_query_name">
                    </div>
                    <div id="report"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-data-modal">Save changes</button>
                </div>
                </div>
            </div>
            </div>

            <?php include '../../footer.php'; ?>
            <script>

                jQuery(document).ready(function($) {
                    var tableData = '';
                    $('#download_buttons').hide();
                    $("#search_submit").on('click', function() {

                        var start_date = $('#date_start').val();
                        var end_date = $('#date_end').val();

                        var operator_field1 = $('#operator_field1').val();
                        var field1 = $('#select_field1').val();
                        var field_value1 = $('#select_field_value1').val();

                        var operator_field2 = $('#operator_field2').val();
                        var field2 = $('#select_field2').val();
                        var field_value2 = $('#select_field_value2').val();

                        var operator_field3 = $('#operator_field3').val();
                        var field3 = $('#select_field3').val();
                        var field_value3 = $('#select_field_value3').val();

                        var operator_field4 = $('#operator_field4').val();
                        var field4 = $('#select_field4').val();
                        var field_value4 = $('#select_field_value4').val();

                        $.ajax({
                            type: 'post',
                            data: {
                                "start_date": start_date,
                                "end_date": end_date,
                                "operator_field1": operator_field1,
                                "field1": field1,
                                "field_value1": field_value1,
                                "operator_field2": operator_field2,
                                "field2": field2,
                                "field_value2": field_value2,
                                "operator_field3": operator_field3,
                                "field3": field3,
                                "field_value3": field_value3,
                                "operator_field4": operator_field4,
                                "field4": field4,
                                "field_value4": field_value4,
                            },
                            url: '../../services/reports/custom_reports.php',
                            dataType: 'json',   // expecting json object in return
                            // on success 
                            success: function (data) {
                                $('#download_buttons').show();
                                console.log(data);
                                tableData = data;
                                showDataTable(tableData.members)
                            }
                        })
                        
                        function showDataTable(tableData){
                            $('#custom_report_table').DataTable({
                                destroy: true,
                                data: tableData,
                                columns: [{
                                        "data": "titre"
                                    },
                                    {
                                        "data": "intitule"
                                    },
                                    {
                                        "data": "addresse"
                                    },
                                    {
                                        "data": "cp"
                                    },
                                    {
                                        "data": "localite"
                                    },
                                    {
                                        "data": "diver"
                                    },
                                    {
                                        "data": "amount"
                                    },
                                    {
                                        "data": "cumulvst"
                                    },
                                ],
                            });
                        }
                        
                    })

                    // download as excel function
                    $("#download_xls").on('click', function(){
                        console.log(tableData);
                        $.ajax({
                            type: 'post',
                            data: tableData,
                            url: '../../services/reports/downloadxlsreports.php',
                            success: function (data) {
                                console.log(data);
                                // window.open('../../services/reports/downloadxlsreports.php')
                                //document.location.href =(data.url);
                            }
                        })
                    })

                    // save query on modal
                    $('#save_query').on('click', function(){
                        $('#saveQueryModal').modal('show');
                        $('#save-data-modal').on('click', function(){
                            let query_name = $('#save_query_name').val();
                            $.ajax({
                                type: 'post',
                                data: {
                                    "query_name": query_name,
                                    "query": tableData.query
                                },
                                url: '../../services/reports/save_query.php',
                                dataType: 'json',   // expecting json object in return
                                // on success 
                                success: function (data) {
                                    console.log(data);
                                    $('.save_query_name').html(data);
                                    $('#save-data-modal').hide();
                                }
                            })

                        })
                    })
                })
            </script>