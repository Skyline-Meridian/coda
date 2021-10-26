<?php
// Include config file
include '../db_config.php';

// prepare all variables 
$transaction = $_POST['transaction'];

// these are for coda table - Basic common info
$coda_filename = trim($_POST['filename']);
$coda_date = trim($transaction['date']);
$timezone = trim($transaction['timezone']);
$account_name = trim($transaction['account_name']);
$bic = trim($transaction['bic']);
$cin = trim($transaction['cin']);
$sequence_number = trim($transaction['sequence_number']);
$account_number = trim($transaction['account_number']);
$currency_code = trim($transaction['currency_code']);
$country_code = trim($transaction['country_code']);
$intial_bal = trim($transaction['intial_bal']);
$new_bal = trim($transaction['new_bal']);
$info_msg = trim($transaction['info_msg']);

//actual transaction info for this member
$tr_bic = trim($transaction['tr']['bic']);
$tr_date = trim($transaction['tr']['date']);
$tr_currency = trim($transaction['tr']['currency']);
$tr_amount = trim($transaction['tr']['amount']);
$tr_stmt_sq_no = trim($transaction['tr']['stmt_sq']);
$tr_sequence = trim($transaction['tr']['trns_sq']);
$tr_msg = trim($transaction['tr']['msg']);

// these are for members table
$name = trim($transaction['tr']['name']);
$number = trim($transaction['tr']['number']);
$titre = (isset($_POST["titre"]))?trim($_POST["titre"]):'';
$divers = (isset($_POST["divers"]))?trim($_POST["divers"]):'';
$addresse = (isset($_POST["addresse"]))?trim($_POST["addresse"]):'';
$communication = trim($_POST["communication"]);
$cp = (isset($_POST["cp"]))?trim($_POST["cp"]):'';
$newsletter = trim($_POST["newsletter"]);
$localite = (isset($_POST["localite"]))?trim($_POST["localite"]):'';
$rubans = trim($_POST["rubans"]);
$remarks = trim($_POST["remarks"]);
$naissance = (isset($_POST["naissance"]))?trim($_POST["naissance"]):'';
$email = (isset($_POST["email"]))?trim($_POST["email"]):'';
$telephone = (isset($_POST["telephone"]))?trim($_POST["telephone"]):'';
$dervst = (isset($_POST["dervst"]))?trim($_POST["dervst"]):'';
$cumulvst = (isset($_POST["cumulvst"]))?trim($_POST["cumulvst"]):'';


// check if atleast name and number is not empty
if (!empty($name) && !empty($number)) {

    // $check_sql = "SELECT * FROM members WHERE accno = :accno";
    // if($stmt = $pdo->prepare($check_sql)){
    //     $stmt->bindParam(":accno", $param_accno);
    //     $param_accno = $number;
    //     if($stmt->execute()){
    //         if($stmt->rowCount() == 0){

    // Prepare an insert statement - intitule is name
    $sql1 = "INSERT INTO members (intitule, accno, diver, titre, addresse, cp, localite, email, naissance, tele, communication, rubans, newsletter, dervst, cumulvst) VALUES (:intitule, :accno, :diver, :titre, :addresse, :cp, :localite, :email, :naissance, :tele, :communication, :rubans, :newsletter, :dervst, :cumulvst)";

    if ($stmt1 = $pdo->prepare($sql1)) {
        // Bind variables to the prepared statement as parameters
        $stmt1->bindParam(":titre", $param_titre);
        $stmt1->bindParam(":intitule", $param_name);
        $stmt1->bindParam(":accno", $param_accno);
        $stmt1->bindParam(":diver", $param_diver);
        $stmt1->bindParam(":addresse", $param_addresse);
        $stmt1->bindParam(":cp", $param_cp);
        $stmt1->bindParam(":localite", $param_localite);
        $stmt1->bindParam(":naissance", $param_naissance);
        $stmt1->bindParam(":email", $param_email);
        $stmt1->bindParam(":tele", $param_tele);
        $stmt1->bindParam(":communication", $param_communication);
        $stmt1->bindParam(":rubans", $param_rubans);
        $stmt1->bindParam(":newsletter", $param_newsletter);
        $stmt1->bindParam(":dervst", $param_dervst);
        $stmt1->bindParam(":cumulvst", $param_cumulvst);

        // Set parameters
        $param_titre = $titre;
        $param_name = $name;
        $param_accno = $number;
        $param_diver = $divers;
        $param_addresse = $addresse;
        $param_cp = $cp;
        $param_localite = $localite;
        $param_naissance = $naissance;
        $param_email = $email;
        $param_tele = $telephone;
        $param_communication = $communication;
        $param_rubans = $rubans;
        $param_newsletter = $newsletter;
        $param_dervst = $dervst;
        $param_cumulvst = $cumulvst;

        // Attempt to execute the prepared statement
        if ($stmt1->execute()) {
            // Records created successfully, now insert first transaction
            $member_id = $pdo->lastInsertId();

            // check if transaction already added
            $sql3 = "SELECT * FROM coda_data WHERE sequence_number='" . $sequence_number . "' AND tr_sequence='" . $tr_sequence . "'";
            $result = $pdo->query($sql3);
            if ($result->rowCount() == 0) {

                // Prepare an insert statement for transaction data
                $coda_data_fields = ['coda_filename', 'coda_date', 'timezone', 'account_name', 'sequence_number', 'bic', 'cin', 'account_number', 'currency_code', 'country_code', 'intial_bal', 'new_bal', 'info_msg', 'member_id', 'tr_bic', 'tr_date', 'tr_currency', 'tr_amount', 'tr_sequence', 'tr_msg', 'remarks'];

                // prepare to insert new transaction in coda_data table
                $sql2 = "INSERT INTO coda_data (coda_filename, coda_date, timezone, account_name, sequence_number, bic, cin, account_number, currency_code, country_code, intial_bal, new_bal, info_msg, member_id, tr_bic, tr_date, tr_currency, tr_amount, tr_sequence, tr_msg, remarks) VALUES (:coda_filename, :coda_date, :timezone, :account_name, :sequence_number, :bic, :cin, :account_number, :currency_code, :country_code, :intial_bal, :new_bal, :info_msg, :member_id, :tr_bic, :tr_date, :tr_currency, :tr_amount, :tr_sequence, :tr_msg, :remarks)";

                if ($stmt2 = $pdo->prepare($sql2)) {
                    // Bind variables to the prepared statement as parameters
                    for ($i = 0; $i < count($coda_data_fields); $i++) {
                        $stmt2->bindParam(":" . $coda_data_fields[$i], ${$coda_data_fields[$i]});
                    }
                    // Attempt to execute the prepared statement
                    if ($stmt2->execute()) {
                        $coda_data_row_id = $pdo->lastInsertId();
                        echo "Data Added for Member id=" . $member_id . " and new transaction inserted at " . $coda_data_row_id;
                    } else {
                        echo "Data Added for Member id=" . $member_id . "but Error in inserting new transaction";
                    }
                }
                // Close statement2
                unset($stmt2);
            } else echo "Data Added for Member id=" . $member_id . " but this transaction is already added!";
        } else echo "Oops! Something went wrong while adding member, try the add member form.";
    }
    // Close statement1
    unset($stmt1);
    //     } else {
    //         echo "Member with account number already exist";
    //     }
    // } else {
    //     echo "Oops! Something went wrong while checking.";
    // }
    // }

    // Close statement
    // unset($stmt);
}

// Close connection
unset($pdo);