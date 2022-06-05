<?php
include '../db_config.php';
$id=$_POST['id'];

$data=[];
  $j = 0;
     $query = "SELECT members.intitule,members.cp, members.accno, members.localite,  members.addresse,members.diver, members.dervst,members.naissance,coda_data.tr_date,coda_data.tr_amount,coda_data.bic,coda_data.tr_msg,coda_data.cin,coda_data.monant,coda_data.remarks, members.cumulvst, members.id FROM members LEFT JOIN coda_data ON members.id = coda_data.member_id where member_id='".$id."'  order by id desc";
      $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {

        $data[$j] = $row;
            $j++;
        }
    }
    echo json_encode($data);
    





?>