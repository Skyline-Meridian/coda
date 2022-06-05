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

            // Update last payment and total payment in members table
            $sql1 = "SELECT dervst, cumulvst FROM members WHERE id='".$member_id."'";
            $result = $pdo->query($sql1);
            $row = $result->fetch();
            if ($row['dervst'] != '' && strtotime($row['dervst']) < strtotime($tr_date)){
                $dervst = $tr_date;
            } else $dervst = $row['dervst'];
            $cumulvst=($row['cumulvst']+$tr_amount);

            // prepare to update member table first
        $sql2 = "UPDATE members SET cumulvst=:cumulvst, dervst=:dervst WHERE id=:member_id";
        $stmt1 = $pdo->prepare($sql2);
        $stmt1->bindParam(":member_id", $param_member_id);
        $stmt1->bindParam(":cumulvst", $param_cumulvst);
        $stmt1->bindParam(":dervst", $param_dervst);
        $param_member_id = $member_id;
        $param_cumulvst = $cumulvst;
        $param_dervst = $dervst;
        $stmt1->execute();

            echo "New transaction inserted at ".$coda_data_row_id;
        } else {
            echo "Error in inserting new transaction";
        }
    }
    // Close statement
    unset($stmt);

// Close connection
unset($pdo);







} else echo json_encode("Tous les champs sont obligatoires");



?>