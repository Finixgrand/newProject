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
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>รหัสผ่าน</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>ชื่อ - นามสกุล</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>เพศ</td>
                <td>
                    <input type="radio" value="0" name="gender">ชาย
                    <input type="radio" value="1" name="gender">หญิง
                </td>
            </tr>
            <tr>
                <td>อายุ</td>
                <td><input type="number" name="age"></td>
            </tr>
            <tr>
                <td>เลขประจำตัวประชาชน</td>
                <td><input type="text" name="IDcardnumber"></td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td><textarea name="address"></textarea></td>
            </tr>
            <tr>
                <td>เบอร์โทรศัพท์</td>
                <td><input type="text" name="tel"></td>
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