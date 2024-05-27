<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $s_id = $_POST['s_id'];

    $sql = "DELETE FROM service WHERE s_id = '$s_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script language='javascript'>";
        echo "alert('ลบข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = '../showService.php';";
        echo "</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>