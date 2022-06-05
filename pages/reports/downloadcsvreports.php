<?php

// Load the database configuration file 
include_once '../../db_config.php';

// Fetch records from database 
$sq = $_POST['query'];
$res = $pdo->query($sq);
$count = $res->rowCount();
if ($count > 0) {
  $delimiter = ",";
  $filename = "reports_" . date('Y-m-d') . ".csv";

  // Create a file pointer 
  $f = fopen('php://memory', 'w');

  // Set column headers 
  $fields = array('Tr Id', 'N° Coda', 'N° de compte', 'Nom', 'Date', 'Montant', 'Remarques');
  fputcsv($f, $fields, $delimiter);
  while ($row1 = $res->fetch()) {

    $lineData = array($row1['id'], $row1['sequence_number'], $row1['account_number'], $row1['nom'], $row1['tr_date'], $row1['tr_amount'], $row1['remarks']);
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
