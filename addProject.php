<?php
    include 'module/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/addProject.css">
</head>
<?php
    include 'component/admin_nav.php';
?>
<body>
    <div>
        <form action="module/addproject.php" method="post">
            <table align="center">
                <tr>
                    <th>เพิ่มโครงการ</th>
                </tr>
                <tr>
                    <td>ชื่อโครงการ</td>
                    <td><input type="text" name="p_name"></td>
                </tr>
                <tr>
                    <td>วันที่เริ่ม</td>
                    <td><input type="date" name="p_start"></td>
                </tr>
                <tr>
                    <td>วันที่สิ้นสุด</td>
                    <td><input type="date" name="p_end"></td>
                </tr>
                <tr>
                    <td>ชั่วโมงสะสม</td>
                    <td><input type="text" name="max_hour"></td>
                </tr>
                <tr>
                    <td>อาจารย์ผู้คุม</td>
                    <td><input type="text" name="teacher"></td>
                </tr>
                <tr>
                    <td>จำนวนผู้นวดในโครงการ</td>
                    <td><input type="text" name="total_mass"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="เพิ่ม"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>