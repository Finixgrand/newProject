<?php
include 'module/connect.php';

$sql = "SELECT * FROM customer WHERE cus_id = $_GET[cus_id]";
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
</head>

<body>
    <?php
    include 'component/admin_nav.php';
    ?>

    <p>ข้อมูลผู้ใช้บริการ</p>

    <main>
        <table>
            <tr>
                <td>รหัส</td>
                <td><?php echo "$rs[cus_id]"; ?> <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>"></td>
            </tr>
            <tr>
                <td>ชื่อ - นามสกุล</td>
                <td><?php echo "$rs[name]"; ?></td>
            </tr>
            <tr>
                <td>เพศ</td>
                <td><?php if ($rs['gender']==0) echo "ชาย";
                    else echo "หญิง"; ?></td>
            </tr>
            <tr>
                <td>อายุ</td>
                <td><?php echo "$rs[age]"; ?></td>
            </tr>
            <tr>
                <td>เลขประจำตัวประชาชน</td>
                <td><?php echo "$rs[IDcardnumber]"; ?></td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td><?php echo "$rs[address]"; ?></td>
            </tr>
            <tr>
                <td>เบอร์โทรศัพท์</td>
                <td><?php echo "$rs[tel]"; ?></td>
            </tr>
        </table>

        <br>
        <div align="center"> <!-- ปุ่มย้อนกลับ แก้ไข ลบ -->
            <button onclick="window.history.back();">กลับ</button> &nbsp;&nbsp;&nbsp;&nbsp;
            <button name="btn_Edit">แก้ไข</button> &nbsp;&nbsp;&nbsp;&nbsp;
            <button onclick="del()">ลบ</button>
        </div>

        <script>
            var btn_Edit = document.getElementsByName("btn_Edit")[0];
            btn_Edit.addEventListener("click", function(event) {
                event.preventDefault();
                var cus_id = document.querySelector("input[name='cus_id']").value;
                document.location.href = "editCus.php?cus_id=" + cus_id;
            });
        </script>

        <script>
            function del() {
                if (confirm("ยืนยันการลบข้อมูล")) {
                    var cus_id = document.querySelector("input[name='cus_id']").value;
                    document.location.href = "module/deletecus.php?cus_id=" + cus_id;
                }
            }
        </script>
    </main>

</body>

</html>