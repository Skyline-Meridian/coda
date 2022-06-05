<?php
include '../db_config.php';

$cp = $_POST['cp'];

$i = 0;

if ($cp) {
    $sql = "SELECT * FROM `members` WHERE `cp` LIKE '%" . $cp . "%' AND status=1";
    if ($result = $pdo->query($sql)) {
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
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
} else echo json_encode("CP value null");
