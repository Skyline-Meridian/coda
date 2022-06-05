<?php
include('../../db_config.php');
// Filter the excel data 
function filterData(&$str)
{
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", $str);
  if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Excel file name for download 
$fileName = "reports_" . date('Y-m-d') . ".xls";
//print_r($_POST);
if (isset($_POST) && !isset($_POST['reportData'])) {

  // Column names 
  $post_fields = $_POST;
  $fields = [];
  $lineData = [];
  $excelData = [];
  //print_r($fields);
  // Column names 
  $fields = array('Tr Id', 'N° Coda', 'N° de compte', 'Nom', 'Date', 'Montant', 'Remarques');
  // Display column names as first row 
  $excelData = implode("\t", array_values($fields)) . "\n";
  $output = fopen("php://output", "w");
  // foreach ($post_fields as $k => $v) {
  //  $excelData .=  "Param: $param_name; Value: $param_val<br />\n";
  // }


  // Fetch records from database 
  $sq = $_POST['query'];
  $res = $pdo->query($sq);
  $count = $res->rowCount();
  if ($count > 0) {
    while ($row1 = $res->fetch()) {
      $lineData = array($row1['id'], $row1['sequence_number'], $row1['account_number'], $row1['nom'], $row1['tr_date'], $row1['tr_amount'], $row1['remarks']);
      array_walk($lineData, 'filterData');
      $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
  } else {
    $excelData .= 'No records found...' . "\n";
  }
}
// Headers for download 
header("Content-Type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=\"$fileName\"");
// Render excel data 
echo $excelData;
fclose($output);
