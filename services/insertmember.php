<?php
include '../db_config.php';

$id = (isset($_POST["member_id"]))?trim($_POST["member_id"]):'';
$number = (isset($_POST["acn"]))?trim($_POST["acn"]):'';
$name = (isset($_POST["intitule"]))?trim($_POST["intitule"]):'';
$titre = (isset($_POST["titre"]))?trim($_POST["titre"]):'';
$divers = (isset($_POST["divers"]))?trim($_POST["divers"]):'';
$addresse = (isset($_POST["addresse"]))?trim($_POST["addresse"]):'';
$cp = (isset($_POST["cp"]))?trim($_POST["cp"]):'';
$localite = (isset($_POST["localite"]))?trim($_POST["localite"]):'';
$naissance = (isset($_POST["naissance"]))?trim($_POST["naissance"]):'';
$email = (isset($_POST["email"]))?trim($_POST["email"]):'';
$telephone = (isset($_POST["telephone"]))?trim($_POST["telephone"]):'';
$dervst = (isset($_POST["dervst"]))?trim($_POST["dervst"]):'';
$cumulvst = (isset($_POST["cumulvst"]))?trim($_POST["cumulvst"]):'';
$communication = (isset($_POST["communication"]))?trim($_POST["communication"]):'';
$rubans = (isset($_POST["rubans"]))?trim($_POST["rubans"]):'';
$newsletter = (isset($_POST["newsletter"]))?trim($_POST["newsletter"]):'';
$added_date=date('Y-m-d');
if($id>0){
    $sql = "UPDATE members SET intitule=:intitule, accno=:accno, diver=:diver,  titre=:titre, addresse=:addresse, cp=:cp, localite=:localite, email=:email, naissance=:naissance,  tele=:tele, communication=:communication, rubans=:rubans, newsletter=:newsletter, dervst=:dervst, cumulvst=:cumulvst WHERE id=:id";
}else {
// Prepare an insert statement - intitule is name
    $sql = "INSERT INTO members (intitule, accno, diver, titre, addresse, cp, localite, email, naissance, tele, communication, rubans, newsletter, dervst, cumulvst) VALUES (:intitule, :accno, :diver, :titre, :addresse, :cp, :localite, :email, :naissance, :tele, :communication, :rubans, :newsletter, :dervst, :cumulvst)";
}
if ($stmt1 = $pdo->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    if(!empty($id)){
        $stmt1->bindParam(":id", $param_id);
    }
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

    if(!empty($id)){
        $param_id = $id;
    }
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
        print_r($stmt1);
    }
        echo 'success';
    }
