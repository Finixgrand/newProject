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
    <title>เพิ่มโครงการ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/addProject.css">
</head>
<?php
    include 'component/admin_nav.php';
?>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>เพิ่มโครงการ</h4>
                    </div>
                    <div class="card-body">
                        <form action="module/addproject.php" method="post">
                            <div class="mb-3">
                                <label for="p_name" class="form-label">ชื่อโครงการ</label>
                                <input type="text" name="p_name" id="p_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="p_start" class="form-label">วันที่เริ่ม</label>
                                <input type="date" name="p_start" id="p_start" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="p_end" class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" name="p_end" id="p_end" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="t_id" class="form-label">อาจารย์ผู้คุม</label>
                                <select name="t_id" id="t_id" class="form-select">
                                    <?php 
                                        $sql = "SELECT * FROM teacher";
                                        $result = mysqli_query($conn, $sql);
                                        while ($rs = mysqli_fetch_array($result)) {
                                            echo "<option value='$rs[t_id]'>$rs[t_name]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">เพิ่ม</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
