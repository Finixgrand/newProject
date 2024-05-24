<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div>
        <form action="module/register.php" method="post">
        <table align="center">
            <tr>
                <th colspan="2">สมัครสมาชิก</th>
            </tr>
            <tr>
                <td>ชื่อผู้ใช้</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>รหัสผ่าน</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>ชื่อ - นามสกุล</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>เพศ</td>
                <td>
                    <input type="radio" value="0" name="gender" required>ชาย
                    <input type="radio" value="1" name="gender" required>หญิง
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

        <div align="center">
            <a href="javascript:history.back()" class="btn">ยกเลิก</a>
            <button type="submit">สมัครสมาชิก</button>
        </div>

        </form>


    </div>
</body>

</html>