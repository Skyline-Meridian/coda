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
$err_msg = '';
if (isset($_POST['codafile'])) {

    $target_dir = "codafiles/";
    $fileName = $_FILES['file']['name'];

        if ($fileName) {
            $filePath = $target_dir . basename($_FILES["file"]["name"]);
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $coda_response = [];
            $coda_response['file_name'] = $fileName;


            // Allow only COD files
            if ($fileType != "cod") {
                $err_msg = "Only COD Files Allowed.";
            }
            // Chech if file already exists
            else if (file_exists($filePath)) {
                $codaFile = $filePath;
                $err_msg = "File Already Uploaded, Showing file data.";
            }
            // If no error message
            else if (!$err_msg) {
                // Try to upload the file
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                    $codaFile = $filePath;
                    $err_msg = "File Uploaded Successfully.";
                }
                // if upload failed
                else {
                    $err_msg = "File Upload Failed.";
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
            $err_msg = "Please select a CODA file first.";
        }
    ?>
    <script>
    let coda_response = <?= json_encode($coda_response); ?>;
    </script>
    <?php
} 
?>
<style>
.expandable-table tr td {font-size: 12px;}
.form-control{height:0px; padding: 12px 8px;}
.dataTables_wrapper .dataTable .btn{ padding: 0.5rem 1rem;}
.success-message {max-height: 100px; overflow:auto}
.success-message a{color:#fff;}
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
                                    <h3 class="font-weight-bold">Welcome Michael</h3>
                                    <h6 class="font-weight-normal mb-0">What would you like to do today? Start with uploading today's coda file.</h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="mdi mdi-calendar"></i> Select Coda File Date
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">

<?php
// $sql99 = "SELECT DISTINCT coda_date FROM coda_data";
$sql99 = "SELECT MIN(coda_filename) AS filename
, coda_date 
From coda_data
Group By coda_date";
if($result = $pdo->query($sql99)){
    if($result->rowCount() > 0){
        while($row = $result->fetch()){
            echo '<div class="select-file">'. $row["coda_date"] .'</div>';
        }
    }else echo "No data found,";
}
?>
<script>
    // Get codafile from list
    $('.select-file').click(function () {
        alert()
    })
</script>
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
                                                <h3>Choose coda to upload</h3>
                                            </label>
                                            <input type="file" class="form-control-file" name="file" id="file" aria-describedby="fileHelp">
                                            <p id="fileHelp" class="form-text text-muted pt-3">Choose to upload a Belgian bank coda file. Only .cod file is accepted. </p>
                                        </div>
                                        <!-- <div class="col-12"> -->
                                        <button type="submit" class="btn btn-primary btn-lg" id="btn-upload" name="codafile">UPLOAD CODA</button>
                                        <!-- </div> -->
                                    </form>
                                    <p id="fileHelp" class="text-danger pt-3 pl-3"><?php echo $err_msg;?></p>
                                    <p id="fileHelp" class="form-text text-muted pt-3 pl-3">Informational Message:<span id="info_msg"></span></p>
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
                                            <p class="fs-30 mb-2"><span id="account_number">Acc Number</span></p>
                                            <p><span id="account_name">Organisation Name<span></p>
                                            <p>CIN No: <span id="cin">xxxxx</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">CODA Date</p>
                                            <p class="fs-30 mb-2"><span id="date">DD/MM/YY</span></p>
                                            <p>Timezone: <span id="timezone">xxxxx</span></p>
                                            <p>Country Code: <span id="country_code">xxx</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Initial Balance</p>
                                            <p class="fs-30 mb-2"><span id="intial_bal"></span></p>
                                            <p>Currency: <span id="currency_code">xxx</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 stretch-card transparent">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4">New Balance</p>
                                            <p class="fs-30 mb-2"><span id="new_bal"></span></p>
                                            <p>Currency: <span id="currency_code2">xxx</span></p>
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
                                                    <th width="20%">Bic</th>
                                                    <th width="20%">Account No</th>
                                                    <th width="10%">Date</th>
                                                    <th width="5%">Currency</th>
                                                    <th width="5%">Amount</th>
                                                    <th width="30%">Message</th>
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