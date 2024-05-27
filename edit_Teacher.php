<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $t_id = $_GET['t_id'];

    $sql = "SELECT * FROM teacher WHERE t_id = $t_id";

    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);

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

    <h2 class="mb-4">แก้ไขข้อมูลอาจารย์</h2>

    <div>
        <form action="module/edit_teacher.php" method="post">
        <input type="hidden" name="t_id" value="<?php echo $rs['t_id']; ?>">
        <table>
            <thead>
                <tr>
                    <th>ชื่อ - นามสกุล</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทรศัพท์</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="t_name" value="<?php echo $rs['t_name'] ?>" required></td>
                    <td><input type="text" name="t_address" value="<?php echo $rs['t_address'] ?>" required></td>
                    <td><input type="text" name="t_tel" value="<?php echo $rs['t_tel'] ?>" required></td>
                </tr>
        </table>

        
        <div class="text-center mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
            <button type="submit" class="btn btn-primary">บันทึก</button>
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
