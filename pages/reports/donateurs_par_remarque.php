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

    <!-- sidebar offcampus  -->
    <?php include '../../sidebar-offcanvas.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- heading text starts -->
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4">
                        <h3 class="font-weight-bold">Donateurs par remarque</h3>
                        <h6 class="font-weight-normal mb-0">liste des dotnateurs avec remarques.</h6>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-primary-sm" id="hidden_checkboxes_btn">Colonnes</button>

            <div class="hidden-items" id="hidden_checkboxes">
                Basculer la colonne: <br>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox1" data-column="0" /><label for="checkbox1">Id</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox2" data-column="1" /><label for="checkbox2">Titre</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox3" data-column="2" checked /><label for="checkbox3">Nom</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox4" data-column="3" /><label for="checkbox4">N° de compte</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox5" data-column="4" /><label for="checkbox5">Divers</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox6" data-column="5" /><label for="checkbox6">Addresse</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox7" data-column="6" /><label for="checkbox7">CP</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox8" data-column="7" /><label for="checkbox8">Localite</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox9" data-column="8" checked /><label for="checkbox9">Email</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox10" data-column="9" /><label for="checkbox10">Tele</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox11" data-column="10" checked /><label for="checkbox11">Communication</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox12" data-column="11" checked /><label for="checkbox12">Coda No</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox13" data-column="12" /><label for="checkbox13">Compte Beneficiary</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox14" data-column="13" checked /><label for="checkbox14">Date</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox15" data-column="14" checked /><label for="checkbox15">Montant</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox16" data-column="15" checked /><label for="checkbox16">Remarques</label>
            </div>
            <!-- Start of Row -->
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
                                    <table id="donors_table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">Id</th>
                                                <th width="10%">Titre</th>
                                                <th width="20%">Nom</th>
                                                <th width="20%">Acc No</th>
                                                <th width="10%">Diver</th>
                                                <th width="10%">Addresse</th>
                                                <th width="10%">CP</th>
                                                <th width="10%">Localite</th>
                                                <th width="10%">Email</th>
                                                <th width="10%">Tele</th>
                                                <th width="20%">Communication</th>
                                                <th width="10%">Coda No</th>
                                                <th width="20%">Beneficiary Acc</th>
                                                <th width="20%">Tr Date</th>
                                                <th width="10%">Montant</th>
                                                <th width="20%">Remarques</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden-items p-3">
                                <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

            <?php include '../../footer.php'; ?>
            <script>
                jQuery(document).ready(function($) {
                    $('#hidden_checkboxes').hide();
                    $('#hidden_checkboxes_btn').on('click', () => {
                        $('#hidden_checkboxes').toggle();
                    })
                    var table = $('#donors_table').DataTable({
                        destroy: true,
                        language: {
                            "sProcessing": "Chargement...",
                            "sLengthMenu": "Afficher _MENU_ entrées",
                            "sZeroRecords": "Rien n'a été trouvé",
                            "sEmptyTable": "Rien n'a été trouvé",
                            "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                            "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                            "sInfoFiltered": "(filtré à partir de _MAX_ entrées)",
                            "sInfoPostFix": "",
                            "sSearch": "Recherche:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Chargement...",
                            "oPaginate": {
                                "sFirst": "Première",
                                "sLast": "Dernier",
                                "sNext": "Suivant",
                                "sPrevious": "Précédente"
                            },
                        },
                        ajax: {
                            type: 'post',
                            url: '../../services/reports/get_donateurs_list.php',
                            dataSrc: '',
                        },
                        columns: [{
                                "data": "id",
                                "visible": false
                            },
                            {
                                "data": "titre",
                                "visible": false
                            },
                            {
                                "data": "intitule"
                            },
                            {
                                "data": "accno",
                                "visible": false
                            },
                            {
                                "data": "diver",
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
                                "data": "email"
                            },
                            {
                                "data": "tele",
                                "visible": false
                            },
                            {
                                "data": "communication"
                            },
                            {
                                "data": "codano",
                            },
                            {
                                "data": "codaaccno",
                                "visible": false
                            },
                            {
                                "data": "trdate",
                                render: function(data, type, row) {
                                    return moment(new Date(data).toString()).format('DD-MM-YYYY');
                                }
                            },
                            {
                                "data": "amount"
                            },
                            {
                                "data": "remarks"
                            },
                        ],
                    });

                    // Hide selected columns
                    $('.toggle-vis').on('change', function(e) {
                        e.preventDefault();

                        // Get the column API object
                        var column = table.column($(this).attr('data-column'));

                        // Toggle the visibility
                        column.visible(!column.visible());
                    });

                    // download as excel function
                    $("#download_xls").on('click', function() {
                        $.ajax({
                            type: 'post',
                            url: '../../services/reports/downloadxlsdonorreports.php',
                            success: function(data) {
                                // console.log(data);
                                var blob = new Blob([data], {
                                    type: 'application/vnd.ms-excel'
                                });
                                var downloadUrl = URL.createObjectURL(blob);
                                var a = document.createElement("a");
                                a.href = downloadUrl;
                                a.download = "downloadDonateurFile.xls";
                                document.body.appendChild(a);
                                a.click();
                            }

                        })
                    })

                    // download as csv function
                    $("#download_csv").on('click', function() {
                        $.ajax({
                            type: 'post',
                            url: '../../services/reports/downloadcsvdonorreports.php',
                            success: function(data) {
                                // console.log(data);
                                var blob = new Blob([data], {
                                    type: "octet/stream"
                                });
                                var downloadUrl = URL.createObjectURL(blob);
                                var a = document.createElement("a");
                                a.href = downloadUrl;
                                a.download = "downloadDonateurFile.csv";
                                document.body.appendChild(a);
                                a.click();
                            }

                        })
                    })
                })
            </script>