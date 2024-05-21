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

    <h4 align="center">เพิ่มบริการ</h4>
    <br>
 <div align="center">
    <form action="module/addservice.php" method="post">
        <table align="center">
            <tr>
                <td>ชื่อบริการ</td>
            </tr>
            <tr>
                <td><input type="text" name="s_name" required></td>
            </tr>
        </table>
<br>
        <div align="center">
            <button type="submit">เพิ่มบริการ</button>
        </div>
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