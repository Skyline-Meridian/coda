<?php
include '../db_config.php';
$id=$_REQUEST['id'];
$sql = "DELETE FROM reports WHERE id=:id";
$stmt1 = $pdo->prepare($sql);
$stmt1->bindParam(":id", $param_id);

// Set parameters
$param_id = $id;
$stmt1->execute();
header('location:../pages/reports/saved_queries.php?del_id='.$id);
?>