<?php
include 'module/connect.php';
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    $p_id = $_GET['p_id'];

    $sql = "SELECT program.*, teacher.t_name FROM program 
        LEFT JOIN teacher ON program.t_id = teacher.t_id 
        WHERE p_id = $p_id";

    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);


    $sql2 = "SELECT * FROM booking 
JOIN customer ON booking.cus_id = customer.cus_id 
JOIN service ON booking.s_id = service.s_id 
Left JOIN program ON service.s_id = program.s_id
ORDER BY booking.b_date ASC";

    $result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>รายละเอียดโครงการ</title>
        <link rel="stylesheet" type="text/css" href="css/projectdetail.css?v=1">

    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>

        <div class="headtopic">
            <h4>รายละเอียดโครงการ</h4>
        </div>

        <div class="container">
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>รหัสโครงการ</th>
                            <th>ชื่อโครงการ</th>
                            <th>วันที่เริ่ม</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>อาจารย์ผู้คุม</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $rs['p_id']; ?></td>
                            <td><?php echo $rs['p_name']; ?></td>
                            <td><?php echo $rs['p_start']; ?></td>
                            <td><?php echo $rs['p_end']; ?></td>
                            <td><?php echo $rs['t_name']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-edit" name="btn_Edit">แก้ไข</button>
                                <button class="btn btn-danger btn-delete" onclick="del()">ลบ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <script>
            // ปุ่มแก้ไข ส่ง p_id เพื่อไปหน้า editproject.php
            document.querySelector('.btn-edit').addEventListener('click', function(event) {
                event.preventDefault();
                var p_id = <?php echo json_encode($rs['p_id']); ?>;
                document.location.href = "editProject.php?p_id=" + p_id;
            });

            // ปุ่มลบ ส่ง p_id เพื่อไปหน้า deleteproject.php
            function del() {
                var p_id = <?php echo json_encode($rs['p_id']); ?>;
                var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
                if (conf) {
                    document.location.href = "module/deleteproject.php?p_id=" + p_id;
                }
            }
        </script>


        <?php

        ?>
        <div class="container booking-section">
            <h5>รายการจอง</h5>
            <div class="text-end">
            <a href="add_Queue_admin.php?p_id=<?php echo $p_id; ?>" class="btn btn-success">เพิ่มการจอง</a>
            </div>

            <div class="table-responsive-sm mt-3">

                <form action="" method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>อายุ</th>
                                <th>ประเภทที่มาใช้บริการ</th>
                                <th>เวลาที่จอง</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($rs2 = mysqli_fetch_array($result2)) {
                                $cus_id = $rs2['cus_id'];
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $rs2['b_date'] ?>
                                    </td>
                                    <td>
                                        <?php echo $rs2['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $rs2['age'] ?>
                                    </td>
                                    <td>
                                        <?php echo $rs2['s_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $rs2['b_time'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="b_time" value="<?php echo $rs2['b_time']; ?>">
                                        <input type="hidden" name="s_name" value="<?php echo $rs2['s_name']; ?>">
                                        <input type="hidden" name="cus_id" value="<?php echo $rs2['cus_id']; ?>">
                                        <input type="hidden" name="age" value="<?php echo $rs2['age']; ?>">
                                        <input type="hidden" name="name" value="<?php echo $rs2['name']; ?>">
                                        <input type="hidden" name="p_id" value="<?php echo $rs2['p_id']; ?>">
                                        <input type="hidden" name="address" value="<?php echo $rs2['address']; ?>">
                                        <input type="hidden" name="tel" value="<?php echo $rs2['tel']; ?>">
                                        <input type="hidden" name="gender" value="<?php echo $rs2['gender']; ?>">
                                        <button type="submit" onclick="printPage('<?php echo $rs2['cus_id']; ?>')">พิมพ์</button>
                                    </td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <div class="text-center my-4">
            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        </div>

        <script>
            function printPage(cus_id) {
                var win = window.open('print.php?cus_id=' + cus_id, '_blank');
                win.focus();
                win.onload = function() {
                    win.print();
                }
            }
        </script>


    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>