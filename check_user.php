<?php
include 'module/connect.php';

if(isset($_POST['u_name'])){
    $u_name = $_POST['u_name'];
    $sql = "SELECT * FROM user WHERE u_name = '$u_name'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo json_encode(["status" => "exists"]);
    } else {
        echo json_encode(["status" => "available"]);
    }
}
?>
