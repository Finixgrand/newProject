<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $u_name = $_GET['u_name'];
    
    $sql = "SELECT * FROM customer WHERE u_name = '$u_name'";
    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));

    $rs = mysqli_fetch_array($result);
    $cus_id = $rs['cus_id']; // Fetch the cus_id

    $sql2 = "SELECT * FROM booking, queue_table, program, masseuse
    WHERE booking.qt_id = queue_table.qt_id 
    AND queue_table.p_id = program.p_id 
    AND booking.ma_id = masseuse.ma_id
    AND u_name = '$u_name'";
 

    $result2 = mysqli_query($conn, $sql2) 
        or die("Error in query: $sql2 " . mysqli_error($conn));
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
                                // Using $rs fetched from previous query
                            ?>
                                <tr>
                                    <td><?php echo $rs['u_name'] ? $rs['u_name'] : 'Walkin'; ?></td>
                                    <td><?php echo $rs['name']; ?></td>
                                    <td><?php echo $rs['gender'] == 0 ? 'ชาย' : 'หญิง'; ?></td>
                                    <td><?php echo $rs['age']; ?></td>
                                    <td><?php echo $rs['IDcardnumber']; ?></td>
                                    <td><?php echo $rs['address']; ?></td>
                                    <td><?php echo $rs['tel']; ?></td>
                                </tr>
                            <?php
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                <a href="showCus.php" class="btn btn-secondary">ย้อนกลับ</a>
                    <button id="btn_Edit" class="btn btn-primary mr-2">แก้ไข</button>
                    <button onclick="del(<?php echo $cus_id; ?>)" class="btn btn-danger">ลบ</button>
                </div>

                <br>

                <script>
                    var btn_Edit = document.getElementById("btn_Edit");
                    btn_Edit.addEventListener("click", function() {
                        var cus_id = "<?php echo $cus_id; ?>";
                        document.location.href = "editCus.php?cus_id=" + cus_id;
                    });

                    function del(cus_id) {
                        var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
                        if (conf) {
                            document.location.href = "module/deletecus.php?cus_id=" + cus_id;
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
                                    <th>ผู้นวด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($rs2 = mysqli_fetch_array($result2)) {
                                ?>
                                    <tr>
                                        <td><?php echo $rs2['b_date']; ?></td>
                                        <td><?php echo $rs2['p_name']; ?></td>
                                        <td><?php echo $rs2['ma_name']; ?></td>
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
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
