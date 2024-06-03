<?php
include 'module/connect.php';

if(isset($_POST['u_name'])){
    $u_name = $_POST['u_name'];
    $sql = "SELECT * FROM customer WHERE u_name = '$u_name'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name']; // Assuming 'name' is the column name in your 'customer' table
        echo json_encode(["status" => "exists", "name" => $name]);
    } else {
        echo json_encode(["status" => "available"]);
    }
}
?>