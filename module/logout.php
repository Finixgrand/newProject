<?php
    session_start();
    unset($_SESSION['valid_uname']);
    unset($_SESSION['valid_upass']);
    unset($_SESSION['valid_utype']);
    echo "<script language=\"javascript\">";
    echo "alert('ออกจากระบบเรียบร้อยแล้ว');";
    echo "window.location = '../frm_login.php';";
    echo "</script>";
    session_destroy();
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