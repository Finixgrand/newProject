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
    <title>เพิ่มข้อมูลผู้นวด</title>

</head>

<body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>เพิ่มข้อมูลผู้นวด</h4>
                    </div>
                    <div class="card-body">
                        <form action="module/addmass.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อ - นามสกุล</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">เพศ</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0" required>
                                    <label class="form-check-label" for="gender_male">ชาย</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1" required>
                                    <label class="form-check-label" for="gender_female">หญิง</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">อายุ</label>
                                <input type="number" class="form-control" id="age" name="age" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_card" class="form-label">เลขประจำตัวประชาชน</label>
                                <input type="text" class="form-control" id="id_card" name="id_card" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">ที่อยู่</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="tel" name="tel" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="javascript:history.back()" class="btn btn-secondary">ยกเลิก</a>
                                <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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
