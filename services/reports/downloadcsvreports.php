<?php 
 
// Load the database configuration file 
include_once '../../db_config.php'; 
 
// Fetch records from database 
   $sq= $_POST['query'];
    $res = $pdo->query($sq); 
  $count=$res->rowCount();
if($count>0) {
    $delimiter = ","; 
    $filename = "reports_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
   $fields = array('Id', 'Titre', 'Nom', 'N° de compte', 'Adresse', 'CP', 'Ville', 'Email', 'Telephone', 'Divers', 'Communication', 'Dernier Versement', 'Dons', 'Vers Cummulés');  
  fputcsv($f, $fields, $delimiter); 
             while($row1 = $res->fetch()){
              
        $lineData = array($row1['id'], $row1['titre'], $row1['intitule'], $row1['accno'], $row1['addresse'], $row1['cp'], $row1['localite'], $row1['email'], $row1['tele'], $row1['diver'], $row1['communication'], $row1['dervst'], $row1['amount'], $row1['cumulvst']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>