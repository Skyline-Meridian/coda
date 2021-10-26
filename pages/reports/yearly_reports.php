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
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Yearly Report</h3>
                        <h6 class="font-weight-normal mb-0">Select the year from the dropdown to get complete report of all transactions done in that year.</h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">

                                <select id="transaction_year" class="form-control" name="transaction_year">
                                    <option selected disabled hidden>Choose Year</option>
                                    <?php
                                    $coda_year = [];
                                    $sql99 = "SELECT coda_date FROM coda_data Group By coda_date";
                                    if ($result = $pdo->query($sql99)) {
                                        if ($result->rowCount() > 0) {
                                            while ($row = $result->fetch()) {
                                                array_push($coda_year, substr($row["coda_date"], 0, 4));
                                            }
                                        } else array_push($coda_year, "No data found");
                                    }
                                    $coda_year = array_unique($coda_year);
                                    foreach ($coda_year as $year) {
                                        if($year){
                                            echo '<option class="dropdown-item select-file" value="' . $year . '">' . $year . '</option>';
                                        }
                                    }

                                    ?>

                                </select>

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
                                    <table id="yearly_table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">Title</th>
                                                <th width="20%">Intitule</th>
                                                <th width="20%">Addresse</th>
                                                <th width="10%">CP</th>
                                                <th width="10%">Localite</th>
                                                <th width="10%">Divers</th>
                                                <th width="10%">Dons de l’année</th>
                                                <th width="10%">Cumulvst</th>
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
    $("#transaction_year").on('change', function() {
        var year = $(this).val();

        if(year){
            $('#yearly_table').DataTable({
                destroy: true,
                ajax: {
                    type: 'post',
                    data: {
                        "year": year
                    },
                    url: '../../services/reports/yearly_reports.php',
                    dataSrc: ''
                },
                columns: [
                    { "data": "titre" },
                    { "data": "intitule" },
                    { "data": "addresse" },
                    { "data": "cp" },
                    { "data": "localite" },
                    { "data": "diver" },
                    { "data": "amount" },
                    { "data": "cumulvst" },
                ],
            });
        }
    })
})
</script>
