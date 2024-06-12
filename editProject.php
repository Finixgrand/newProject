<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $p_id = $_GET['p_id'];

    $sql = "SELECT * FROM program WHERE p_id = $p_id";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/editproject.css">
</head>

<body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>แก้ไขโครงการ</h4>
                    </div>
                    <div class="card-body">
                        <form action="module/editproject.php" method="post">
                            <div class="mb-3">
                                <label for="p_id" class="form-label">รหัสโครงการ</label>
                                <input type="text" class="form-control" id="p_id" value="<?php echo "$rs[p_id]"; ?>" disabled>
                                <input type="hidden" name="p_id" value="<?php echo "$rs[p_id]"; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="p_name" class="form-label">ชื่อโครงการ</label>
                                <input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo "$rs[p_name]"; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="p_start" class="form-label">วันที่เริ่ม</label>
                                <input type="date" class="form-control" id="p_start" name="p_start" value="<?php echo "$rs[p_start]"; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="p_end" class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" class="form-control" id="p_end" name="p_end" value="<?php echo "$rs[p_end]"; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="t_id" class="form-label">อาจารย์ผู้คุม</label>
                                <select class="form-select" name="t_id" id="t_id">
                                    <?php
                                    $sql2 = "SELECT * FROM teacher";
                                    $result2 = mysqli_query($conn, $sql2);
                                    while ($rs2 = mysqli_fetch_array($result2)) {
                                        echo "<option value=\"{$rs2['t_id']}\"";
                                        if ($rs['t_id'] == $rs2['t_id']) {
                                            echo ' selected';
                                        }
                                        echo ">{$rs2['t_name']}</option>\n";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="javascript:history.back()" class="btn btn-secondary">ยกเลิก</a>
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
