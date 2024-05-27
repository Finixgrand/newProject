<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $t_id = $_POST['t_id'];
    $t_name = $_POST['t_name'];
    $t_address = $_POST['t_address'];
    $t_tel = $_POST['t_tel'];

    $sql = "UPDATE teacher SET t_name = '$t_name', t_address = '$t_address', t_tel = '$t_tel' WHERE t_id = $t_id";

    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

    if ($result) {
        echo "<script>alert('การแก้ไขสำเร็จ'); window.location='../showteacher.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไข'); window.location='../showteacher.php';</script>";
    }
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
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
