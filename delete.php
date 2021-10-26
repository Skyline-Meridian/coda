<?php
include 'db_config.php';
$id=$_REQUEST['id'];
$sql = "UPDATE members SET status=:status WHERE id=:id";
$stmt1 = $pdo->prepare($sql);
$stmt1->bindParam(":id", $param_id);
$stmt1->bindParam(":status", $param_status);

// Set parameters
$param_id = $id;
$param_status =0 ;
$stmt1->execute();
header('location:./all_members.php?del_id='.$id);
?>