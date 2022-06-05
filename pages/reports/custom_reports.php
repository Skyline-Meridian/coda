<?php
include '../../header.php';
include '../../db_config.php';
if (!$_SESSION['id']) {
    header('location:../login.php');
}
?>
<!-- Navbar -->
<?php include '../../navbar.php'; ?>
<div class="container-fluid page-body-wrapper">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="tableExport/tableExport.js"></script>
    <script type="text/javascript" src="tableExport/jquery.base64.js"></script> -->

    <!-- sidebar offcampus  -->
    <?php include '../../sidebar-offcanvas.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- heading text starts -->
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4">
                        <h3 class="font-weight-bold">Rapport personnalisé</h3>
                        <h6 class="font-weight-normal mb-0">Selectionner les champs de vos recherches.</h6>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="justify-content-between d-flex">
                            <div class="field-group p-3 bg-white">
                                <div class="date-start mr-2 mb-2">
                                    <label for="date_start">Date début</label><br>
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
                                    <label for="select_field1">Champs</label><br>
                                    <select id="select_field1" class="form-control form-control-sm" name="select_field1">
                                        <option selected disabled hidden>Champs</option>
                                        <?php
                                        $coda_tables = ['Remarks', 'Communication', 'Intitule', 'AccNo', 'Addresse', 'CP', 'Localite', 'Titre', 'Email', 'Tele'];
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="field-select-value mr-2 mb-2">
                                    <label for="select_field_value1">Valeur</label><br>
                                    <input type="text" class="form-control form-control-sm" id="select_field_value1" name="select_field_value1">
                                </div>
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
                                <div class="field-select mr-2 mb-2">
                                    <label for="select_field2">Champs</label><br>
                                    <select id="select_field2" class="form-control form-control-sm" name="select_field2">
                                        <option selected disabled hidden>Champs</option>
                                        <?php
                                        foreach ($coda_tables as $table) {
                                            echo '<option class="dropdown-item" value="' . $table . '">' . $table . '</option>';
                                        }
                                        ?>
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
    <button class="btn btn-primary btn-primary-sm" id="hidden_checkboxes_btn">Colonnes</button>
            
            <div class="hidden-items" id="hidden_checkboxes">
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
                            <form id="form-report" action="" method="POST">
                                <div class="col-12 my-3">
                                    <div class="table-responsive">
                                        <table id="custom_report_table" class="display select expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><input name="select_all" value="1" type="checkbox"></th>
                                                    <th width="10%">Id</th>
                                                    <th width="10%">Titre</th>
                                                    <th width="20%">Nom</th>
                                                    <th width="20%">N° de compte</th>
                                                    <th width="20%">Divers</th>
                                                    <th width="20%">Email</th>
                                                    <th width="20%">Tele</th>
                                                    <th width="20%">Adresse</th>
                                                    <th width="10%">CP</th>
                                                    <th width="10%">Ville</th>
                                                    <th width="10%">Communication</th>
                                                    <th width="10%">Dernier Versement</th>
                                                    <th width="10%">Dons</th>
                                                    <th width="10%">Vers Cummulés</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div id="download_buttons" class="justify-content-between pt-4">
                                        
                                        <input type="submit" class="btn btn-info" id="mass_edit" value="Modification par lot">
                                    
<!--                                         <button class="btn btn-info" id="download_csv">Download report as CSV</button>
                                        <button class="btn btn-info" id="download_xls">Download report as XLS</button>
                                        <button class="btn btn-info" id="save_query">Save Search Report</button> -->
                                        <!-- <a href="downloadxlsreports.php" class="btn btn-info">Download report as Excel</a> -->

                                    </div>
                                    <!-- <div id="dataform"></div> -->
                                </div>
                            </form>
                            <div class="hidden-items p-3">
                                <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                                <button class="btn btn-warning float-right" id="save_query">Sauvegarder ce rapport</button>
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

            <!-- Save Query Modal -->
            <div class="modal fade" id="massEditModal" tabindex="-1" role="dialog" aria-labelledby="massEditModal1" aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ajouter globalement pour les membres sélectionnés</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="new_communication mr-2 mb-2">
                                <label for="new_communication">Ajouter votre communication</label><br>
                                <input type="text" class="form-control form-control-sm" id="new_communication" name="new_communication">
                            </div>
                            <div id="update_comm"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" id="update-mass-modal">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>

<?php include '../../footer.php'; ?>
<script>
    jQuery(document).ready(function($) {

        $('#hidden_checkboxes').hide();
        $('#hidden_checkboxes_btn').on('click', ()=>{
            $('#hidden_checkboxes').toggle();
        })
        var table = '';
        var tableData = '';
        var rows_selected = [];
        $('#download_buttons').hide();
        $('.hidden-items').hide();
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
                dataType: 'json', // expecting json object in return
                // on success 
                success: function(data) {
                    $('#download_buttons').show();
                    // console.log(data);
                    tableData = data;
                    if (tableData.members) {
                        showDataTable(tableData.members)
                    } else $('#custom_report_table').DataTable().clear().draw();
                },
            })
        })


                function showDataTable(tableData) {
                    table = $('#custom_report_table').DataTable({
                        destroy: true,
                        data: tableData,
                        lengthMenu: [
                            [10, 25, 50, 100, 500, -1],
                            [10, 25, 50, 100, 500, "All"]
                        ],
                        columnDefs: [{
                            'targets': 0,
                            'searchable': false,
                            'orderable': false,
                            'width': '1%',
                            'checkboxes': {
                                'selectRow': true
                            },
                            'className': 'dt-body-center',
                        }],

                        select: {
                            'style': 'multi'
                        },
                        columns: [{
                                "orderable": false,
                                // "data": null,
                                // "defaultContent": ''
                            },
                            {
                                "data": "id",
                                "visible": false
                            },
                            {
                                "data": "titre"
                            },
                            {
                                "data": "intitule"
                            },
                            {
                                "data": "accno",
                                "visible": false
                            },
                            {
                                "data": "diver"
                            },
                            {
                                "data": "email",
                                "visible": false
                            },
                            {
                                "data": "tele",
                                "visible": false
                            },
                            {
                                "data": "addresse",
                                "visible": false
                            },
                            {
                                "data": "cp",
                                "visible": false
                            },
                            {
                                "data": "localite",
                                "visible": false
                            },
                            {
                                "data": "communication"
                            },
                            {
                                "data": "dervst",
                                render: function (data, type, row) {
                                    if(data == '0000-00-00'){
                                        return "-- -- ----"
                                    } else {
                                        return moment(new Date(data).toString()).format('DD-MM-YYYY');
                                    }
                                }
                            },
                            {
                                "data": "amount"
                            },
                            {
                                "data": "cumulvst"
                            },
                            {
                            "mRender": function(data, type, row) {
                                return '<a class="view" href=../view_members.php?id=' + row.id + '><i class="ti-eye"></i> </a><a class="edit" href=../add_members.php?id=' + row.id + '><i class="ti-pencil-alt"></i></a><a class="del" href=../../services/delete.php?id=' + row.id + '><i class="ti-trash"></i></a>';
                            }
                        }
                        ],
                    });
                    $('.hidden-items').show();
                }

                // Hide selected columns
                $('.toggle-vis').on('change', function(e) {
                    e.preventDefault();

                    // Get the column API object
                    var column = table.column($(this).attr('data-column'));

                    // Toggle the visibility
                    column.visible(!column.visible());
                });

                // Handle form submission event 
                $('#form-report').on('submit', function(e) {
                    var form = this;

                    var rows_selected = table.column(0).checkboxes.selected();

                    // Iterate over all selected checkboxes
                    $.each(rows_selected, function(index, rowId) {
                        // Create a hidden element 
                        $(form).append(
                            $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'id[]')
                            .val(rowId)
                        );
                    });

                    var ids = [];
                    // Get ids from selected checkbox   
                    // $('#dataform').text($(form).serialize());
                    data = $(form).serialize().split("&");
                    data.shift()
                    $.each(data, function(index, value) {
                        arr = value.split("=");
                        arr.shift();
                        ids.push(arr.toString());
                    })
                    // console.log(ids);
                    $('#massEditModal').modal('show');
                    $('#update-mass-modal').on('click', function() {
                        let newCom = $('#new_communication').val();
                        $.ajax({
                            type: 'post',
                            data: {
                                ids: ids,
                                newCom: newCom
                            },
                            url: '../../services/reports/mass_update.php',
                            // dataType: 'json', // expecting json object in return
                            // on success 
                            success: function(data) {
                                // $('#update_comm').html(data);
                                alert(data);
                                // Clear the input and close the modal
                                $('#new_communication').val('');
                                $('#massEditModal').modal('hide');
                                // $('#custom_report_table').DataTable().clear().draw();
                            },
                        })
                    });

                    // Remove added elements
                    $('input[name="id\[\]"]', form).remove();

                    // Prevent actual form submission
                    e.preventDefault();
                });

                
                // download as excel function
                $("#download_xls").on('click', function() {
                    console.log(tableData);
                    $.ajax({
                        type: 'post',
                        data: tableData,
                        url: '../../services/reports/downloadxlsreports.php',
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
                $("#download_csv").on('click', function() {
                    console.log(tableData);
                    $.ajax({
                        type: 'post',
                        data: tableData,
                        url: '../../services/reports/downloadcsvreports.php',
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

                // save query on modal
                $('#save_query').on('click', function() {
                    $('#saveQueryModal').modal('show');
                    $('#save-data-modal').on('click', function() {
                        let query_name = $('#save_query_name').val();
                        $.ajax({
                            type: 'post',
                            data: {
                                "query_name": query_name,
                                "query": tableData.query
                            },
                            url: '../../services/reports/save_query.php',
                            dataType: 'json', // expecting json object in return
                            // on success 
                            success: function(data) {
                                console.log(data);
                                $('.save_query_name').html(data);
                                $('#save-data-modal').hide();
                            }
                        })

                    })
                })
    })
</script>