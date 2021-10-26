<?php
include '../../header.php';
include '../../db_config.php';

$members = [];
$name = 'ABC';
if(!isset($_GET['id'])){
    //return this page to list save query page
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
                        <h3 class="font-weight-bold">Query Name: <?php echo $name;?></h3>
                        <h6 class="font-weight-normal mb-0">Results are shown for your selected saved query.</h6>
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
                                    <table id="saved_query_table" class="display expandable-table" style="width:100%">
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
                var reportData = <?= json_encode($members); ?>;
                jQuery(document).ready(function($) {  

                    $('#saved_query_table').DataTable({
                        destroy: true,
                        data: reportData,
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

                })
            </script>