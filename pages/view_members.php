<?php
include '../header.php';
include '../db_config.php';
if(!$_SESSION['id']){
header('location:login.php');
}
if(isset($_GET['del_id'])){
    ?>
    <script>
        alert("User deleted")
    </script>
<?php
}
?>
<!-- Navbar -->
<?php include '../navbar.php'; ?>
<div class="container-fluid page-body-wrapper">
    
    <!-- sidebar offcampus  -->
    <?php include '../sidebar-offcanvas.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
    <!-- heading text starts -->
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4">
                        <h3 class="font-weight-bold">Membre Tous les détails</h3>
                
                    </div>

                               <?php 
                                 if (!empty($_REQUEST['id'])) {
                                    $query = "SELECT * FROM members where id='" . $_REQUEST['id'] . "'";
                                    $result = $pdo->query($query);
                                    $count = $result->rowCount();
                                    $row = $result->fetch();
                                }

                               ?>

                    <div class="col-12 mb-4">
                        <div class="justify-content-start d-flex">
                            <div class="field-group p-5 bg-info text-white rounded-left">
                                <b>Titre:</b> <?php echo $row['titre'];?><br>
                                <b>Nom:</b> <?php echo $row['intitule'];?><br>
                                <b>N° de compte:</b>  <?php echo $row['accno'];?><br>                                     
                                <b>Vers Cummulés:</b>  <?php echo $row['cumulvst'];?><br>
                            </div>
                            
                            <div class="field-group p-5 bg-info text-white">
                                <b>Adresse:</b>  <?php echo $row['addresse'];?><br>
                                <b>Ville:</b>  <?php echo $row['localite'];?><br>
                                <b>CP:</b>  <?php echo $row['cp'];?><br>
                                <b>Naissance:</b> <?php if($row['naissance']!='0000-00-00'){ echo date('d-m-Y',strtotime($row['naissance']));}else{
                                echo '-- -- ----';} ?><br>
                                
                            </div>

                            <div class="field-group p-5 bg-info text-white rounded-right">
                                <b>Email:</b>  <?php echo $row['email'];?><br>
                                <b>Telephone:</b>  <?php echo $row['tele'];?><br>
                                <b>Communication:</b>  <?php echo $row['communication'];?><br>

                            </div>
                        </div>
                    </div>
                   

                </div>
            </div>
            <!-- Coda upload and basic data display -->

            <div>
                <!-- Toggle column: 
                <a class="toggle-vis" data-column="0">Intitule</a> - 
                <a class="toggle-vis" data-column="1">Acn No</a> - 
                <a class="toggle-vis" data-column="2">BIC</a> - 
                <a class="toggle-vis" data-column="3">Transaction Date</a> - 
                <a class="toggle-vis" data-column="4">Dervst Date</a> - 
                <a class="toggle-vis" data-column="5">Monant</a> -
                <a class="toggle-vis" data-column="6">Amount</a> -
                <a class="toggle-vis" data-column="7">Cumulvst</a> -
                <a class="toggle-vis" data-column="8">CIN</a> -
                <a class="toggle-vis" data-column="9">Remarks</a> -->
                Basculer la colonne: <br>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox0" data-column="0" checked/><label for="checkbox0">Id</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox1" data-column="1" checked/><label for="checkbox1">Nom</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox2" data-column="2" checked/><label for="checkbox2">N° de compte</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox3" data-column="3" checked/><label for="checkbox3">Transaction Date</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox4" data-column="4" checked/><label for="checkbox4">Dernier Versement</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox5" data-column="5" checked/><label for="checkbox5">Dons</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox6" data-column="6" /><label for="checkbox6">Montant</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox7" data-column="7" checked/><label for="checkbox7">Vers Cummulés</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox8" data-column="8"/><label for="checkbox8">BIC</8abel>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox9" data-column="9"/><label for="checkbox9">CIN</label>
                <input type="checkbox" class="form-control-sm toggle-vis" id="checkbox10" data-column="10" checked/><label for="checkbox10">Remarks</label>
                
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 my-4">
                                <h3 class="font-weight-bold">Transaction</h3>
                                <!-- <h6 class="font-weight-normal mb-0">View all members list here.</h6> -->
                            </div>
                            <div class="col-12 mb-4">
                                <div class="table-responsive">
                                    <table id="membertable" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">Id</th>
                                                <th width="20%">Nom</th>
                                                <th width="20%">N° de compte</th>
                                                <th width="20%">Transaction Date</th>
                                                <th width="20%">Dernier Versement</th>
                                                <th width="5%">Dons</th>
                                                <th width="5%">Montant</th>
                                                <th width="5%">Vers Cummulés</th>
                                                <th width="10%">BIC</th>
                                                <th width="5%">CIN</th>
                                                <th width="5%">Remarks</th>
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
                let id= <?php echo $_GET['id'];?>;
              
                var table = $('#membertable').DataTable({
                                 destroy: true,
                                 ajax: {
                                    type: 'post',
                                     data: {id:id},
                                    url: '../services/getMembersTransaction.php',
                                    dataSrc: ''
                                     },
                                columns: [
                                { "data": "id" },
                                { "data": "intitule" },
                                { "data": "accno" },
                                { "data": "tr_date",
                                    render: function (data, type, row) {
                                        return moment(new Date(data).toString()).format('DD-MM-YYYY');
                                    }
                                },
                                { "data": 'dervst',
                                    render: function (data, type, row) {
                                        if(data == '0000-00-00'){
                                            return "-- -- ----"
                                        } else {
                                            return moment(new Date(data).toString()).format('DD-MM-YYYY');
                                        }
                                    }
                                },
                                { "data": "tr_amount" },
                                { "data": "monant", "visible": false },
                                { "data": "cumulvst" },
                                { "data": "bic", "visible": false },
                                { "data": "cin", "visible": false },
                                { "data": "remarks" }
                                ]
                            });

                             // Hide selected columns
                            $('.toggle-vis').on('change', function(e) {
                                e.preventDefault();

                                // Get the column API object
                                var column = table.column($(this).attr('data-column'));

                                // Toggle the visibility
                                column.visible(!column.visible());
                            });
        
            </script>