<?php
include '../vendor/autoload.php';
include '../vendor/codelicious/php-coda-parser/src/Parser.php';
include '../vendor/codelicious/php-coda-parser/src/Statements/Account.php';
include '../vendor/codelicious/php-coda-parser/src/Statements/Statement.php';
include '../vendor/codelicious/php-coda-parser/src/Statements/Transaction.php';

use Codelicious\Coda\Parser;
use Codelicious\Coda\Statements\Statement;
use Codelicious\Coda\Statements\Transaction;

$parser = new Parser();

$target_dir = "../codafiles/";
$fileName = $_FILES['file']['name'];
$filePath = $target_dir . basename($_FILES["file"]["name"]);
$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$err_msg = '';
$coda_response = [];

    // Allow only COD files
    if ($fileType != "cod") {
        $err_msg ="Only COD Files Allowed.";
    } 
    // Chech if file already exists
    else if (file_exists($filePath)) {
        $codaFile = $filePath;
        $err_msg ="File Already Uploaded.";
    } 
    // If no error message
    else if (!$err_msg) {
        // Try to upload the file
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)){
            $codaFile = $filePath;
            $err_msg ="File Uploaded Successfully.";
        } 
        // if upload failed
        else $err_msg ="File Upload Failed.";
    }  
    $coda_response['file_response'] = $err_msg;
    // Read coda file
    if($codaFile){
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
        
    echo json_encode($coda_response);