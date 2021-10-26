<?php 
 
// Load the database configuration file 
include_once '../../db_config.php'; 
 
// Fetch records from database 
 $sq= "SELECT coda_data.id,coda_data.currency_code,coda_data.tr_msg,coda_data.account_name,coda_data.intial_bal,coda_data.new_bal,members.tele,members.dervst,members.naissance,coda_data.cin,members.intitule,coda_data.info_msg,coda_data.valuta_date,coda_data.tr_amount,members.id,coda_data.bic,coda_data.tr_date, coda_data.account_number   FROM coda_data INNER JOIN members ON coda_data.member_id=members.id  order by coda_data.id desc";
 $res = $pdo->query($sq); 
  $count=$res->rowCount();
if($count>0) {
    $delimiter = ","; 
    $filename = "reports_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Account Name', 'Intitule', 'Acn No', 'Bic', 'NAISSANCE', 'Transaction Date', 'Dervst Date', 'Telephone', 'Amount', 'Initial Bal', 'New Bal', 'CP', 'MESSAGE'); 
    fputcsv($f, $fields, $delimiter); 
             while($row1 = $res->fetch()){
              
        $lineData = array($row1['account_name'], $row1['intitule'], $row1['account_number'], $row1['bic'], $row1['naissance'], $row1['tr_date'], $row1['dervst'], $row1['tele'], $row1['currency_code'].' '.$row1['tr_amount'], $row1['currency_code'].' '.$row1['intial_bal'], $row1['currency_code'].' '.$row1['new_bal'], $row1['cin'],$row1['tr_msg']); 
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