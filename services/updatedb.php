<?php
// Include config file
include '../db_config.php';

// prepare all variables - transaction is for coda data table
$transaction = $_POST['transaction'];

// these are for coda table - Basic common info
$coda_filename = trim($_POST['filename']);
$coda_date = trim($transaction['date']);
$timezone = trim($transaction['timezone']);
$account_name = trim($transaction['account_name']);
$bic = trim($transaction['bic']);
$cin = trim($transaction['cin']);
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
$tr_msg = trim($transaction['tr']['msg']);

// these are for members table
$name = trim($transaction['tr']['name']);
$number = trim($transaction['tr']['number']);
$member_id = trim($_POST["id"]);
$titre = trim($_POST["titre"]);
$divers = trim($_POST["divers"]);
$addresse = trim($_POST["addresse"]);
$cp = trim($_POST["cp"]);
$localite = trim($_POST["localite"]);
$naissance = trim($_POST["naissance"]);
$email = trim($_POST["email"]);
$telephone = trim($_POST["telephone"]);
$dervst = (isset($_POST["dervst"]))?trim($_POST["dervst"]):$tr_date;
$cumulvst = (isset($_POST["cumulvst"]))?trim($_POST["cumulvst"]):$tr_amount;


// check if atleast name and number is not empty
if (!empty($member_id) && !empty($name) && !empty($number)){

    // Prepare an update statement - intitule is name
    $sql = "UPDATE members SET intitule=:intitule, accno=:accno, diver=:diver, titre=:titre, addresse=:addresse, cp=:cp, localite=:localite, email=:email, naissance=:naissance, tele=:tele, dervst=:dervst, cumulvst=:cumulvst WHERE id=:id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        $stmt->bindParam(":titre", $param_titre);
        $stmt->bindParam(":intitule", $param_name);
        $stmt->bindParam(":accno", $param_accno);
        $stmt->bindParam(":diver", $param_diver);
        $stmt->bindParam(":addresse", $param_addresse);
        $stmt->bindParam(":cp", $param_cp);
        $stmt->bindParam(":localite", $param_localite);
        $stmt->bindParam(":naissance", $param_naissance);
        $stmt->bindParam(":email", $param_email);
        $stmt->bindParam(":tele", $param_tele);
        $stmt->bindParam(":dervst", $param_dervst);
        $stmt->bindParam(":cumulvst", $param_cumulvst);
        
        // Set parameters
        $param_id = $member_id;
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
        $param_dervst = $dervst;
        $param_cumulvst = $cumulvst;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records updated successfully. Updating transaction table
            // check if transaction already added
            $already_added = 0;
            // Check if entry exist in DB
            $sql = "SELECT * FROM coda_data WHERE coda_filename='".$coda_filename."' AND coda_date='".$coda_date."' AND member_id='".$member_id."'";

            if($result = $pdo->query($sql)){
                if($result->rowCount() == 0){
                    // Coda table fields
                    $coda_data_fields = ['coda_date', 'timezone', 'account_name', 'bic', 'cin', 'account_number', 'currency_code', 'country_code', 'intial_bal', 'new_bal', 'info_msg', 'member_id', 'tr_bic', 'tr_date', 'tr_currency', 'tr_amount', 'tr_msg'];
                    $sql2 = "INSERT INTO coda_data (coda_date, timezone, account_name, bic, cin, account_number, currency_code, country_code, intial_bal, new_bal, info_msg, member_id, tr_bic, tr_date, tr_currency, tr_amount, tr_msg) VALUES (:coda_date, :timezone, :account_name, :bic, :cin, :account_number, :currency_code, :country_code, :intial_bal, :new_bal, :info_msg, :member_id, :tr_bic, :tr_date, :tr_currency, :tr_amount, :tr_msg)";
                    if ($stmt2 = $pdo->prepare($sql2)) {
                        // Bind variables to the prepared statement as parameters
                        for ($i = 0; $i < count($coda_data_fields); $i++){
                            $stmt2->bindParam(":".$coda_data_fields[$i], ${$coda_data_fields[$i]});
                        }
                        // Attempt to execute the prepared statement
                        if ($stmt2->execute()) {
                            echo "Data Updated in Members and Codadata ".$member_id;
                        } else {
                            echo "Members Updated but Err in inserting Codadata";
                        }
                    }
                } else echo "This transaction is already added!";
            }
            // echo "Members data updated";
            // exit();
            // Close statement2
            unset($stmt2);
        } else{
            echo "Oops! Something went wrong.";
        }
    }
     
    // Close statement
    unset($stmt);
}

// Close connection
unset($pdo);