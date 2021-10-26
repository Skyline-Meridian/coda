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
                        <h3 class="font-weight-bold">Previously Saved Queries</h3>
                        <h6 class="font-weight-normal mb-0">Select the query you want to get report for.</h6>
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
                                                <th width="30%">Query No</th>
                                                <th width="50%">Query Name</th>
                                                <th width="20%">Show Report</th>
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
                        ajax: {
                            type: 'post',
                            url: '../../services/reports/get_saved_queries.php',
                            dataSrc: ''
                        },
                        columns: [
                            { "data": "id" },
                            { "data": "query_name" },
                            {
                                "mRender": function(data, type, row) {
                                    return '<a href=saved_query_reports.php?id=' + row.id + '>Show Report </a>';
                                }
                            }
                        ],
                    });
                })
            </script>