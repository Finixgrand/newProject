<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $t_id = $_GET['t_id']; // Changed from $_POST to $_GET

    $sql = "DELETE FROM teacher WHERE t_id = '$t_id'";

    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

    if ($result) {
        echo "<script>alert('การลบสำเร็จ'); window.location='../showteacher.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลบ'); window.location='../showteacher.php';</script>";
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