<?php
include '../db_config.php';

$name = $_POST['name'];

$i = 0;

if($name){
    $sql = "SELECT * FROM `members` WHERE `intitule` LIKE '%".$name."%' AND status=1";
    // $sql = "SELECT * FROM members where intitule like '%".$name."%' order by intitule";
    if($result = $pdo->query($sql)){
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $output[$i] = array(
                    'id' => $row['id'],
                    'name' => $row['intitule'],
                    'accno' => $row['accno'],
                    'divers' => $row['diver'],
                    'titre' => $row['titre'],
                    'addresse' => $row['addresse'],
                    'cp' => $row['cp'],
                    'localite' => $row['localite'],
                    'email' => $row['email'],
                    'naissance' => $row['naissance'],
                    'telephone' => $row['tele'],
                    'dervst' => $row['dervst'],
                    'cumulvst' => $row['cumulvst'],
                );
                $i++;
            }
            echo json_encode($output);
        } else echo json_encode("Negative");
    } else echo json_encode("Query error");
} else echo json_encode("Name value null");