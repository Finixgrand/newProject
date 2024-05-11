<?php
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
    <p>เพิ่มข้อมูลผู้นวด</p>
    <form action="module/addmass.php" method="post">
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
                <td><input type="text" name="id_card" required></td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td><textarea name="address" required></textarea></td>
            </tr>
            <tr>
                <td>เบอร์โทรศัพท์</td>
                <td><input type="text" name="tel" required></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><button type="submit">บันทึกข้อมูล</button></td>
            </tr>
        </table>
    </form>

</body>

</html>