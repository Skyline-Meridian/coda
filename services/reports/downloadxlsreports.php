<?php

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "reports_" . date('Y-m-d') . ".xls"; 

if (isset($_POST) && !isset($_POST['exceldata'])){

// Column names 
$post_fields = $_POST;
$fields = [];
$lineData = [];
$excelData = [];
// foreach ($_POST as $key => $val) {
//     $excelData .= $key;
//     // array_push($fields, $key);
//     // array_push($lineData, $val);
// }
foreach ($post_fields as $k => $v) {
    $excelData .=  "Param: $param_name; Value: $param_val<br />\n";
}
// $fields = array('Account Name', 'Intitule', 'Acn No', 'Bic', 'NAISSANCE', 'Transaction Date', 'Dervst Date', 'Telephone', 'Amount', 'Initial Bal', 'New Bal', 'CP', 'MESSAGE'); 

// Display column names as first row 
// $excelData = 'abcs' . "\n"; 
// $excelData .= implode("\t", array_values($fields)) . "\n"; 

// array_walk($lineData, 'filterData'); 
// $excelData .= implode("\t", array_values($lineData)) . "\n";

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo json_encode($excelData); 

} else echo json_encode("No post data");


exit;
?>