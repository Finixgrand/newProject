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

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$user_type = mysqli_real_escape_string($conn, $user_type);

// ตรวจสอบว่ามี u_name ซ้ำหรือไม่
$sql_check_username = "SELECT u_name FROM user WHERE u_name = '$username'";
$result = $conn->query($sql_check_username);

if ($result->num_rows > 0) {
    // ถ้า u_name ซ้ำ
    echo "<script language=\"javascript\">";
    echo "alert('ชื่อผู้ใช้นี้มีอยู่แล้ว กรุณาใช้ชื่อผู้ใช้อื่น');";
    echo "window.location = '../register.php';";
    echo "</script>";
} else {
    // ถ้า u_name ไม่ซ้ำ ให้ทำการแทรกข้อมูล
    $sql_user = "INSERT INTO user (u_name, u_pass, u_type) VALUES ('$username', '$password', '$user_type')";
    if ($conn->query($sql_user) === TRUE) {
        // Insert ลงตาราง customer
        $sql_customer = "INSERT INTO customer (IDcardnumber, name, address, tel, age, gender, u_name) 
                         VALUES ('$IDcardnumber', '$name', '$address', '$tel', '$age', '$gender', '$username')";
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
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
