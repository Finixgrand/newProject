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
    <div class="headtopic"><h4>รายละเอียดโครงการ</h4></div>

    <table align="center" class="tb_detail">
        <tr>
            <td>รหัสโครงการ</td>
            <td><?php echo "$rs[p_id]"; ?> <input type="hidden" name="p_id" value="<?php echo "$rs[p_id]"; ?>"></td>
        </tr>
        <tr>
            <td>ชื่อโครงการ</td>
            <td><?php echo "$rs[p_name]"; ?> <input type="hidden" name="p_name" value="<?php echo "$rs[p_name]"; ?>"></td>
        </tr>
        <tr>
            <td>วันที่เริ่ม</td>
            <td><?php echo "$rs[p_start]"; ?> <input type="hidden" name="p_start" value="<?php echo "$rs[p_start]"; ?>"></td>
        </tr>
        <tr>
            <td>วันที่สิ้นสุด</td>
            <td><?php echo "$rs[p_end]"; ?> <input type="hidden" name="p_end" value="<?php echo "$rs[p_end]"; ?>"></td>
        </tr>
        <tr>
            <td>ชั่วโมงสะสม</td>
            <td><?php echo "$rs[max_hour]"; ?> <input type="hidden" name="max_hour" value="<?php echo "$rs[max_hour]"; ?>"></td>
        </tr>
        <tr>
            <td>อาจารย์ผู้คุม</td>
            <td><?php echo "$rs[teacher]"; ?> <input type="hidden" name="teacher" value="<?php echo "$rs[teacher]"; ?>"></td>
        </tr>
        <tr>
            <td>ผู้นวดในโครงการ</td>
            <td><?php echo "$rs[total_mass]"; ?> <input type="hidden" name="total_mass" value="<?php echo "$rs[total_mass]"; ?>"></td>
        </tr>
    </table>
    <br>
    <div align="center"> <!-- ย้อนกลับ ปุ่มแก้ไข ลบ -->
    <button onclick="window.history.back();">กลับ</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <button name="btn_Edit">แก้ไข</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <button onclick="del()">ลบ</button>
    </div>

    <script> // ปุ่มแก้ไข ส่ง p_id เพื่อไปหน้า editproject.php
    var btn_Edit = document.getElementsByName("btn_Edit")[0];
    
    btn_Edit.addEventListener("click", function(event) {
        event.preventDefault();
        var p_id = document.querySelector("input[name='p_id']").value;
        document.location.href = "editProject.php?p_id=" + p_id;
    });
    </script>

    <script> // ปุ่มลบ ส่ง p_id เพื่อไปหน้า deleteproject.php
    function del() {
        var p_id = document.querySelector("input[name='p_id']").value;
        var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
        if(conf) {
            document.location.href = "module/deleteproject.php?p_id=" + p_id;
        }
    }
    </script>
</body>
</html>