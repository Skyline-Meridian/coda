<?php
include '../../db_config.php';
if(isset($_POST["ids"]) && $_POST["ids"] != ''){
    $member_id = implode("','", $_POST["ids"]);
    $communication = $_POST['newCom'];
    // UPDATE members SET communication = CONCAT('abc |',communication) WHERE id IN ('3303','3308');
    if($communication){
        $sql = "UPDATE members SET communication = CONCAT(:communication,communication) WHERE id IN ('". $member_id. "')";
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":communication", $param_communication);
            // Set parameters
            $param_communication = $communication." | ";
            if($stmt->execute()){
                echo "Communications updated!";
            } else echo "Failed";
        }
    } else echo "Enter Communication";
} else echo "Select member first";


