<?php
include 'module/connect.php';

$p_id = $_GET['p_id'];
$sql = "SELECT * FROM program WHERE p_id = $p_id";
$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
$rs = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/projectdetail.css">
</head>

<body>
    <?php include 'component/admin_nav.php'; ?>
    <div class="headtopic">
        <h4>รายละเอียดโครงการ</h4>
    </div>

    <table align="center" class="tb_detail">
        <tr>
            <td>รหัสโครงการ</td>
            <td>ชื่อโครงการ</td>
            <td>วันที่เริ่ม</td>
            <td>วันที่สิ้นสุด</td>
            <td>ชั่วโมงสะสม</td>
            <td>อาจารย์ผู้คุม</td>
            <td>ผู้นวดในโครงการ</td>
            <td></td>
        </tr>
        <tr>
            <td><?php echo "$rs[p_id]"; ?> <input type="hidden" name="p_id" value="<?php echo "$rs[p_id]"; ?>"></td>
            <td><?php echo "$rs[p_name]"; ?> <input type="hidden" name="p_name" value="<?php echo "$rs[p_name]"; ?>"></td>
            <td><?php echo "$rs[p_start]"; ?> <input type="hidden" name="p_start" value="<?php echo "$rs[p_start]"; ?>"></td>
            <td><?php echo "$rs[p_end]"; ?> <input type="hidden" name="p_end" value="<?php echo "$rs[p_end]"; ?>"></td>
            <td><?php echo "$rs[max_hour]"; ?> <input type="hidden" name="max_hour" value="<?php echo "$rs[max_hour]"; ?>"></td>
            <td><?php echo "$rs[teacher]"; ?> <input type="hidden" name="teacher" value="<?php echo "$rs[teacher]"; ?>"></td>
            <td><?php echo "$rs[total_mass]"; ?> <input type="hidden" name="total_mass" value="<?php echo "$rs[total_mass]"; ?>"></td>
            <td><button name="btn_Edit">แก้ไข</button> &nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="del()">ลบ</button>
            </td>
        </tr>
    </table>
    <br>
    

    <script>
        // ปุ่มแก้ไข ส่ง p_id เพื่อไปหน้า editproject.php
        var btn_Edit = document.getElementsByName("btn_Edit")[0];

        btn_Edit.addEventListener("click", function(event) {
            event.preventDefault();
            var p_id = document.querySelector("input[name='p_id']").value;
            document.location.href = "editProject.php?p_id=" + p_id;
        });
    </script>

    <script>
        // ปุ่มลบ ส่ง p_id เพื่อไปหน้า deleteproject.php
        function del() {
            var p_id = document.querySelector("input[name='p_id']").value;
            var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
            if (conf) {
                document.location.href = "module/deleteproject.php?p_id=" + p_id;
            }
        }
    </script>

<div>
    <h5>รายการจอง</h5>

    
    <div align="right">
        <button>เพิ่มการจอง</button>
        </div>
        <br>
        <div align="center">
        <label for="bookingDate">วันที่จอง:</label>
        <input type="date" id="bookingDate" name="bookingDate">
        </div>
    <br>
    <table class="table table-bordered">
        <tr>
           <th>ลำดับที่</th>
              <th>ชื่อ-นามสกุล</th>
                <th>เวลาที่จอง</th>
                <th>ผู้นวด</th>
                <th>หมายเหตุ</th>
                <th>สถานะ</th>
                <th></th>
        </tr>
        <tr>
            <td>1</td>
            <td>นาย สมชาย ใจดี</td>
            <td>12.00-13.00</td>
            <td>มาสาย</td>
            <td>มาสวย</td>
            <td>ยืนยัน</td>
            <td><button>ยืนยันการใช้บริการ</button></td>
                
        </tr>
    </table>
    </div>

    <div align="center"> <!-- ย้อนกลับ ปุ่มแก้ไข ลบ -->
        <button onclick="window.history.back();">กลับ</button> &nbsp;&nbsp;&nbsp;&nbsp;
    </div>
</body>

</html>