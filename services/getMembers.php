<?php
include '../db_config.php';

echo selectAllRecords($pdo, 'members');





function selectAllRecords($pdo, $tablename){
    $members = [];
    $j = 0;
    $query = "SELECT * FROM $tablename where status=1";
    $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {
            $members[$j] = $row;
            $j++;
        }
    }
    return json_encode($members);
}




?>