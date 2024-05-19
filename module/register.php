<?php
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$IDcardnumber = $_POST['IDcardnumber'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$user_type = 2;

$sql_user = "INSERT INTO user (u_name, u_pass, u_type) VALUES ('$username', '$password', '$user_type')";
if ($conn->query($sql_user) === TRUE) {
    // รับค่า u_id จากการ Insert
    $u_id = $conn->insert_id;

    // Insert ลงตาราง customer
    $sql_customer = "INSERT INTO customer (IDcardnumber, name, address, tel, age, gender, u_id) 
                     VALUES ('$IDcardnumber', '$name', '$address', '$tel', '$age', '$gender', '$u_id')";
    if ($conn->query($sql_customer) === TRUE) {
        echo "<script language=\"javascript\">";
        echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = '../frm_login.php';";
        echo "</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();

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