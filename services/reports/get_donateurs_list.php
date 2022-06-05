<?php
include '../../db_config.php';

// We are going to get all members with all the transactions that they did.

echo GetAllMemberTransactionRecords($pdo);

function GetAllMemberTransactionRecords($pdo)
{
    $members = [];
    $j = 0;
    // $query = "SELECT * FROM members WHERE id IN 
    //             (SELECT member_id FROM coda_data WHERE YEAR(coda_date) = ".$year.")";
    $query = "SELECT m.*, cd.tr_amount AS amount, cd.remarks AS remarks, cd.tr_date AS trdate, cd.sequence_number AS codano, cd.account_number as codaaccno FROM members AS m 
                INNER JOIN coda_data AS cd 
                ON m.id = cd.member_id";

    $result =  $pdo->query($query);
    $count = $result->rowCount();
    if ($count > 0) {
        while ($row = $result->fetch()) {
            $members[$j] = $row;
            $j++;
        }
    }
    return json_encode($members);
}
