<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $p_id = $_GET['p_id'];

    $sql = "DELETE FROM program WHERE p_id = '$p_id'";

    mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    echo "<script language=\"javascript\">";
    echo "alert('ลบข้อมูลเรียบร้อยแล้ว');";
    echo "window.location = '../showProject.php';";
    echo "</script>";
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