<?php

use Codelicious\Coda\Values\Date;

include '../../db_config.php';

$from = $_POST['start_date'];
$to = $_POST['end_date'];

$operator_field1 = $_POST['operator_field1'];
$field1 = isset($_POST['field1'])?$_POST['field1']:'';
$field_value1 = isset($_POST['field_value1'])?trim($_POST['field_value1']):'';

$operator_field2 = $_POST['operator_field2'];
$operator_field21 = $_POST['operator_field21'];
$field2 = isset($_POST['field2'])?$_POST['field2']:'';
$field_value2 = isset($_POST['field_value2'])?trim($_POST['field_value2']):'';

$operator_field3 = $_POST['operator_field3'];
$field3 = isset($_POST['field3'])?$_POST['field3']:'';
$field_value3 = isset($_POST['field_value3'])?trim($_POST['field_value3']):'';

$operator_field4 = $_POST['operator_field4'];
$field4 = isset($_POST['field4'])?$_POST['field4']:'';
$field_value4 = isset($_POST['field_value4'])?trim($_POST['field_value4']):'';

$post_data = [$to, $from, $operator_field1, $field1, $field_value1, $operator_field2, $field2, $field_value2, $operator_field3, $field3, $field_value3, $operator_field4, $field4, $field_value4, $operator_field21];

echo trRecords($pdo, $post_data);





function trRecords($pdo, $post_data){
    $members = [];
    $j = 0;

    if($post_data[3] != ''){
        $op1 = $post_data[2];
        $query_part1 = $post_data[3]." like '%".$post_data[4]."%'";
    } else $op1 = $query_part1 = '';
    if($post_data[6] != ''){
        $op2 = $post_data[5];
        $query_part2 = $post_data[6].$post_data[14].$post_data[7];
    } else $op2 = $query_part2 = '';
    if($post_data[9] != ''){
        $op3 = $post_data[8];
        $query_part3 = $post_data[9]." like '%".$post_data[10]."%'";
    } else $op3 = $query_part3 = '';
    if($post_data[12] != ''){
        $op4 = $post_data[11];
        $query_part4 = $post_data[12]." like '%".$post_data[13]."%'";
    } else $op4 = $query_part4 = '';


    
    $query = "SELECT m.id AS member_id, m.intitule AS nom, cd.* FROM members AS m 
                INNER JOIN coda_data AS cd 
                ON m.id = cd.member_id WHERE cd.tr_date BETWEEN CAST('".$post_data[1]."' AS DATE) AND CAST('".$post_data[0]."' AS DATE) $op1 $query_part1 $op2 $query_part2 $op3 $query_part3 $op4 $query_part4 AND m.status = 1";

    $members['query'] = $query;

    $result =  $pdo->query($query);
    $count=$result->rowCount();
    if($count>0) {
        while ($row = $result->fetch()) {
            $members['members'][$j] = $row;
            $j++;
        }
    } else {
        $members['members'] = 0;
    }
    return json_encode($members);
}




?>