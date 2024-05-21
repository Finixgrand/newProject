<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

$cus_id = $_GET['cus_id'];

$sql = "SELECT * FROM customer WHERE cus_id = $cus_id";

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

    <p>แก้ไขข้อมูลผู้ใช้บริการ</p>
    <main>
        <form action="module/editcus.php" method="post">
            <table>
                <tr>
                    <td>รหัส</td>
                    <td><?php echo "$rs[cus_id]"; ?> <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>"></td>
                </tr>
                <tr>
                    <td>ชื่อ - นามสกุล</td>
                    <td><input type="text" name="name" value="<?php echo "$rs[name]"; ?>"></td>
                </tr>
                <tr>
                    <td>เพศ</td>
                    <td><input type="radio" id="male" name="gender" value="0" <?php echo ($rs['gender'] == '0') ? 'checked' : '' ?>>
                        <label for="male">ชาย</label>
                        <input type="radio" id="female" name="gender" value="1" <?php echo ($rs['gender'] == '1') ? 'checked' : '' ?>>
                        <label for="female">หญิง</label>
                    </td>
                </tr>
                <tr>
                    <td>อายุ</td>
                    <td><input type="text" name="age" value="<?php echo "$rs[age]"; ?>"></td>
                </tr>
                <tr>
                    <td>เลขประจำตัวประชาชน</td>
                    <td><input type="text" name="IDcardnumber" value="<?php echo "$rs[IDcardnumber]"; ?>"></td>
                </tr>
                <tr>
                    <td>ที่อยู่</td>
                    <td><input type="text" name="address" value="<?php echo "$rs[address]"; ?>"></td>
                </tr>
                <tr>
                    <td>เบอร์โทรศัพท์</td>
                    <td><input type="text" name="tel" value="<?php echo "$rs[tel]"; ?>"></td>
                </tr>
            </table>

            <br>
            <div align="center"> <!-- ปุ่มย้อนกลับ แก้ไข ลบ -->
                
            <a href="javascript:history.back()" class="btn btn-secondary">< ย้อนกลับ</a> &nbsp;&nbsp;&nbsp;&nbsp;
                <button>บันทึก</button> &nbsp;&nbsp;&nbsp;&nbsp;

                
            </div>

        </form>
    </main>
</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>