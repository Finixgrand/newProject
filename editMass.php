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
  <title>แก้ไขข้อมูลผู้นวด</title>
</head>

<body>
  <?php include 'component/admin_nav.php'; ?>

  <div class="container mt-5">
    <h2 class="text-center">แก้ไขข้อมูลผู้นวด</h2>
    <form action="module/editmass.php" method="post">
      <div class="mb-3">
        <label for="ma_id" class="form-label">รหัส</label>
        <input type="text" class="form-control" id="ma_id" value="<?php echo $rs['ma_id']; ?>" disabled>
        <input type="hidden" name="ma_id" value="<?php echo $rs['ma_id'] ?>">
      </div>
      <div class="mb-3">
        <label for="ma_name" class="form-label">ชื่อ</label>
        <input type="text" class="form-control" id="ma_name" name="ma_name" value="<?php echo $rs['ma_name']; ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">เพศ</label>
        <div>
          <input type="radio" id="male" name="ma_gender" value="0" <?php echo ($rs['ma_gender'] == '0') ? 'checked' : '' ?>>
          <label for="male">ชาย</label>
          <input type="radio" id="female" name="ma_gender" value="1" <?php echo ($rs['ma_gender'] == '1') ? 'checked' : '' ?>>
          <label for="female">หญิง</label>
        </div>
      </div>
      <div class="mb-3">
        <label for="ma_age" class="form-label">อายุ</label>
        <input type="number" class="form-control" id="ma_age" name="ma_age" value="<?php echo $rs['ma_age']; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 2) || event.keyCode === 8">
      </div>
      <div class="mb-3">
        <label for="ma_id_card" class="form-label">เลขประจำตัวประชาชน</label>
        <input type="number" class="form-control" id="ma_id_card" name="ma_id_card" value="<?php echo $rs['ma_card']; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 13) || event.keyCode === 8">
      </div>
      <div class="mb-3">
        <label for="ma_address" class="form-label">ที่อยู่</label>
        <input type="text" class="form-control" id="ma_address" name="ma_address" value="<?php echo $rs['ma_address']; ?>">
      </div>
      <div class="mb-3">
        <label for="ma_tel" class="form-label">เบอร์โทรศัพท์</label>
        <input type="number" class="form-control" id="ma_tel" name="ma_tel" value="<?php echo $rs['ma_tel']; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 10) || event.keyCode === 8">
      </div>
      <div class="d-flex justify-content-center">
        <a href="javascript:history.back()" class="btn btn-secondary me-3">ยกเลิก</a>
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </form>
  </div>

</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
