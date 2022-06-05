<?php
include '../header.php';
include '../db_config.php';
if (!$_SESSION['id']) {
    header('location:login.php');
}
if (isset($_GET['del_id'])) {
?>
    <script>
        let id = <?= $_GET['del_id']; ?>;
        alert("User id = "+id+" deleted")
    </script>
<?php
}
?>
<!-- Navbar -->
<?php include '../navbar.php'; ?>
<div class="container-fluid page-body-wrapper">

    <!-- sidebar offcampus  -->
    <?php include '../sidebar-offcanvas.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div>
            Basculer la colonne: <br>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox0" data-column="0" checked/><label for="checkbox0">Id</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox1" data-column="1" checked/><label for="checkbox1">Titre</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox2" data-column="2" checked/><label for="checkbox2">Nom</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox3" data-column="3" checked/><label for="checkbox3">Acc No</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox4" data-column="4" checked/><label for="checkbox4">Divers</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox5" data-column="5" /><label for="checkbox5">Email</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox6" data-column="6" /><label for="checkbox6">Tele</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox7" data-column="7" /><label for="checkbox7">Adresse</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox8" data-column="8" /><label for="checkbox8">CP</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox9" data-column="9" /><label for="checkbox9">Ville</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox10" data-column="10" /><label for="checkbox10">Naissance</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox11" data-column="11" checked/><label for="checkbox11">Communication</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox12" data-column="12" checked/><label for="checkbox12">Dernier Versement</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox13" data-column="13" checked/><label for="checkbox13">Vers Cummulés</label>


            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 my-4">
                                <h3 class="font-weight-bold">Membres</h3>
                                <!-- <h6 class="font-weight-normal mb-0">View all members list here.</h6> -->
                            </div>
                            <div class="col-12 mb-4">
                                <div class="table-responsive">
                                    <table id="membertable" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Titre</th>
                                                <th width="20%">Nom</th>
                                                <th width="20%">N° de compte</th>
                                                <th>Divers</th>
                                                <th>Email</th>
                                                <th>Telephone</th>
                                                <th>Adresse</th>
                                                <th>CP</th>
                                                <th>Ville</th>
                                                <th>Naissance</th>
                                                <th width="20%">Communication</th>
                                                <th>Dernier versement</th>
                                                <th>Vers Cummulés</th>
                                                <th>Action</th>
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


            <?php include '../footer.php'; ?>

            <script>
                 var table = $('#membertable').DataTable({
                    ajax: {
                        url: '../services/getMembers.php',
                        dataSrc: ''
                    },
                    lengthMenu: [
                            [10, 25, 50, 100, 500, -1],
                            [10, 25, 50, 100, 500, "All"]
                        ],
                    columns: [{
                            "data": "id"
                        },
                        {
                            "data": "titre"
                        },
                        {
                            "data": "intitule"
                        },
                        {
                            "data": "accno"
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
                            "data": "naissance",
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
                            "data": "cumulvst"
                        },
                        {
                            "mRender": function(data, type, row) {
                                return '<a class="view" href=view_members.php?id=' + row.id + '><i class="ti-eye"></i> </a><a class="edit" href=add_members.php?id=' + row.id + '><i class="ti-pencil-alt"></i></a><a class="del" href=../services/delete.php?id=' + row.id + '><i class="ti-trash"></i></a>';
                            }
                        }
                    ],
                }); 
                
                $('.toggle-vis').on('change', function(e) {
                    e.preventDefault();

                    // Get the column API object
                    var column = table.column($(this).attr('data-column'));

                    // Toggle the visibility
                    column.visible(!column.visible());
                });
                
            </script>