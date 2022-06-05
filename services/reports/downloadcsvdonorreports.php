<?php

// Load the database configuration file 
include_once '../../db_config.php';

// Fetch records from database 
$sq = "SELECT m.*, cd.tr_amount AS amount, cd.remarks AS remarks, cd.tr_date AS trdate, cd.sequence_number AS codano, cd.account_number as codaaccno FROM members AS m 
                INNER JOIN coda_data AS cd 
                ON m.id = cd.member_id";
$res = $pdo->query($sq);
$count = $res->rowCount();
if ($count > 0) {
    $delimiter = ",";
    $filename = "reports_" . date('Y-m-d') . ".csv";

    // Create a file pointer 
    $f = fopen('php://memory', 'w');

    // Set column headers 
    $fields = array('Id', 'Titre', 'Nom', 'N° de compte', 'Divers', 'Adresse', 'CP', 'Localite', 'Email', 'Telephone',  'Communication', 'Coda Number', 'Beneficiary compte', 'Date', 'Montant', 'Remarques');
    fputcsv($f, $fields, $delimiter);
    while ($row1 = $res->fetch()) {

        $lineData = array($row1['id'], $row1['titre'], $row1['intitule'], $row1['accno'], $row1['diver'], $row1['addresse'], $row1['cp'], $row1['localite'], $row1['email'], $row1['tele'],  $row1['communication'], $row1['codano'], $row1['codaaccno'], $row1['trdate'], $row1['amount'], $row1['remarks']);
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
