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
                        <h3 class="font-weight-bold">Requête enregistrées</h3>
                        <h6 class="font-weight-normal mb-0">Selectionner une requête pour afficher le rapport.</h6>
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
                                    <table id="query_table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="30%">Requête</th>
                                                <th width="50%">Titre</th>
                                                <th width="50%">Date</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

            <?php include '../../footer.php'; ?>
            <script>
                jQuery(document).ready(function($) {
                    $('#query_table').DataTable({
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
                            url: '../../services/reports/get_saved_queries.php',
                            dataSrc: '',
                        },
                        columns: [{
                                "data": "id"
                            },
                            {
                                "data": "query_name"
                            },
                            {
                                "data": "added_date",
                                render: function(data, type, row) {
                                    return moment(new Date(data).toString()).format('DD-MM-YYYY');
                                }
                            },
                            // {
                            //     "mRender": function(data, type, row) {
                            //         return '<a href=saved_query_reports.php?id=' + row.id + '>Montrer le rapport </a>';
                            //     }
                            // },
                            {
                                "mRender": function(data, type, row) {
                                    return '<a class="view" href=saved_query_reports.php?id=' + row.id + '><i class="ti-eye"></i> </a><a class="del" href=../../services/deletequery.php?id=' + row.id + '><i class="ti-trash"></i></a>';
                                }
                            }
                        ],
                    });
                })
            </script>