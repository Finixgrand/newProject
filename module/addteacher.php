<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $t_name = $_POST['t_name'];
    $t_address = $_POST['t_address'];
    $t_tel = $_POST['t_tel'];

    $sql = "INSERT INTO teacher (t_name, t_address, t_tel) VALUES ('$t_name', '$t_address', '$t_tel')";

    $result = mysqli_query($conn, $sql) 
        or die("Error in query: $sql " . mysqli_error($conn));

    if ($result) {
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ'); location.href='../showTeacher.php';</script>";
    } else {
        echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ'); location.href='../addTeacher.php';</script>";
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
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>