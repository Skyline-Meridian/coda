<?php
include 'header.php';
include 'db_config.php';
// session_start();
if (!$_SESSION['auth']) {
    header('location:pages/login.php');
}
?>

<style>
    .expandable-table tr td {
        font-size: 12px;
    }

    .form-control {
        height: 30px;
        padding: 12px 8px;
    }

    .dataTables_wrapper .dataTable .btn {
        margin-top: 10px;
        padding: 0.5rem 1rem;
    }

    .success-message {
        max-height: 100px;
        overflow: auto
    }

    .success-message a {
        color: #fff;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

        <div class="container-fluid page-body-wrapper">
            <!-- sidebar offcampus  -->
            <?php include 'sidebar-offcanvas.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <!-- Welcome message row -->
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Bienvenue <?php echo $_SESSION['name']; ?></h3>
                                    <h6 class="font-weight-normal mb-0">Qu’aimeriez-vous faire aujourd’hui? Commencez par télécharger le fichier coda d’aujourd’hui.</h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <select class="form-control form-control-sm" id="uploaded_coda" name="uploaded_coda">
                                                <option selected disabled hidden>Select Coda File Date</option>
                                                <?php
                                                $sql = "SELECT MIN(coda_filename) AS filename, coda_date, sequence_number FROM coda_data Group By coda_date";
                                                if ($result = $pdo->query($sql)) {
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) {
                                                            if ($row["filename"]) {
                                                                echo '<option class="dropdown-item select-coda-file-date" value="' . $row["filename"] . '">' . date('d-m-Y', strtotime($row["coda_date"])) . ' | Sq.N° ' . $row["sequence_number"] . '</option>';
                                                            }
                                                        }
                                                    } else echo '<option class="dropdown-item select-coda-file-date" value="">No Data Found</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Coda upload and basic data display -->
                    <div class="row">
                        <!-- Image row column -->
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card tale-bg">
                                <div class="card-body">
                                    <form class="forms-sample pt-3 pl-3" id="codaform" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="codafile">
                                                <h3>Choisissez coda à télécharger</h3>
                                            </label>
                                            <input type="file" class="form-control-file" name="file" id="file" aria-describedby="fileHelp">
                                            <p id="fileHelp" class="form-text text-muted pt-3">Choisissez de télécharger un fichier coda bancaire belge. Seul le format de fichier .cod est accepté. </p>
                                        </div>
                                        <!-- <div class="col-12"> -->
                                        <button type="submit" class="btn btn-primary btn-lg" id="btn-upload" name="codafile">Télécharger CODA</button>
                                        <!-- </div> -->
                                    </form>
                                    <p id="fileHelp1" class="text-danger pt-3 pl-3"><span id="file_response"></span></p>
                                    <p id="fileHelp2" class="form-text text-muted pt-3 pl-3">Message d’information:<span id="info_msg"></span></p>
                                </div>
                            </div>
                        </div>
                        <!-- four small blocks  -->
                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">BIC : <span id="bic">xxxxx</span></p>
                                            <p class="fs-30 mb-2"><span id="account_number">Numéro Compte</span></p>
                                            <p><span id="account_name">Nom de l’organisation</span></p>
                                            <p>N° CIN: <span id="cin">xxxxx</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Sequence No : <span id="sequence_number">xxx</span></p>
                                            <p class="fs-30 mb-2"><span id="date">JJ/MM/AA</span></p>
                                            <p>Fuseau horaire: <span id="timezone">xxxxx</span></p>
                                            <p>Code du pays: <span id="country_code">xxx</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Solde initial</p>
                                            <p class="fs-30 mb-2"><span id="intial_bal"></span></p>
                                            <p>Devise: <span id="currency_code">xxx</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 stretch-card transparent">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4">Nouveau bilan</p>
                                            <p class="fs-30 mb-2"><span id="new_bal"></span></p>
                                            <p>Devise: <span id="currency_code2">xxx</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">Transactions</p>
                                    <div class="table-responsive">
                                        <table id="codatable" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><b>+<b></th>
                                                    <th width="20%">Intitule</th>
                                                    <th width="15%">Bic</th>
                                                    <th width="15%">Numéro Compte</th>
                                                    <th width="10%">Date</th>
                                                    <th width="5%">Devise</th>
                                                    <th width="10%">Montant</th>
                                                    <th width="25%">Message</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- datatable row ends -->
                </div>
                <!-- content-wrapper ends -->

                <?php include 'footer.php'; ?>