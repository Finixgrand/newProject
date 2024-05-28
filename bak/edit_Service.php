<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $s_id = $_GET['s_id'];

    $sql = "SELECT * FROM service WHERE s_id = $s_id";

    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขประเภทการให้บริการ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<?php include 'component/admin_nav.php'; ?>

<div class="container mt-5">
    <h4 class="text-center mb-4">แก้ไขประเภทการให้บริการ</h4>
    <form action="module/edit_service.php" method="post">
        <div class="mb-3">
            <label for="s_name" class="form-label">ชื่อโครงการ</label>
            <input type="text" class="form-control" id="s_name" name="s_name" value="<?php echo $rs['s_name']; ?>">
            <input type="hidden" name="s_id" value="<?php echo $rs['s_id']; ?>">
        </div>
        <div class="text-center">
            <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
            <button type="submit" class="btn btn-success" name="btn_save">บันทึก</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
