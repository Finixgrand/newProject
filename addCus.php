<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'component/admin_nav.php';
    ?>
    <p>เพิ่มข้อมูลผู้ใช้บริการ</p>
    <form action="module/addcus.php" method="post">
        <table align="center">
            <tr>
                <td>ชื่อ - นามสกุล</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>เพศ</td>
                <td>
                    <input type="radio" name="gender" value="0" required>ชาย
                    <input type="radio" name="gender" value="1" required>หญิง
                </td>
            </tr>
            <tr>
                <td>อายุ</td>
                <td><input type="number" name="age" required></td>
            </tr>
            <tr>
                <td>เลขประจำตัวประชาชน</td>
                <td><input type="text" name="IDcardnumber" required></td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td><textarea name="address" required></textarea></td>
            </tr>
            <tr>
                <td>เบอร์โทรศัพท์</td>
                <td><input type="text" name="tel" required></td>
            </tr>
        </table>
        <br>
        <a href="javascript:history.back()" class="btn">ยกเลิก</a>
        <div align="center"><button type="submit">บันทึกข้อมูล</button></div>
    </form>

</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>