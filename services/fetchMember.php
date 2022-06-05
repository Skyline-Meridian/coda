<?php
include '../db_config.php';

$number = $_POST['number'];

if($number){
    $sql = "SELECT * FROM members where accno='".$number."' AND status=1";
    if($result = $pdo->query($sql)){
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                echo json_encode(array(
                    'id' => $row['id'],
                    'divers' => $row['diver'],
                    'accno' => $row['accno'],
                    'titre' => $row['titre'],
                    'addresse' => $row['addresse'],
                    'cp' => $row['cp'],
                    'localite' => $row['localite'],
                    'email' => $row['email'],
                    'naissance' => $row['naissance'],
                    'telephone' => $row['tele'],
                    'communication' => $row['communication'],
                    'numero_enterprise' => $row['numero_enterprise'],
                    'dervst' => $row['dervst'],
                    'cumulvst' => $row['cumulvst'],
                ));
            }
        } else echo json_encode("Negative");
    } else echo json_encode("Query error");
} else echo json_encode("Acc Number null");