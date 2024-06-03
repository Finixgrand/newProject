<?php
include 'module/connect.php';

if(isset($_POST['IDcardnumber'])){
    $IDcardnumber = $_POST['IDcardnumber'];
    $sql = "SELECT * FROM customer WHERE IDcardnumber = '$IDcardnumber'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo json_encode(["status" => "exists"]);
    } else {
        echo json_encode(["status" => "available"]);
    }
}
?>
