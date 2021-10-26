<?php
include '../../db_config.php';

$year = $_POST['year'];
echo yearlyRecords($pdo, $year);





function yearlyRecords($pdo, $year){
    $members = [];
    $j = 0;
    // $query = "SELECT * FROM members WHERE id IN 
    //             (SELECT member_id FROM coda_data WHERE YEAR(coda_date) = ".$year.")";
    $query = "SELECT m.*, SUM(cd.tr_amount) AS amount FROM members AS m 
                INNER JOIN coda_data AS cd 
                ON m.id = cd.member_id AND YEAR(coda_date) = ".$year." Group By m.id";

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