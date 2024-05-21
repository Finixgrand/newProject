<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

$sql = "SELECT * FROM service";
$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
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

    <h4 align="center">ประเภทการให้บริการ</h4>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sd-12">
                <div class="d-flex justify-content-end">
                    <a href="addService.php" class="btn btn-primary">เพิ่มประเภทบริการ</a>
                </div>
                <br>
                <div align="center">
                    <table class="table">
                        <tr>
                            <td>
                                ลำดับที่
                            </td>
                            <td>
                                ชื่อบริการ
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <?php
                        while ($rs = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $rs['s_id'] ?>
                                </td>
                                <td>
                                    <?php echo $rs['s_name']; ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-edit" name="btn_edit" data-id="<?php echo $rs['s_id']; ?>">แก้ไข</button>
                                    <button class="btn btn-danger btn-delete" data-id="<?php echo $rs['s_id']; ?>">ลบ</button>
                                </td>
                            </tr>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ปุ่มแก้ไข ส่ง s_id เพื่อไปหน้า editservice.php
        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                var s_id = this.getAttribute('data-id');
                document.location.href = "editService.php?s_id=" + s_id;
            });
        });

        // ปุ่มลบ ส่ง s_id เพื่อไปหน้า deleteservice.php
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
                if (conf) {
                    var s_id = this.getAttribute('data-id');
                    document.location.href = "module/deleteservice.php?s_id=" + s_id;
                }
            });
        });
    </script>
</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>