<?php 
// Load the database configuration file 
include_once '../../db_config.php'; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "reports_" . date('Y-m-d') . ".xls"; 
 
// Column names 
 $fields = array('Account Name', 'Intitule', 'Acn No', 'Bic', 'NAISSANCE', 'Transaction Date', 'Dervst Date', 'Telephone', 'Amount', 'Initial Bal', 'New Bal', 'CP', 'MESSAGE');  

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

// Fetch records from database 
 $sq= "SELECT coda_data.id,coda_data.currency_code,coda_data.tr_msg,coda_data.account_name,coda_data.intial_bal,coda_data.new_bal,members.tele,members.dervst,members.naissance,coda_data.cin,members.intitule,coda_data.info_msg,coda_data.valuta_date,coda_data.tr_amount,members.id,coda_data.bic,coda_data.tr_date, coda_data.account_number   FROM coda_data INNER JOIN members ON coda_data.member_id=members.id  order by coda_data.id desc";
 $res = $pdo->query($sq); 
  $count=$res->rowCount();
if($count>0) {
         while($row1 = $res->fetch()){
         $lineData = array($row1['account_name'], $row1['intitule'], $row1['account_number'], $row1['bic'], $row1['naissance'], $row1['tr_date'], $row1['dervst'], $row1['tele'], $row1['currency_code'].' '.$row1['tr_amount'], $row1['currency_code'].' '.$row1['intial_bal'], $row1['currency_code'].' '.$row1['new_bal'], $row1['cin'],$row1['tr_msg']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;