<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $sql = "SELECT * FROM masseuse";
    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้นวด</title>
    <style>
        .table-container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container table-container">
        <h3 class="text-center">ข้อมูลผู้นวด</h3>

        <div class="d-flex justify-content-between mb-3">
            <h4>รายชื่อผู้นวด</h4>
            <a href="./addMass.php" class="btn btn-primary">เพิ่มผู้นวด</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ลำดับ</th>
                    <th scope="col" class="text-center">ชื่อ - นามสกุล</th>
                    <th scope="col" class="text-center">เพศ</th>
                    <th scope="col" class="text-center">รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rs = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td class="text-center"><?php echo $rs['ma_id']; ?></td>
                    <td><?php echo $rs['ma_name']; ?></td>
                    <td class="text-center">
                        <input type="hidden" name="gender" value="<?php echo $rs['ma_gender']; ?>">
                        <?php echo ($rs['ma_gender'] == 0) ? "ชาย" : "หญิง"; ?>
                    </td>
                    <td class="text-center">
                        <button name="btn_detail" class="btn btn-info">รายละเอียด</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        document.querySelectorAll("[name='btn_detail']").forEach(btn => {
            btn.addEventListener("click", function() {
                const ma_id = btn.closest("tr").querySelector("td").innerText;
                document.location.href = "massDetail.php?ma_id=" + ma_id;
            });
        });
    </script>
</body>

</html>
<?php
    mysqli_close($conn);
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
