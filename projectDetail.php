<?php
include 'module/connect.php';

$p_id = $_GET['p_id'];

$sql = "SELECT program.*, teacher.t_name FROM program 
        LEFT JOIN teacher ON program.t_id = teacher.t_id 
        WHERE p_id = $p_id";

$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
$rs = mysqli_fetch_array($result);
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
                        <th>ชั่วโมงสะสม</th>
                        <th>อาจารย์ผู้คุม</th>
                        <th>ผู้นวดในโครงการ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $rs['p_id']; ?></td>
                        <td><?php echo $rs['p_name']; ?></td>
                        <td><?php echo $rs['p_start']; ?></td>
                        <td><?php echo $rs['p_end']; ?></td>
                        <td><?php echo $rs['max_hour']; ?></td>
                        <td><?php echo $rs['t_name']; ?></td>
                        <td><?php echo $rs['total_mass']; ?></td>
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
            <button class="btn btn-success">เพิ่มการจอง</button>
        </div>
        <div class="text-center">
            <label for="bookingDate">วันที่จอง:</label>
            <input type="date" id="bookingDate" name="bookingDate" class="form-control d-inline w-auto">
        </div>
        <div class="table-responsive-sm mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ประเภทที่มาใช้บริการ</th>
                        <th>เวลาที่จอง</th>
                        <th>ผู้นวด</th>
                        <th>หมายเหตุ</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>นาย สมชาย ใจดี</td>
                        <td>นวดพุง</td>
                        <td>12.00-13.00</td>
                        <td>มาสาย</td>
                        <td>มาสวย</td>
                        <td>ยืนยัน</td>
                        <td><button class="btn btn-primary">ยืนยันการใช้บริการ</button> <button class="btn btn-secondary" onclick="printPage(<?php echo $cus_id; ?>)">พิมพ์</button></td>
                    </tr>
                </tbody>
            </table>
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