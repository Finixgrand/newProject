<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';
    
    $ma_id = $_POST['ma_id'];
    $ma_name = $_POST['ma_name'];
    $ma_gender = $_POST['ma_gender'];
    $ma_age = $_POST['ma_age'];
    $ma_id_card = $_POST['ma_id_card'];
    $ma_address = $_POST['ma_address'];
    $ma_tel = $_POST['ma_tel'];

    $sql = "UPDATE masseuse SET ma_name = '$ma_name', ma_gender = '$ma_gender', 
    ma_age = '$ma_age', ma_card = '$ma_id_card', ma_address = '$ma_address', 
    ma_tel = '$ma_tel' WHERE ma_id = '$ma_id'";

    $row = mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    if($row) {
        echo "<script language=\"javascript\">";
        echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = '../showMass.php';";
        echo "</script>";
    } else {
        echo "<script language=\"javascript\">";
        echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
        echo "window.location = '../showMass.php';";
        echo "</script>";
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