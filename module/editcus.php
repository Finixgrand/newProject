<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';


    $cus_id = $_POST['cus_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $IDcardnumber = $_POST['IDcardnumber'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $u_name = $_POST['u_name'];
    $u_pass = $_POST['u_pass'];

    $sql = "UPDATE customer SET name = '$name', gender = '$gender', age = '$age', 
    IDcardnumber = '$IDcardnumber', address = '$address', tel = '$tel' 
    WHERE cus_id = '$cus_id'";
   
    if($conn->query($sql) === TRUE) {
        $sql_user = "UPDATE user SET u_pass = '$u_pass' WHERE u_name = '$u_name'";
        if($conn->query($sql_user) === TRUE){
            echo "<script language=\"javascript\">";
            echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
            echo "window.location = '../showCus.php';";
            echo "</script>";
        } else {
            echo "<script language=\"javascript\">";
            echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
            echo "window.location = '../showCus.php';";
            echo "</script>";
        }
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