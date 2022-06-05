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
if (isset($_POST) && !isset($_POST['exceldata'])) {

  // Column names 
  $post_fields = $_POST;
  $fields = [];
  $lineData = [];
  $excelData = [];
  //print_r($fields);
  // Column names 
  $fields = array('Id', 'Titre', 'Nom', 'N° de compte', 'Adresse', 'CP', 'Ville', 'Email', 'Telephone', 'Divers', 'Communication', 'Dernier Versement', 'Dons', 'Vers Cummulés');
  // Display column names as first row 
  $excelData = implode("\t", array_values($fields)) . "\n";
  $output = fopen("php://output", "w");
  foreach ($post_fields as $k => $v) {
    //  $excelData .=  "Param: $param_name; Value: $param_val<br />\n";
  }
  // Fetch records from database 
  $sq = $_POST['query'];
  $res = $pdo->query($sq);
  $count = $res->rowCount();
  if ($count > 0) {
    while ($row1 = $res->fetch()) {
      $lineData = array($row1['id'], $row1['titre'], $row1['intitule'], $row1['accno'], $row1['addresse'], $row1['cp'], $row1['localite'], $row1['email'], $row1['tele'], $row1['diver'], $row1['communication'], $row1['dervst'], $row1['amount'], $row1['cumulvst']);
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
