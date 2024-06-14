<?php
include 'module/connect.php';

if(isset($_POST['ma_card'])){
    $ma_card = $_POST['ma_card']; // แก้ไขชื่อตัวแปรตรงนี้
    $sql = "SELECT * FROM masseuse WHERE ma_card = '$ma_card'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo json_encode(["status" => "exists"]);
    } else {
        echo json_encode(["status" => "available"]);
    }
}
?>
