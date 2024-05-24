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
                    <td><input type="text" name="p_name" required></td>
                </tr>
                <tr>
                    <td>วันที่เริ่ม</td>
                    <td><input type="date" name="p_start" required></td>
                </tr>
                <tr>
                    <td>วันที่สิ้นสุด</td>
                    <td><input type="date" name="p_end" required></td>
                </tr>
                <tr>
                    <td>
                        อาจารย์ผู้คุม
                    </td>
                    <td>
                        <select name="t_id" id="t_id">
                            <?php 
                                $sql = "SELECT * FROM teacher";
                                $result = mysqli_query($conn, $sql);
                                while ($rs = mysqli_fetch_array($result)) {
                                    echo "<option value='$rs[t_id]'>$rs[t_name]</option>";
                                }
                            ?>
                            </select>
                    </td>
                </tr>
                
                <tr>
                    <td>อาจารย์ผู้คุม</td>
                    <td><input type="text" name="teacher" required></td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="เพิ่ม"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>