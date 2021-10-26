<?php
include '../db_config.php';
if (isset($_POST) && $_POST['member_id'] !== '' && $_POST['tr_date'] !== '' && $_POST['tr_amount'] !== '' && $_POST['select_acc_no'] !== ''){

    $account_name = $_POST['acc_name'];
    $bic = $_POST['bic'];
    $cin = $_POST['cin'];
    $account_number = $_POST['select_acc_no'];
    $member_id = $_POST['member_id'];
    $tr_date = $_POST['tr_date'];
    $tr_currency = $_POST['tr_curr'];
    $tr_amount = $_POST['tr_amount'];
    $remarks = $_POST['remarks'];

    $coda_data_fields = ['account_name', 'bic', 'cin', 'account_number', 'member_id', 'tr_date', 'tr_currency', 'tr_amount', 'remarks'];
    // prepare to insert new transaction in coda_data table
    $sql = "INSERT INTO coda_data (account_name, bic, cin, account_number, member_id, tr_date, tr_currency, tr_amount, remarks) VALUES (:account_name, :bic, :cin, :account_number, :member_id, :tr_date, :tr_currency, :tr_amount, :remarks)";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        for ($i = 0; $i < count($coda_data_fields); $i++){
            $stmt->bindParam(":".$coda_data_fields[$i], ${$coda_data_fields[$i]});
        }
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $coda_data_row_id = $pdo->lastInsertId();
            echo "New transaction inserted at ".$coda_data_row_id;
        } else {
            echo "Error in inserting new transaction";
        }
    }
    // Close statement
    unset($stmt);

// Close connection
unset($pdo);







} else echo json_encode("empty");



?>