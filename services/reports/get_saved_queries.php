<?php
include_once '../../db_config.php';
$j = 0;
$result = $pdo->query("SELECT * FROM reports");
if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
        $data[$j] = $row;
        $j++;
    }
    echo json_encode($data);
} else echo json_encode(array('aaData' => ''));
