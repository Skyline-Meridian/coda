<?php
include 'header.php';
include 'db_config.php';
if(isset($_GET['del_id'])){
    ?>
    <script>
        alert("User deleted")
    </script>
<?php
}
?>
<!-- Navbar -->
<?php include 'navbar.php'; ?>
<div class="container-fluid page-body-wrapper">
    <!-- setting bar  -->
    <? //php include 'settingbar.php';
    ?>
    <!-- right side bar  -->
    <? //php include 'rightsidebar.php';
    ?>
    <!-- partial -->
    <!-- sidebar offcampus  -->
    <?php include 'sidebar-offcanvas.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            <!-- Coda upload and basic data display -->

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 my-4">
                                <h3 class="font-weight-bold">Members List</h3>
                                <!-- <h6 class="font-weight-normal mb-0">View all members list here.</h6> -->
                            </div>
                            <div class="col-12 mb-4">
                                <div class="table-responsive">
                                    <table id="membertable" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">Title</th>
                                                <th width="20%">Intitule</th>
                                                <th width="20%">Account No</th>
                                                <th width="20%">Email</th>
                                                <th width="10%">Telephone</th>
                                                <th width="10%">Cumulvst</th>
                                                <th width="10%">Action</th>
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


            <?php include 'footer.php'; ?>

            <script>
                $('#membertable').DataTable({
                    ajax: {
                        url: 'services/getMembers.php',
                        dataSrc: ''
                    },
                    columns: [
                        { "data": "titre" },
                        { "data": "intitule" },
                        { "data": "accno" },
                        { "data": "email" },
                        { "data": "tele" },
                        { "data": "cumulvst" },
                        {
                            "mRender": function(data, type, row) {
                                return '<a href=add_members.php?id=' + row.id + '>Edit </a><a href=delete.php?id=' + row.id + '> Delete</a>';
                            }
                        }
                    ],
                });
            </script>