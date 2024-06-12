<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $username = $_SESSION["valid_uname"];

    $sql = "SELECT * FROM customer INNER JOIN user ON customer.u_name = user.u_name WHERE user.u_name = '$username'";
    $result = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_assoc($result);

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
    include 'component/user_nav.php';
    ?>

    <main>
        <div class="container">
            <h2 class="mb-4">ข้อมูลผู้ใช้บริการ</h2>
            <div class="table-responsive">
                <form action="module/edit_user.php" method="post">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <td>ชื่อ - นามสกุล <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>"></td>
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
                                <td><input type="number" name="age" value="<?php echo "$rs[age]"; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 2) || event.keyCode === 8"></td>
                            </tr>
                            <tr>
                                <td>เลขประจำตัวประชาชน</td>
                                <td><input type="number" name="IDcardnumber" value="<?php echo "$rs[IDcardnumber]"; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 13) || event.keyCode === 8"></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><input type="text" name="address" value="<?php echo "$rs[address]"; ?>"></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทรศัพท์</td>
                                <td><input type="number" name="tel" value="<?php echo "$rs[tel]"; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 10) || event.keyCode === 8"></td>
                            </tr>
                    </table>

                    <br>
                    <div align="center"> <!-- ปุ่มย้อนกลับ แก้ไข ลบ -->
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            < ย้อนกลับ</a> &nbsp;&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-primary">บันทึก</button> &nbsp;&nbsp;&nbsp;&nbsp;
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