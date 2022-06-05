<?php
include_once '../../db_config.php'; 
$msg = '';

if (isset($_POST) && $_POST['query'] !== '' && $_POST['query_name'] !== ''){
    
    $query_name = trim($_POST['query_name']);
    $query = $_POST['query'];
    $added_date=date('Y-m-d');

    // echo json_encode($_POST['query_name'].' - '.$_POST['query']);

    // Prepare an insert statement - intitule is name
    $sql = "INSERT INTO reports (query_name, query, added_date) VALUES (:query_name, :query, :added_date)";

    // Bind variables to the prepared statement as parameters
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":query_name", $param_name);
        $stmt->bindParam(":query", $param_query);
         $stmt->bindParam(":added_date", $param_added_date);
    }
    // Set parameters
    $param_name = $query_name;
    $param_query = $query;
     $param_added_date = $added_date;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Records created successfully, now insert first transaction
        $record_id = $pdo->lastInsertId();
        $msg = "Record saved successfully. Record id - " . $record_id;
    } else $msg = "Failed to save record.";
} else $msg = "Incorrect Data or Server error.";

echo json_encode($msg);

?>