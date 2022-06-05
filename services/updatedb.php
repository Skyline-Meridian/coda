<?php
// Include config file
include '../db_config.php';

// prepare all variables - transaction is for coda data table
$transaction = $_POST['transaction'];

// these are for coda table - Basic common info
$coda_filename = trim($_POST['filename']);
$str=explode('-', $transaction['date']);
$strdate=$str[2].'-'.$str[1].'-'.$str[0];
$coda_date =date("Y-m-d",strtotime($strdate));
 
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
$tr_date =date('Y-m-d',strtotime($transaction['tr']['date']));
//$tr_date = date_format($dateTimeObj1,'Y-m-d');
$tr_currency = trim($transaction['tr']['currency']);
$tr_amount = trim($transaction['tr']['amount']);
$tr_stmt_sq_no = trim($transaction['tr']['stmt_sq']);
$tr_sequence = trim($transaction['tr']['trns_sq']);
$tr_msg = trim($transaction['tr']['msg']);

// these are for members table
$name = trim($_POST['name']);
$number = trim($transaction['tr']['number']);
$member_id = trim($_POST["id"]);
$titre = trim($_POST["titre"]);
$divers = trim($_POST["divers"]);
$addresse = trim($_POST["addresse"]);
$communication = trim($_POST["communication"]);
$numero_enterprise = trim($_POST["numero_enterprise"]);
$cp = trim($_POST["cp"]);
$localite = trim($_POST["localite"]);

$remarks = trim($_POST["remarks"]);
$naissance = trim($_POST["naissance"]);
$email = trim($_POST["email"]);
$telephone = trim($_POST["telephone"]);
$dervst = (isset($_POST["dervst"]))?trim($_POST["dervst"]):$tr_date;
$cumulvst = (isset($_POST["cumulvst"]))?trim($_POST["cumulvst"]):$tr_amount;
echo $monant = (isset($_POST["monant"]))?trim($_POST["monant"]):'';
$tr_amount=($tr_amount-$monant);
// $cumulvst=($cumulvst);


// check if atleast name and number is not empty
if (!empty($member_id) && !empty($name) && !empty($number)){

    // prepare to update member table first
        $sql = "UPDATE members SET intitule=:intitule, accno=:accno, diver=:diver, titre=:titre, addresse=:addresse, cp=:cp, localite=:localite, email=:email, naissance=:naissance, tele=:tele, communication = CONCAT(:communication,communication), numero_enterprise=:numero_enterprise, dervst=:dervst, cumulvst=:cumulvst WHERE id=:id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        $stmt->bindParam(":intitule", $param_name);
        $stmt->bindParam(":accno", $param_accno);
        $stmt->bindParam(":diver", $param_diver);
        $stmt->bindParam(":titre", $param_titre);
        $stmt->bindParam(":addresse", $param_addresse);
        $stmt->bindParam(":cp", $param_cp);
        $stmt->bindParam(":localite", $param_localite);
        $stmt->bindParam(":email", $param_email);
        $stmt->bindParam(":naissance", $param_naissance);
        $stmt->bindParam(":tele", $param_tele);
        $stmt->bindParam(":communication", $param_communication);
        $stmt->bindParam(":numero_enterprise", $param_numero_enterprise);
        $stmt->bindParam(":dervst", $param_dervst);
        $stmt->bindParam(":cumulvst", $param_cumulvst);
        
        // Set parameters
        $param_id = $member_id;
        $param_name = $name;
        $param_accno = $number;
        $param_diver = $divers;
        $param_titre = $titre;
        $param_addresse = $addresse;
        $param_cp = $cp;
        $param_localite = $localite;
        $param_email = $email;
        $param_naissance = $naissance;
        $param_tele = $telephone;
        $param_communication = ($communication == '')?'':$communication . ' | ';
        $param_numero_enterprise = $numero_enterprise;
        $param_dervst = $dervst;
        $param_cumulvst = $cumulvst;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Member records updated successfully. Updating transaction table now

            // check if transaction already added
            $sql1 = "SELECT * FROM coda_data WHERE sequence_number='".$sequence_number."' AND tr_sequence='".$tr_sequence."'";
            $result = $pdo->query($sql1);
            // if not added this transaction
            if($result->rowCount() == 0){
                // Coda table fields
                $coda_data_fields = ['coda_filename', 'coda_date', 'timezone', 'account_name', 'sequence_number', 'bic', 'cin', 'account_number', 'currency_code', 'country_code', 'intial_bal', 'new_bal', 'info_msg', 'member_id', 'tr_bic', 'tr_date', 'tr_currency', 'tr_amount', 'monant', 'tr_sequence', 'tr_msg', 'remarks'];

                // prepare to insert new transaction in coda_data table
                $sql2 = "INSERT INTO coda_data (coda_filename, coda_date, timezone, account_name, sequence_number, bic, cin, account_number, currency_code, country_code, intial_bal, new_bal, info_msg, member_id, tr_bic, tr_date, tr_currency, tr_amount, monant, tr_sequence, tr_msg, remarks) VALUES (:coda_filename, :coda_date, :timezone, :account_name, :sequence_number, :bic, :cin, :account_number, :currency_code, :country_code, :intial_bal, :new_bal, :info_msg, :member_id, :tr_bic, :tr_date, :tr_currency, :tr_amount, :monant, :tr_sequence, :tr_msg, :remarks)";
                    
                if ($stmt2 = $pdo->prepare($sql2)) {
                    // Bind variables to the prepared statement as parameters
                    for ($i = 0; $i < count($coda_data_fields); $i++){
                        $stmt2->bindParam(":".$coda_data_fields[$i], ${$coda_data_fields[$i]});
                    }
                    // Attempt to execute the prepared statement
                    if ($stmt2->execute()) {
                        $coda_data_row_id = $pdo->lastInsertId();
                        echo "Data Updated for Member id=".$member_id." and new transaction inserted at ".$coda_data_row_id;
                    } else {
                        echo "Data Updated for Member id=".$member_id."but Error in inserting new transaction";
                    }
                }
                // Close statement2
                unset($stmt2);
            } else echo "Data Updated for Member id=".$member_id." but this transaction is already added!";
        }
    }
    // Close statement
    unset($stmt);
}
// Close connection
unset($pdo);