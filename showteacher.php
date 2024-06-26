<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $sql = "SELECT * FROM teacher";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>
        <h3 class="mb-4">รายชื่ออาจารย์</h3>

        <main>
            <div class="table-responsive">
                <div class="container">
                    <a href="addTeacher.php" class="btn btn-primary mb-3">เพิ่มอาจารย์</a>
                    <table class="table table-striped">
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>ที่อยู่</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php while ($rs = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($rs['t_id']); ?>
                                    <input type="hidden" name="t_id" value="<?php echo htmlspecialchars($rs['t_id']); ?>">
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($rs['t_name']); ?>
                                    <input type="hidden" name="t_name" value="<?php echo htmlspecialchars($rs['t_name']); ?>">
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($rs['t_address']); ?>
                                    <input type="hidden" name="t_address" value="<?php echo htmlspecialchars($rs['t_address']); ?>">
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($rs['t_tel']); ?>
                                    <input type="hidden" name="t_tel" value="<?php echo htmlspecialchars($rs['t_tel']); ?>">
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-edit" name="btn_edit" data-id="<?php echo $rs['t_id']; ?>">แก้ไข</button>
                                    <button class="btn btn-danger btn-delete" data-id="<?php echo $rs['t_id']; ?>">ลบ</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </main>


        <script>
            // ปุ่มแก้ไข ส่ง t_id เพื่อไปหน้า edit_teacher.php
            document.querySelectorAll('.btn-edit').forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    var t_id = this.getAttribute('data-id');
                    document.location.href = "edit_Teacher.php?t_id=" + t_id;
                });
            });

            // ปุ่มลบ ส่ง t_id เพื่อไปหน้า delete_teacher.php
            document.querySelectorAll('.btn-delete').forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
                    if (conf) {
                        var t_id = this.getAttribute('data-id');
                        document.location.href = "module/delete_teacher.php?t_id=" + t_id;
                    }
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