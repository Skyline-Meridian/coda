<?php
include "db_config.php";


$type = 0;
if(isset($_POST['type'])){
    $type = $_POST['type'];
}
// Search result
if($type == 1){
    $searchText = mysqli_real_escape_string($con,$_POST['search']);

    $sql = "SELECT id,uname FROM members where uname like '%".$searchText."%' order by uname";

    $result = $conn->query($conn,$sql);

    $search_arr = array();

    if ($res3->num_rows > 0) {
      while($row = $res3->fetch_assoc()){}
        $id = $row['id'];
        $name = $row['uname'];

        $search_arr[] = array("id" => $id, "uname" => $name);
    }

    echo json_encode($search_arr);
}

// get User data
if($type == 2){
    $userid = mysqli_real_escape_string($conn,$_POST['userid']);

    $sql = "SELECT uname,accno FROM user where id=".$userid;

    $result = query($conn,$sql);

    $return_arr = array();
    if ($res3->num_rows > 0) {
        while($row = $res3->fetch_assoc()){}
        $name = $row['uname'];
        $accno = $row['accno'];

        $return_arr[] = array("name"=>$name, "accno"=> $accno);
    }

    echo json_encode($return_arr);
}