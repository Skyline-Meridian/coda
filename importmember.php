
<?php
require_once "db_config.php";
$filename="Liste Coda latest.csv";

$file = fopen($filename, "r");
$headers = array();
$row=0;
while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
   $count = count($data);
  
$id = (isset($data[0]))?($data[0]):'';
$name = (isset($data[4]))?($data[4]):'';
$titre = (isset($data[3]))?($data[3]):'';
$divers = (isset($data[1]))?($data[1]):'';
$addresse = (isset($data[5]))?($data[5]):'';
$cp = (isset($data[6]))?($data[6]):'';
$localite = (isset($data[7]))?($data[7]):'';
$naissance = (isset($data[10]))?($data[10]):'';
$email = (isset($data[9]))?($data[9]):'';
$telephone = (isset($data[11]))?($data[11]):'';
$dervst = (isset($data[18]))?($data[18]):'';
$cumulvst = (isset($data[17]))?($data[17]):'';
$added_date=date('Y-m-d');

    if($row>0){
   
   // Prepare an insert statement - intitule is name
    $sql = "INSERT INTO members (id, intitule, diver, titre, addresse, cp, localite, email, naissance, tele, dervst, cumulvst) VALUES (:id, :intitule, :diver, :titre, :addresse, :cp, :localite, :email, :naissance, :tele, :dervst, :cumulvst)";

    if ($stmt1 = $pdo->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt1->bindParam(":id", $param_id);    
    $stmt1->bindParam(":titre", $param_titre);
    $stmt1->bindParam(":intitule", $param_name);
   // $stmt1->bindParam(":accno", $param_accno);
    $stmt1->bindParam(":diver", $param_diver);
    $stmt1->bindParam(":addresse", $param_addresse);
    $stmt1->bindParam(":cp", $param_cp);
    $stmt1->bindParam(":localite", $param_localite);
    $stmt1->bindParam(":naissance", $param_naissance);
    $stmt1->bindParam(":email", $param_email);
    $stmt1->bindParam(":tele", $param_tele);
    $stmt1->bindParam(":dervst", $param_dervst);
    $stmt1->bindParam(":cumulvst", $param_cumulvst);

    // Set parameters
    $param_id = $id;
    $param_titre = $titre;
    $param_name = $name;
   // $param_accno = $number;
    $param_diver = $divers;
    $param_addresse = $addresse;
    $param_cp = $cp;
    $param_localite = $localite;
    $param_naissance = $naissance;
    $param_email = $email;
    $param_tele = $telephone;
    //s$param_communication = ($communication == '')?'':$communication . ' | ';
    $param_dervst = $dervst;
    $param_cumulvst = $cumulvst;


        // Attempt to execute the prepared statement
        if ($stmt1->execute()) {
            // Records created successfully. Redirect to landing page
            echo 'Added Successfully';
        } else {
            echo "Oops! Something went wrong. Please try again later.";


        }
    }}
    $row++;
}
fclose($file);
?>


