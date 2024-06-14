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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        let isIDCardValid = true; // Set as true initially because it's the current valid value
        let isTelValid = true; // Set as true initially because it's the current valid value
        const originalIDCard = "<?php echo $rs['ma_card']; ?>";
        const originalTel = "<?php echo $rs['ma_tel']; ?>";

        // ตรวจสอบเลขประจำตัวประชาชน
        $('#check_card').click(function() {
          var ma_card = $('input[name="ma_card"]').val().trim();
          if (!validateInput(ma_card) || ma_card.length !== 13) {
            $('#card_status').text("กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก").css('color', 'red');
            isIDCardValid = false;
            return;
          }
          if (ma_card === originalIDCard) {
            $('#card_status').text("เลขประจำตัวประชาชนนี้สามารถใช้ได้").css('color', 'green');
            isIDCardValid = true;
            return;
          }
          $.ajax({
            url: 'check_mass_edit.php',
            type: 'post',
            data: {
              ma_card: ma_card // แก้ไขชื่อตัวแปรเป็น ma_card ตามการรับค่าที่เปลี่ยนแปลง
            },
            dataType: 'json',
            success: function(response) {
              if (response.status == "exists") {
                $('#card_status').text("เลขประจำตัวประชาชนนี้มีอยู่แล้ว").css('color', 'red');
                isIDCardValid = false;
              } else {
                $('#card_status').text("เลขประจำตัวประชาชนนี้สามารถใช้ได้").css('color', 'green');
                isIDCardValid = true;
              }
            }
          });
        });

        // ตรวจสอบเบอร์โทรศัพท์
        $('input[name="ma_tel"]').on('input', function() {
          var ma_tel = $(this).val().trim();
          if (ma_tel === originalTel) {
            $('#tel_status').text("เบอร์โทรศัพท์นี้สามารถใช้ได้").css('color', 'green');
            isTelValid = true;
            return;
          }

          if (ma_tel.length === 10) {
            $('#tel_status').text("เบอร์โทรศัพท์นี้สามารถใช้ได้").css('color', 'green');
            isTelValid = true;
          } else {
            $('#tel_status').text("กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก").css('color', 'red');
            isTelValid = false;
          }
        });

        // ตรวจสอบการกด submit และแจ้งเตือนเมื่อข้อมูลไม่ถูกต้อง
        $('#submitBtn').click(function(event) {
          if (!isIDCardValid || !isTelValid) {
            alert('กรุณาตรวจสอบข้อมูลให้ถูกต้อง');
            event.preventDefault();
          }
        });

        function validateInput(input) {
          var re = /^\d+$/;
          return re.test(input);
        }
      });
    </script>
  </head>

  <body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container mt-5">
      <h2 class="text-center">แก้ไขข้อมูลผู้นวด</h2>
      <form action="module/editmass.php" method="post">
        <div class="mb-3">
          <label for="ma_id" class="form-label">รหัส</label>
          <input type="text" class="form-control" id="ma_id" value="<?php echo $rs['ma_id']; ?>" disabled readonly>
          <input type="hidden" name="ma_id" value="<?php echo $rs['ma_id'] ?>">
        </div>
        <div class="mb-3">
          <label for="ma_name" class="form-label">ชื่อ</label>
          <input type="text" class="form-control" id="ma_name" name="ma_name" value="<?php echo $rs['ma_name']; ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">เพศ</label>
          <div>
            <input type="radio" id="male" name="ma_gender" value="0" <?php echo ($rs['ma_gender'] == '0') ? 'checked' : '' ?> required>
            <label for="male">ชาย</label>
            <input type="radio" id="female" name="ma_gender" value="1" <?php echo ($rs['ma_gender'] == '1') ? 'checked' : '' ?> required>
            <label for="female">หญิง</label>
          </div>
        </div>
        <div class="mb-3">
          <label for="ma_age" class="form-label">อายุ</label>
          <input type="number" class="form-control" id="ma_age" name="ma_age" value="<?php echo $rs['ma_age']; ?>" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 2) || event.keyCode === 8">
        </div>
        <div class="form-group">
          <label for="ma_card" class="col-sm-4 col-form-label"><b>เลขประจำตัวประชาชน</b></label>
          <div class="col-sm-12">
            <div class="input-group">
            <input type="text" class="form-control" name="ma_card" id="ma_card" value="<?php echo $rs['ma_card']; ?>" maxlength="13">
            <button type="button" id="check_card" class="btn btn-primary">ตรวจสอบ</button>
            </div>
            <span id="card_status"></span>
            <div class="mb-3">
              <label for="ma_address" class="form-label">ที่อยู่</label>
              <input type="text" class="form-control" id="ma_address" name="ma_address" value="<?php echo $rs['ma_address']; ?>" required>
            </div>
            <div class="form-group">
              <label for="ma_tel" class="form-label">เบอร์โทรศัพท์</label>
              <input type="number" name="ma_tel" class="form-control" value="<?php echo $rs['ma_tel'] ?>" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 10) || event.keyCode === 8">
              <span id="tel_status" class="mt-2 d-block"></span>
            </div>
            <div class="d-flex justify-content-center">
              <a href="javascript:history.back()" class="btn btn-secondary me-3">ยกเลิก</a>
              <button id="submitBtn" type="submit" class="btn btn-primary">บันทึก</button>
            </div>
      </form>
    </div>
    <script>
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>

  </html>
<?php
} else {
  echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
  exit();
}
?>