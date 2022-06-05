<?php
include '../../header.php';
include '../../db_config.php';
if(!$_SESSION['id']){
header('location:../login.php');
}

$members = [];
// $name = 'ABC';
if(!isset($_GET['id'])){
    //return this page to list save query page
    header('Location : saved_queries.php');
} else {
    $j = 0;
    $id = $_GET['id'];
    $result = $pdo->query("SELECT query, query_name FROM reports where id=".$id);
    if($result->rowCount()>0) {
        while ($q = $result->fetch()) {
            $query = $q['query'];
            $name = $q['query_name'];
            $data = $pdo->query($query);
            if($data->rowCount()>0){
                while ($row = $data->fetch()){
                    $members[$j] = $row;
                    $j++;
                }
            }            
        }
    } else $members = "No data";
    // echo "<pre>";
    // print_r($members);
    // echo "</pre>";
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
                        <h3 class="font-weight-bold">Nom de la requête: <?php echo $name;?></h3>
                        <h6 class="font-weight-normal mb-0">Les résultats sont affichés pour votre requête enregistrée sélectionnée.</h6>
                    </div>
                </div>
            </div>
            <div class="hidden-items">
                Basculer la colonne: <br>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox0" data-column="0"/><label for="checkbox0">Id</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox1" data-column="1" checked/><label for="checkbox1">Title</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox2" data-column="2" checked/><label for="checkbox2">Nom</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox3" data-column="3"/><label for="checkbox3">N° de compte</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox4" data-column="4" checked/><label for="checkbox4">Divers</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox5" data-column="5" /><label for="checkbox5">Email</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox6" data-column="6" /><label for="checkbox6">Tele</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox7" data-column="7" /><label for="checkbox7">Adresse</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox8" data-column="8" /><label for="checkbox8">CP</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox9" data-column="9" /><label for="checkbox9">Ville</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox10" data-column="10" checked/><label for="checkbox10">Communication</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox11" data-column="11" checked/><label for="checkbox11">Dernier Versement</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox12" data-column="12" checked/><label for="checkbox12">Dons</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox13" data-column="13" checked/><label for="checkbox13">Vers Cummulés</label>

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
                                    <table id="saved_query_table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th><input name="select_all" value="1" type="checkbox"></th> -->
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
                                <div class="hidden-items">
                                    <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                    <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                                </div>
                                        <!-- <button class="btn btn-info" id="save_query">Save Search Report</button> -->
                                        <!-- <a href="downloadxlsreports.php" class="btn btn-info">Download report as Excel</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

            <?php include '../../footer.php'; ?>
            <script>
                var query = <?= json_encode($query); ?>;
                var reportData = <?= json_encode($members); ?>;
                jQuery(document).ready(function($) {  

                    table = $('#saved_query_table').DataTable({
                        destroy: true,
                        data: reportData,
                        columns: [
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

                    // Hide selected columns
                    $('.toggle-vis').on('change', function(e) {
                        e.preventDefault();

                        // Get the column API object
                        var column = table.column($(this).attr('data-column'));

                        // Toggle the visibility
                        column.visible(!column.visible());
                    });

                     // download as excel function
                    $("#download_xls").on('click', function(){
                        $.ajax({
                            type: 'post',
                            data: {query : query}, 
                            url: '../../services/reports/downloadxlsreports.php',
                            success: function (data) {
                            var blob = new Blob([data], { type: 'application/vnd.ms-excel' });
                            var downloadUrl = URL.createObjectURL(blob);
                           var a = document.createElement("a");
                            a.href = downloadUrl;
                           a.download = "downloadFile.xls";
                          document.body.appendChild(a);
                         a.click();              
                            }
                                              
                        })
                    })

                     // download as excel function
                    $("#download_csv").on('click', function(){
                        $.ajax({
                            type: 'post',
                            data: reportData,
                            url: '../../services/reports/downloadcsvreports.php',
                            success: function (data) {
                            var blob = new Blob([data], {type: "octet/stream" });
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