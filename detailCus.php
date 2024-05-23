<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    if (isset($_GET['cus_ids'])) {
        $cus_ids = explode(',', $_GET['cus_ids']);
        $cus_ids_str = implode(',', array_map('intval', $cus_ids));

        $sql = "SELECT * FROM customer WHERE cus_id IN ($cus_ids_str)";
        $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

        $sql2 = "SELECT booking.*, service.s_name FROM booking
                 JOIN service ON booking.s_id = service.s_id
                 WHERE booking.cus_id IN ($cus_ids_str)";
        $result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" type="text/css" href="css/detailcus.css">
        </head>

        <body>
            <?php
            include 'component/admin_nav.php';
            ?>

            <main>
                <h2 class="mb-4">ข้อมูลผู้ใช้บริการ</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อผู้ใช้บริการ</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>เพศ</th>
                                <th>อายุ</th>
                                <th>เลขประจำตัวประชาชน</th>
                                <th>ที่อยู่</th>
                                <th>เบอร์โทรศัพท์</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($rs = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $rs['cus_id']; ?></td>
                                    <td><?php echo $rs['u_name'] ? $rs['u_name'] : 'Walkin'; ?></td>
                                    <td><?php echo $rs['name']; ?></td>
                                    <td><?php echo $rs['gender'] == 0 ? 'ชาย' : 'หญิง'; ?></td>
                                    <td><?php echo $rs['age']; ?></td>
                                    <td><?php echo $rs['IDcardnumber']; ?></td>
                                    <td><?php echo $rs['address']; ?></td>
                                    <td><?php echo $rs['tel']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button onclick="window.history.back();" class="btn btn-secondary mr-2">กลับ</button>
                    <button name="btn_Edit" class="btn btn-primary mr-2">แก้ไข</button>
                    <button onclick="del()" class="btn btn-danger">ลบ</button>
                </div>

                <br>

                <script>
                    var btn_Edit = document.getElementsByName("btn_Edit")[0];
                    btn_Edit.addEventListener("click", function(event) {
                        event.preventDefault();
                        var cus_ids = "<?php echo implode(',', $cus_ids); ?>";
                        document.location.href = "editCus.php?cus_ids=" + cus_ids;
                    });
                </script>

                <script>
                    function del() {
                        if (confirm("ยืนยันการลบข้อมูล")) {
                            var cus_ids = "<?php echo implode(',', $cus_ids); ?>";
                            document.location.href = "module/deletecus.php?cus_ids=" + cus_ids;
                        }
                    }
                </script>

                <div class="container">
                    <h5>ประวัติการใช้บริการ</h5>
                    <div class="table-responsive-sm mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>วันที่ใช้บริการ</th>
                                    <th>ประเภทที่มาใช้บริการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($rs2 = mysqli_fetch_array($result2)) {
                                ?>
                                    <tr>
                                        <td><?php echo $rs2['b_date']; ?></td>
                                        <td><?php echo $rs2['s_name']; ?></td>
                                    </tr>
                                <?php
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </body>

        </html>
<?php
    } else {
        echo "No customer IDs provided.";
    }
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
