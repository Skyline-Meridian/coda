<?php
include '../../header.php';
include '../../db_config.php';
if (!$_SESSION['id']) {
    header('location:../login.php');
}
$coda_tables = ['remarks', 'sequence_number'];
?>
<!-- Navbar -->
<?php include '../../navbar.php'; ?>
<div class="container-fluid page-body-wrapper">

     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!--<script src="tableExport/tableExport.js"></script>-->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/sorting/datetime-moment.js"></script>  -->

    <!-- sidebar offcampus  -->
    <?php include '../../sidebar-offcanvas.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- heading text starts -->
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4">
                        <h3 class="font-weight-bold">Transactions rapport</h3>
                        <h6 class="font-weight-normal mb-0">Selectionner les champs de vos recherches.</h6>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="justify-content-between d-flex">
                            <div class="field-group p-3 bg-white">
                                <div class="date-start mr-2 mb-2">
                                    <label for="date_start">Date début</label><br>
                                    <!-- <input type="date" class="form-control form-control-sm" id="date_start" name="date_start" value="<?php// echo date('Y-m-d', strtotime("-30 year", strtotime(date('Y-m-d')))); ?>"> -->
                                    <input type="date" class="form-control form-control-sm" id="date_start" name="date_start" value="<?php echo date('2000-01-01'); ?>">
                                </div>
                                <div class="date-end mr-2 mb-2">
                                    <label for="date_end">Date Fin</label><br>
                                    <input type="date" class="form-control form-control-sm" id="date_end" name="date_end" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="submit mt-4">
                                    <button type="submit" class="btn btn-info p-4" id="search_submit">Afficher le rapport</button>
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field1">And / Or / Not</label><br>
                                    <select id="operator_field1" class="form-control form-control-sm" name="operator_field1">
                                        <option class="dropdown-item" value="AND">AND</option>
                                        <option class="dropdown-item" value="OR">OR</option>
                                        <option class="dropdown-item" value="AND NOT">NOT</option>
                                    </select>
                                </div>
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field1">N° de compte</label><br>
                                    <select id="select_field1" class="form-control form-control-sm" name="select_field1">
                                        <option selected disabled hidden>Hide</option>
                                        <option class="dropdown-item" value="account_number">Show</option>
                                    </select>
                                </div>
                                <div class="operator-select mr-2 mb-2" id="compte">
                                    <label for="select_field_value1">N° de compte</label><br>
                                    <select id="select_field_value1" class="form-control form-control-sm" name="select_field_value1">
                                        <option selected disabled hidden>Sélectionnerr N° de compte</option>
                                        <option value="250007201731">BE04 2500 0720 1731</option>
                                        <option value="001202832029">BE26 0012 0283 2029</option>
                                        <option value="001709215273">BE27 0017 0921 5273</option>
                                        <option value="001318090964">BE29 0013 1809 0964</option>
                                        <option value="271021277081">BE36 2710 2127 7081</option>
                                        <option value="250013830063">BE40 2500 1383 0063</option>
                                        <option value="250009844171">BE49 2500 0984 4171</option>
                                        <option value="240039610053">BE53 2400 3961 0053</option>
                                        <option value="240036100370">BE60 2400 3610 0370</option>
                                        <option value="271039130034">BE68 2710 3913 0034</option>
                                        <option value="210003416169">BE71 2100 0341 6169</option>
                                        <option value="250013850069">BE71 2500 1385 0069</option>
                                        <option value="001769309605">BE96 0017 6930 9605</option>
                                        <option value="360051075657">BE09 3600 5107 5657</option>
                                        <option value="360051073637">BE35 3600 5107 3637</option>
                                        <option value="340184061376">BE91 3401 8406 1376</option>
                                    </select>
                                </div>
                                <!-- <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value1">Valeur</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value1" name="select_field_value1">
                                </div> -->
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field2">And / Or / Not</label><br>
                                    <select id="operator_field2" class="form-control form-control-sm" name="operator_field2">
                                        <option class="dropdown-item" value="AND">AND</option>
                                        <option class="dropdown-item" value="OR">OR</option>
                                        <option class="dropdown-item" value="AND NOT">NOT</option>
                                    </select>
                                </div>
                            
                                <div class="operator-select mr-2 mb-2">
                                    <label for="select_field21">Transaction</label><br>
                                    <select id="select_field21" class="form-control form-control-sm" name="select_field21">
                                        <option class="dropdown-item" value="="> = </option>
                                        <option class="dropdown-item" value="<"> < </option>
                                        <option class="dropdown-item" value=">"> > </option>
                                        <option class="dropdown-item" value=">="> >= </option>
                                        <option class="dropdown-item" value="<="> <= </option>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value2">Valeur</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value2" name="select_field_value2">
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field3">And / Or / Not</label><br>
                                    <select id="operator_field3" class="form-control form-control-sm" name="operator_field3">
                                        <option class="dropdown-item" value="AND">AND</option>
                                        <option class="dropdown-item" value="OR">OR</option>
                                        <option class="dropdown-item" value="AND NOT">NOT</option>
                                    </select>
                                </div>
                                <!-- <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field2">Transaction</label><br>
                                    <select id="operator_field2" class="form-control form-control-sm" name="operator_field2">
                                        <option class="dropdown-item" value="="> = </option>
                                        <option class="dropdown-item" value="<"> < </option>
                                        <option class="dropdown-item" value=">"> > </option>
                                        <option class="dropdown-item" value=">="> >= </option>
                                        <option class="dropdown-item" value="<="> <= </option>
                                    </select>
                                </div> -->
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field3">Champs</label><br>
                                    <select id="select_field3" class="form-control form-control-sm" name="select_field3">
                                        <option selected disabled hidden>Champs</option>
                                        <?php
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value3">Valeur</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value3" name="select_field_value3">
                                </div>
                            </div>
                            <div class="field-group p-3 bg-white">
                                <div class="operator-select mr-2 mb-2">
                                    <label for="operator_field4">And / Or / Not</label><br>
                                    <select id="operator_field4" class="form-control form-control-sm" name="operator_field4">
                                        <option class="dropdown-item" value="AND">AND</option>
                                        <option class="dropdown-item" value="OR">OR</option>
                                        <option class="dropdown-item" value="AND NOT">NOT</option>
                                    </select>
                                </div>
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field4">Champs</label><br>
                                    <select id="select_field4" class="form-control form-control-sm" name="select_field4">
                                        <option selected disabled hidden>Champs</option>
                                        <?php
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value4">Valeur</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value4" name="select_field_value4">
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- <div class="hidden-items">
                Basculer la colonne: <br>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox1" data-column="1"/><label for="checkbox1">Id</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox2" data-column="2" checked/><label for="checkbox2">Title</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox3" data-column="3" checked/><label for="checkbox3">Nom</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox4" data-column="4"/><label for="checkbox4">N° de compte</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox5" data-column="5" checked/><label for="checkbox5">Divers</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox6" data-column="6" /><label for="checkbox6">Email</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox7" data-column="7" /><label for="checkbox7">Tele</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox8" data-column="8" /><label for="checkbox8">Adresse</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox9" data-column="9" /><label for="checkbox9">CP</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox10" data-column="10" /><label for="checkbox10">Ville</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox11" data-column="11" checked/><label for="checkbox11">Communication</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox12" data-column="12" checked/><label for="checkbox12">Dernier Versement</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox13" data-column="13" checked/><label for="checkbox13">Dons</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox14" data-column="14" checked/><label for="checkbox14">Vers Cummulés</label>

            </div> -->
            <!-- Coda upload and basic data display -->
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="col-12 my-4">
                                <h3 class="font-weight-bold">Members List</h3>
                                <h6 class="font-weight-normal mb-0">Select the year from the dropdown to get complete report of all transactions done in that year.</h6>
                            </div> -->
                            <form id="form-report" action="" method="POST">
                                <div class="col-12 my-3">
                                    <div class="table-responsive">
                                        <table id="custom_report_table" class="display select expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th><input name="select_all" value="1" type="checkbox"></th> -->
                                                    <th width="10%">Tr Id</th>
                                                    <th width="10%">N° Coda</th>
                                                    <th width="20%">N° de compte</th>
                                                    <th width="20%">Nom</th>
                                                    <th width="10%">Date</th>
                                                    <th width="10%">Montant</th>
                                                    <th width="10%">Remarques</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div id="download_buttons" class="justify-content-between pt-4">
                                        
                                        <!-- <input type="submit" class="btn btn-info" id="mass_edit" value="Modification par lot"> -->
                                    
                                        <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                        <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                                        <!-- <button class="btn btn-warning float-right" id="save_query">Sauvegarder ce rapport</button> -->
                                        <!-- <a href="downloadxlsreports.php" class="btn btn-info">Download report as Excel</a> -->

                                    </div>
                                    <!-- <div id="dataform"></div> -->
                                </div>
                            </form>
                            <!-- <div class="hidden-items p-3">
                                <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                                <button class="btn btn-warning float-right" id="save_query">Sauvegarder ce rapport</button>
                            </div> -->
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Sauvegarder le rapport personnalisé</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="save_query_name mr-2 mb-2">
                                <label for="save_query_name">Entrez le nom du rapport</label><br>
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
        var table = '';
        var tableData = '';
        var rows_selected = [];
        $('#download_buttons').hide();
        $('#compte').hide();
        $('#select_field1').on('change', function(){
            $('#compte').show();
        });
        $("#search_submit").on('click', function() {

            var start_date = $('#date_start').val();
            var end_date = $('#date_end').val();

            var operator_field1 = $('#operator_field1').val();
            var field1 = $('#select_field1').val();
            var field_value1 = $('#select_field_value1').val();

            var operator_field2 = $('#operator_field2').val();
            var operator_field21 = $('#select_field21').val();
            var field_value2 = $('#select_field_value2').val();
            if (field_value2 != ''){
                var field2 = 'tr_amount';
            } else field2 = '';

            var operator_field3 = $('#operator_field3').val();
            var field3 = $('#select_field3').val();
            var field_value3 = $('#select_field_value3').val();

            var operator_field4 = $('#operator_field4').val();
            var field4 = $('#select_field4').val();
            var field_value4 = $('#select_field_value4').val();

            data = {
                    "start_date": start_date,
                    "end_date": end_date,
                    "operator_field1": operator_field1,
                    "field1": field1,
                    "field_value1": field_value1,
                    "operator_field2": operator_field2,
                    "operator_field21": operator_field21,
                    "field2": field2,
                    "field_value2": field_value2,
                    "operator_field3": operator_field3,
                    "field3": field3,
                    "field_value3": field_value3,
                    "operator_field4": operator_field4,
                    "field4": field4,
                    "field_value4": field_value4,
                }
            // console.log(data);
            $.ajax({
                type: 'post',
                data: data,
                url: '../../services/reports/tr_reports.php',
                dataType: 'json', // expecting json object in return
                // on success 
                success: function(data) {
                    $('#download_buttons').show();
                    console.log(data.query);
                    tableData = data;
                    if (tableData.members) {
                        showDataTable(tableData.members)
                    } else $('#custom_report_table').DataTable().clear().draw();
                },
            })
        })


                function showDataTable(tableData) {
                    table = $('#custom_report_table').dataTable({
                        destroy: true,
                        data: tableData,
                        columns: [
                            {
                                "data": "id",
                                // "visible": false
                            },
                            {
                                "data": "sequence_number"
                            },
                            {
                                "data": "account_number"
                            },
                            {
                                "data": "nom",
                                // "visible": false
                            },
                            {
                                "data": "tr_date",
                                render: function (data, type, row) {
                                    return moment(new Date(data).toString()).format('DD-MM-YYYY');
                                }
                            },
                            {
                                "data": "tr_amount"
                            },
                            {
                                "data": "remarks"
                            },
                            {
                            "mRender": function(data, type, row) {
                                return '<a class="view" href=../view_members.php?id=' + row.member_id + '><i class="ti-eye"></i> </a>';
                            }
                        }
                        ],
                    });
                }

                // save query on modal
                // $('#save_query').on('click', function(e) {
                //     e.preventDefault();
                //     $('#saveQueryModal').modal('show');
                //     $('#save-data-modal').on('click', function() {
                //         let query_name = $('#save_query_name').val();
                //         $.ajax({
                //             type: 'post',
                //             data: {
                //                 "query_name": query_name,
                //                 "query": tableData.query
                //             },
                //             url: '../../services/reports/save_query.php',
                //             dataType: 'json', // expecting json object in return
                //             // on success 
                //             success: function(data) {
                //                 console.log(data);
                //                 $('.save_query_name').html(data);
                //                 $('#save-data-modal').hide();
                //             }
                //         })
                //     })
                // })

                // download as excel function
                $("#download_xls").on('click', function(e) {
                    // console.log(tableData);
                    e.preventDefault();
                    $.ajax({
                        type: 'post',
                        data: tableData,
                        url: 'downloadxlsreports.php',
                        success: function(data) {
                            console.log(data);
                            var blob = new Blob([data], {
                                type: 'application/vnd.ms-excel'
                            });
                            var downloadUrl = URL.createObjectURL(blob);
                            var a = document.createElement("a");
                            a.href = downloadUrl;
                            a.download = "downloadFile.xls";
                            document.body.appendChild(a);
                            a.click();
                        }

                    })
                })

                // download as csv function
                $("#download_csv").on('click', function(e) {
                    // console.log(tableData);
                    e.preventDefault();
                    $.ajax({
                        type: 'post',
                        data: tableData,
                        url: 'downloadcsvreports.php',
                        success: function(data) {
                            console.log(data);
                            var blob = new Blob([data], {
                                type: "octet/stream"
                            });
                            var downloadUrl = URL.createObjectURL(blob);
                            var a = document.createElement("a");
                            a.href = downloadUrl;
                            a.download = "downloadFile.csv";
                            document.body.appendChild(a);
                            a.click();
                        }

                    })
                })
    })
</script>