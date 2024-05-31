<?php
include 'connect.php';
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {

    if (isset($_POST['b_id']) && isset($_POST['ma_id'])) {
        $b_id = $_POST['b_id'];
        $ma_id = $_POST['ma_id'];

        $sql = "UPDATE booking SET ma_id = '$ma_id', b_status = 1 WHERE b_id = '$b_id'";

        if (mysqli_query($conn, $sql)) {
            echo 'success';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "b_id or ma_id not set in the POST request";
    }

    mysqli_close($conn);

} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
