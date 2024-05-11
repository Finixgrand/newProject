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
        <table>
            <tr>
                <td>ชื่อ - นามสกุล</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>เพศ</td>
                <td>
                    <input type="radio">ชาย
</table>
</form>

</body>
</html>