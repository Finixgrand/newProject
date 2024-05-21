<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

$ma_id = $_GET['ma_id'];

$sql = "SELECT * FROM masseuse WHERE ma_id = $ma_id";
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
  <p>แก้ไขข้อมูลผู้นวด</p>
  <form action="module/editmass.php" method="post">
    <table>
      <tr>
        <td>รหัส</td>
        <td><?php echo "$rs[ma_id]"; ?><input type="hidden" name="ma_id" value="<?php echo $rs['ma_id'] ?>"></td>
      <tr>
        <td>ชื่อ</td>
        <td><input type="text" name="ma_name" value="<?php echo "$rs[ma_name]"; ?>"></td>
      </tr>
      <tr>
        <td>เพศ</td>
        <td>
          <input type="radio" id="male" name="ma_gender" value="0" <?php echo ($rs['ma_gender'] == '0') ? 'checked' : '' ?>>
          <label for="male">ชาย</label>
          <input type="radio" id="female" name="ma_gender" value="1" <?php echo ($rs['ma_gender'] == '1') ? 'checked' : '' ?>>
          <label for="female">หญิง</label>
        </td>
      </tr>
      <tr>
        <td>อายุ</td>
        <td><input type="text" name="ma_age" value="<?php echo "$rs[ma_age]"; ?>"></td>
      </tr>
      <tr>
        <td>เลขประจำตัวประชาชน</td>
        <td><input type="text" name="ma_id_card" value="<?php echo "$rs[ma_id_card]"; ?>"></td>
      </tr>
      <tr>
        <td>ที่อยู่</td>
        <td><input type="text" name="ma_address" value="<?php echo "$rs[ma_address]"; ?>"></td>
      </tr>
      <tr>
        <td>เบอร์โทรศัพท์</td>
        <td><input type="text" name="ma_tel" value="<?php echo "$rs[ma_tel]"; ?>"></td>
      </tr>
    </table>

    <div align="center"> <!-- ปุ่มแก้ไข ยกเลิก -->
      <a href="javascript:history.back()" class="btn">ยกเลิก</a> &nbsp;&nbsp;&nbsp;&nbsp; <button>บันทึก</button>
    </div>

  </form>

</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>