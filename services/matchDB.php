<?php
// Include config file
include '../db_config.php';

$sequence_number = trim($_POST['sequence_number']);
$tr_sequence = trim($_POST['tr_sequence']);

// check if transaction already added
$sql1 = "SELECT * FROM coda_data WHERE sequence_number='".$sequence_number."' AND tr_sequence='".$tr_sequence."'";
$result = $pdo->query($sql1);
// if not added this transaction
if($result->rowCount() == 0){
    $added = 0;
} else $added = 1;

echo $added;
?>