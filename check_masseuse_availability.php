<?php
include 'module/connect.php';

if (isset($_POST['ma_id']) && isset($_POST['b_date']) && isset($_POST['b_time']) && isset($_POST['b_id'])) {
    $ma_id = $_POST['ma_id'];
    $b_date = $_POST['b_date'];
    $b_time = $_POST['b_time'];
    $b_id = $_POST['b_id'];

    // ตรวจสอบการจองที่มีอยู่แล้ว
    $sql = "SELECT * FROM booking 
            WHERE ma_id = '$ma_id' 
            AND b_date = '$b_date' 
            AND b_time = '$b_time' 
            AND b_id != '$b_id'";
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo 'invalid';
    } else {
        echo 'valid';
    }
}
?>
