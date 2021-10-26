<?php
include 'header.php';
include 'db_config.php';
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
            <?php
            $page_title = "Add New Member";
            if (!empty($_REQUEST['id'])) {
                $query = "SELECT * FROM members where id='" . $_REQUEST['id'] . "'";
                $result = $pdo->query($query);
                $count = $result->rowCount();
                $row = $result->fetch();
                $page_title = "Edit Member";
            }
            ?>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 my-4">
                                <h3 class="font-weight-bold"><?php echo $page_title; ?></h3>
                                <!-- <h6 class="font-weight-normal mb-0">Add a new member here.</h6> -->
                            </div>
                            <div class="col-12 mb-4">
                                <form action="" class="mem" name="mem" id="mem" method="post">
                                    <div class="d-flex">
                                        <div class="mr-2 min-width-cell">
                                            <p>Titre</p>
                                            <div class="form-group">
                                                <input type="hidden" class="member_id" name="member_id" 
                                                value="<?php if (!empty($row['id'])) {
                                                    echo $row['id'];
                                                    } 
                                                ?>">
                                                <input type="text" class="form-control titre" name="titre" 
                                                value="<?php if (!empty($row['titre'])) {
                                                    echo $row['titre'];
                                                    } 
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Intitule</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control intitule" name="intitule" 
                                                value="<?php 
                                                if (!empty($row['intitule'])) {
                                                    echo $row['intitule'];
                                                    } 
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Acc Number</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control acn" name="acn" value="<?php 
                                                if (!empty($row['accno'])) {
                                                    echo $row['accno'];
                                                    } 
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Divers</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control divers" name="divers" list="diveroptions"
                                                value="<?php if (!empty($row['diver'])) {
                                                    echo $row['diver'];
                                                    } 
                                                ?>">
                                                <datalist id="diveroptions">
                                                    <option value="Testament">
                                                    <option value="Testament/Retour">
                                                    <option value="Retour">
                                                    <option value="BW">
                                                    <option value="BX">
                                                    <option value="HT">
                                                    <option value="LG">
                                                    <option value="LX">
                                                    <option value="NR">
                                                    <option value="PAYPAL">
                                                    <option value="PC">
                                                    <option value="PAS ATTESTATION">
                                                    <option value="DCD">
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Naissance</p>
                                            <div class="form-group">
                                                <input type="date" class="form-control naissance" name="naissance" 
                                                value="<?php if (!empty($row['naissance'])) {
                                                    echo $row['naissance'];
                                                    } 
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Dervst</p>
                                            <div class="form-group">
                                                <input type="date" class="form-control dervst" name="dervst" 
                                                value="<?php if (!empty($row['dervst'])) {echo $row['dervst'];} ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-2 min-width-cell">
                                            <p>Addresse</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control addresse" name="addresse" 
                                                value="<?php if (!empty($row['addresse'])) {echo $row['addresse'];} ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Localite</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control localite" name="localite" 
                                                value="<?php if (!empty($row['localite'])) {echo $row['localite'];} ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Code Postal</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control cp" name="cp" 
                                                value="<?php if (!empty($row['cp'])) {echo $row['cp'];} ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Email</p>
                                            <div class="form-group">
                                                <input type="email" class="form-control email" name="email" 
                                                value="<?php if (!empty($row['email'])) {echo $row['email'];} ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Telephone</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control telephone" name="telephone" 
                                                value="<?php if (!empty($row['tele'])) {echo $row['tele'];} ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <p>Cumulvst</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control cumulvst" name="cumulvst" 
                                                value="<?php if (!empty($row['cumulvst'])) {echo $row['cumulvst'];} ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex">
                                         <div class="mr-2 min-width-cell">
                                            <p>Communication</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control cumulvst" name="communication" 
                                                value="<?php if (!empty($row['communication'])) {echo $row['communication'];} ?>">
                                            </div>
                                        </div>
                                         <div class="mr-2 min-width-cell">
                                            <p>Rubans</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control rubans" name="rubans" 
                                                value="<?php if (!empty($row['rubans'])) {echo $row['rubans'];} ?>">
                                            </div>
                                        </div>
                                         <div class="mr-2 min-width-cell">
                                            <p>Newsletter</p>
                                            <div class="form-group">
                                                <input type="text" class="form-control newsletter" name="newsletter" 
                                                value="<?php if (!empty($row['newsletter'])) {echo $row['newsletter'];} ?>">
                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <div class="form-group">

                                            </div>
                                        </div>
                                        <div class="mr-2 min-width-cell">
                                            <div class="form-group">

                                            </div>
                                        </div>
                                          <div class="mr-2 min-width-cell">
                                            <p>&nbsp;</p>
                                            <div class="form-group">

                                            <?php if (!empty($_REQUEST['id'])) { ?>
                                            <button type="button" name="updatedb" id="updatedb" class="btn btn-info updatedb mr-2 ml-auto">Update</button>
                                            <!-- <button type="button" name="deletedb" id="deletedb" class="btn btn-danger deletedb mr-2 ml-auto">Delete</button> -->
                                        <?php } else { ?>
                                            <button type="button" name="insertdb" id="insertdb" class="btn btn-info insertdb mr-2 ml-auto">Add new member</button>
                                        <?php } ?>
                                    </div>
                                    <div class="success-message mt-2"></div>
                                </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
            
            <script>
                // INSERT Company INTO DB
                $('#insertdb').click(function(e) {
                    e.preventDefault();
                    let data1 = $("#mem").serialize();
                    $.ajax({
                        type: "POST", // type POST
                        // all form data
                        data: data1,
                        url: 'services/insertmember.php', // backend URL to insert data into database
                        success: function(data) {
                            alert('member has been added successfully');
                            window.location.href = "all_members.php";
                        }
                    })
                });
                // INSERT Company INTO DB
                $('#updatedb').click(function(e) {
                    e.preventDefault();
                    let data1 = $("#mem").serialize();
                    $.ajax({
                        type: "POST", // type POST
                        // all form data
                        data: data1,
                        url: 'services/insertmember.php', // backend URL to insert data into database
                        success: function(data) {
                            alert('member has been updated successfully');
                            window.location.href = "all_members.php";
                        }
                    })
                });

            </script>