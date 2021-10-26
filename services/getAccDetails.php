<?php

include '../db_config.php';

$number = $_POST['accNo'];

if($number){
    $sql = "SELECT * FROM accounts WHERE acc_no='".$number."'";
    if($result = $pdo->query($sql)){
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                echo json_encode(array(
                    'id' => $row['id'],
                    'acc_name' => $row['acc_name'],
                    'bic' => $row['BIC'],
                    'cin' => $row['CIN'],
                ));
            }
        } else echo json_encode("Negative");
    } else echo json_encode("Query error");
} else echo json_encode("Acc Number null");