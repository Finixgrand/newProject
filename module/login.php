<?php
    include 'connect.php';
    
    // รับค่าจากฟอร์ม
    $u_name = $_POST['u_name'];
    $u_pass = $_POST['u_pass'];
    
    // ตรวจสอบว่าชื่อผู้ใช้และรหัสผ่านไม่ว่างเปล่า
    if (!empty($u_name) && !empty($u_pass)) {

        // ตรวจสอบผู้ใช้จากฐานข้อมูล
        $sql = "SELECT * FROM user WHERE u_name = '$u_name' AND u_pass = '$u_pass'";
        $result = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($result);

        if ($total > 0) {
            $row = mysqli_fetch_assoc($result);
            $u_type = $row['u_type'];

            session_start();
            $_SESSION['valid_uname'] = $u_name;
            $_SESSION['valid_upass'] = $u_pass;
            $_SESSION['valid_utype'] = $u_type;

            mysqli_close($conn);
            
            if ($u_type == 1) {
                header("Location: ../showProject.php");
                exit();
            } elseif ($u_type == 2) {
                header("Location: ../showBooking.php");
                exit();
            } else {
                echo "<script language=\"javascript\">";
                echo "alert('ประเภทผู้ใช้ไม่ถูกต้อง');";
                echo "window.location = '../frm_login.php';";
                echo "</script>";
                exit();
            }
        } else {
            echo "<script language=\"javascript\">";
            echo "alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');";
            echo "window.location = '../frm_login.php';";
            echo "</script>";
            exit();
        }
    } else {
        echo "<script language=\"javascript\">";
        echo "alert('กรุณากรอกชื่อผู้ใช้และรหัสผ่าน');";
        echo "window.location = '../frm_login.php';";
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