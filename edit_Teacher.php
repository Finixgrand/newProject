<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $t_id = $_GET['t_id'];

    $sql = "SELECT * FROM teacher WHERE t_id = $t_id";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลอาจารย์</title>
</head>
<body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>แก้ไขข้อมูลอาจารย์</h4>
                    </div>
                    <div class="card-body">
                        <form action="module/edit_teacher.php" method="post">
                            <input type="hidden" name="t_id" value="<?php echo $rs['t_id']; ?>">
                            <div class="mb-3">
                                <label for="t_name" class="form-label">ชื่อ - นามสกุล</label>
                                <input type="text" class="form-control" id="t_name" name="t_name" value="<?php echo $rs['t_name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="t_address" class="form-label">ที่อยู่</label>
                                <input type="text" class="form-control" id="t_address" name="t_address" value="<?php echo $rs['t_address']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="t_tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="t_tel" name="t_tel" value="<?php echo $rs['t_tel']; ?>" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
