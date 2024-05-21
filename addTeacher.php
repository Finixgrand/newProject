<?php
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
    <h2 class="mb-4">เพิ่มอาจารย์</h2>
    <main>
        <form action="module/addteacher.php" method="post">
            <table align="center">
                <tr>
                    <td>ชื่อ - นามสกุล</td>
                    <td><input type="text" name="t_name"></td>
                </tr>
                <tr>
                    <td>ที่อยู่</td>
                    <td><input type="text" name="t_address"></td>
                </tr>
                <tr>
                    <td>เบอร์โทรศัพท์</td>
                    <td><input type="text" name="t_tel"></td>
                </tr>
            </table>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </main>

</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>