<?php
include 'header.php';
include 'db_config.php';
include 'vendors/autoload.php';
include 'vendors/codelicious/php-coda-parser/src/Parser.php';
include 'vendors/codelicious/php-coda-parser/src/Statements/Account.php';
include 'vendors/codelicious/php-coda-parser/src/Statements/Statement.php';
include 'vendors/codelicious/php-coda-parser/src/Statements/Transaction.php';

use Codelicious\Coda\Parser;
use Codelicious\Coda\Statements\Statement;
use Codelicious\Coda\Statements\Transaction;

$parser = new Parser();
$codaFile = '';
$err_msg = '';
if (isset($_POST['codafile']) || isset($_POST['filename'])) {

    $target_dir = "codafiles/";
    $fileName = '';
    if (isset($_POST['codafile'])) {
        $fileName = $_FILES['file']['name'];
    } else if (isset($_POST['filename'])) {
        $fileName = $_POST['filename'];
    }

    if ($fileName) {
        $filePath = $target_dir . basename($fileName);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $coda_response = [];
        $coda_response['file_name'] = $fileName;


        // Allow only COD files
        if ($fileType != "cod") {
            $err_msg = "Seuls les fichiers COD sont autorisés.";
        }
        // Chech if file already exists
        else if (file_exists($filePath)) {
            $codaFile = $filePath;
            $err_msg = "Fichier déjà téléchargé, Affichage des données du fichier.";
        }
        // If no error message
        else if (!$err_msg) {
            // Try to upload the file
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                $codaFile = $filePath;
                $err_msg = "Fichier transféré avec succès.";
            }
            // if upload failed
            else {
                $err_msg = "Échec du téléchargement du fichier.";
            }
        }
        $coda_response['file_response'] = $err_msg;
        // Read coda file
        if ($codaFile) {
            // use coda parser library
            $statements = $parser->parseFile($codaFile);
            foreach ($statements as $statement) {
                // store all coda values in a variable
                $coda_response['message'] = "Coda Read Success";
                $coda_response['account_name'] = $statement->getAccount()->getName();
                $coda_response['bic'] = $statement->getAccount()->getBic();
                $coda_response['cin'] = $statement->getAccount()->getCompanyIdentificationNumber();
                $coda_response['account_number'] = $statement->getAccount()->getNumber();
                $coda_response['currency_code'] = $statement->getAccount()->getCurrencyCode();
                $coda_response['country_code'] = $statement->getAccount()->getCountryCode();
                $coda_response['date'] = $statement->getDate()->format('d-m-y');
                $coda_response['timezone'] = ((array)$statement->getDate())["timezone"];
                $coda_response['intial_bal'] = $statement->getInitialBalance();
                $coda_response['new_bal'] = $statement->getNewBalance();
                $coda_response['info_msg'] = $statement->getInformationalMessage();
                // read all transactions in the coda file
                $data_transactions = (array)$statement->getTransactions();
                foreach ($data_transactions as $k => $transaction) {
                    // store all coda transactions
                    $coda_transactions[$k]['name'] = $transaction->getAccount()->getName();
                    $coda_transactions[$k]['bic'] = $transaction->getAccount()->getBic();
                    $coda_transactions[$k]['number'] = $transaction->getAccount()->getNumber();
                    $coda_transactions[$k]['date'] = date('d-m-Y', strtotime(((array)$transaction->getTransactionDate())['date']));
                    $coda_transactions[$k]['currency'] = $transaction->getAccount()->getCurrency();
                    $coda_transactions[$k]['amount'] = $transaction->getAmount();
                    $coda_transactions[$k]['msg'] = $transaction->getMessage();
                }
                // transfer all coda transactions into coda response variable
                $coda_response['transaction'] = $coda_transactions;
            }
        } else {
            // if coda file path is null
            $coda_response['message'] = "Error in File Access";
        }
    } else {
        $err_msg = "Veuillez d'abord sélectionner un fichier CODA.";
    }
?>
    <script>
        let coda_response = <?= json_encode($coda_response); ?>;
    </script>
<?php
}
?>
<style>
    .expandable-table tr td {
        font-size: 12px;
    }

    .form-control {
        height: 0px;
        padding: 12px 8px;
    }

    .dataTables_wrapper .dataTable .btn {
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
        <!-- partial -->
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
                    <div class="row">
                        <!-- Welcome message row -->
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Bienvenue Michael</h3>
                                    <h6 class="font-weight-normal mb-0">Qu’aimeriez-vous faire aujourd’hui? Commencez par télécharger le fichier coda d’aujourd’hui.</h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="mdi mdi-calendar"></i> Select Coda File Date
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">

                                                <?php
                                                // $sql99 = "SELECT MIN(coda_filename) AS filename
                                                //         , coda_date 
                                                //         From coda_data
                                                //         Group By coda_date";
                                                // if ($result = $pdo->query($sql99)) {
                                                //     if ($result->rowCount() > 0) {
                                                //         while ($row = $result->fetch()) {
                                                //             echo '<div class="dropdown-item select-file" id="' . $row["filename"] . '">' . $row["coda_date"] . '</div>';
                                                //         }
                                                //     } else echo "No data found,";
                                                // }
                                                ?>

                                            </div>
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
                                    <form class="forms-sample pt-3 pl-3" action="" method="post" enctype="multipart/form-data">
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
                                    <p id="fileHelp" class="text-danger pt-3 pl-3"><?php echo $err_msg; ?></p>
                                    <p id="fileHelp" class="form-text text-muted pt-3 pl-3">Message d’information:<span id="info_msg"></span></p>
                                </div>
                            </div>
                        </div>
                        <!-- four small blocks  -->
                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">BIC : <span id="bic">xxxxx<span></p>
                                            <p class="fs-30 mb-2"><span id="account_number">Numéro Compte</span></p>
                                            <p><span id="account_name">Nom de l’organisation<span></p>
                                            <p>N° CIN: <span id="cin">xxxxx</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">CODA Date</p>
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
                <!-- <script>
                    // Get codafile from list
                    $('.select-file').click(function() {
                        filename = this.id;
                        $.ajax({
                            type: $(this).attr('method') || 'POST',
                            url: $(this).attr('action') || window.location.pathname,
                            data: {
                                filename: filename
                            },
                            context: $(this),
                            success: function(data) {
                                alert(filename);
                                window.location.replace(data);
                            }
                        }).done(function() {
                            window.location.href = window.location.href + "?filename=" + filename;
                        });
                    })
                </script> -->


                <!-- <div class="d-flex justify-content-between">
                    <div class="cell-hilighted">
                        <form action="" class="mem" name="mem" method="post">
                            <div class="d-flex">
                                <div class="mr-2 min-width-cell">
                                    <p>Titre</p>
                                    <div class="form-group"><input type="hidden" class="member_id" name="member_id"><input type="text" class="form-control titre" name="titre"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Intitule</p>
                                    <div class="form-group"><input type="text" class="form-control intitule" name="intitule"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Acc Number</p>
                                    <div class="form-group"><input type="text" class="form-control acn" name="acn" readonly></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Divers</p>
                                    <div class="form-group"><input type="text" class="form-control divers" name="divers"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Naissance</p>
                                    <div class="form-group"><input type="date" class="form-control naissance" name="naissance"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Dervst</p>
                                    <div class="form-group"><input type="date" class="form-control dervst" name="dervst" readonly></div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-2 min-width-cell">
                                    <p>Addresse</p>
                                    <div class="form-group"><input type="text" class="form-control addresse" name="addresse"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Localite</p>
                                    <div class="form-group"><input type="text" class="form-control localite" name="localite"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Code Postal</p>
                                    <div class="form-group"><input type="text" class="form-control cp" name="cp"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Email</p>
                                    <div class="form-group"><input type="email" class="form-control email" name="email"></div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Telephone</p>
                                    <div class="form-group"><input type="text" class="form-control telephone" name="telephone"></div>
                                    <div class="form-check form-check-info mt-5">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input extourne">Extourne<i class="input-helper"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="mr-2 min-width-cell">
                                    <p>Cumulvst</p>
                                    <div class="form-group"><input type="text" class="form-control cumulvst" name="cumulvst" readonly></div>
                                    <div class="min-width-cell extourne-monant">
                                        <p>Montant à réduire</p>
                                        <input type="number" class="form-control extourne-monant-input" name="extourne">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button type="submit" name="searchname" class="btn btn-light searchname mr-2">Recherche par nom</button>
                                <button type="submit" name="insertdb" class="btn btn-info insertdb mr-2">Ajouter membre</button>
                                <button type="submit" name="updatedb" class="btn btn-success updatedb mr-2">Mettre à jour</button>
                            </div>
                            <div class="success-message mt-2"></div>
                        </form>
                    </div>
                </div> -->