<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $cus_id = $_GET['cus_id'];

    $sql = "SELECT * FROM customer JOIN user ON customer.u_name = user.u_name WHERE cus_id = $cus_id";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แก้ไขข้อมูลผู้ใช้บริการ</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let isIDCardValid = false;
                let isTelValid = false;
               // ตรวจสอบเลขประจำตัวประชาชน
            $('#check_card').click(function() {
                var IDcardnumber = $('input[name="IDcardnumber"]').val().trim();
                if (!validateInput(IDcardnumber) || IDcardnumber.length !== 13) {
                    $('#card_status').text("กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก").css('color', 'red');
                    isIDCardValid = false;
                    return;
                }
                $.ajax({
                    url: 'check_card.php',
                    type: 'post',
                    data: {
                        IDcardnumber: IDcardnumber
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

                $('#submitBtn').click(function(event) {
                    if (!isIDCardValid|| !isTelValid) {
                        alert('กรุณาตรวจสอบเลขประจำตัวประชาชนให้ถูกต้อง');
                        event.preventDefault();
                    }
                });
        </script>
    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>

        <div class="container mt-5">
            <h2 class="mb-4">แก้ไขข้อมูลผู้ใช้บริการ</h2>
            <form action="module/editcus.php" method="post" class="needs-validation" novalidate>                              
                <div class="mb-3">
                    <label for="u_name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="u_name" value="<?php echo $rs['u_name']; ?>" readonly onkeydown="javascript: return (this.value.length < 15) || event.keyCode === 8">
                    <input type="hidden" name="u_name" value="<?php echo $rs['u_name']; ?>">
                    <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>">
                </div>
                <div class="mb-3">
                    <label for="u_pass" class="form-label">Password</label>
                    <input type="text" class="form-control" id="u_pass" name="u_pass" value="<?php echo $rs['u_pass']; ?>" onkeydown="javascript: return (this.value.length < 15) || event.keyCode === 8">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rs['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">เพศ</label>
                    <div>
                        <input type="radio" id="male" name="gender" value="0" <?php echo ($rs['gender'] == '0') ? 'checked' : '' ?>>
                        <label for="male">ชาย</label>
                        <input type="radio" id="female" name="gender" value="1" <?php echo ($rs['gender'] == '1') ? 'checked' : '' ?>>
                        <label for="female">หญิง</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">อายุ</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?php echo $rs['age']; ?>" maxlength="2">
                </div>
                <div class="mb-3">
                    <label for="IDcardnumber" class="form-label">เลขประจำตัวประชาชน</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="IDcardnumber" name="IDcardnumber" value="<?php echo $rs['IDcardnumber']; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 13) || event.keyCode === 8">
                        <button type="button" class="btn btn-secondary" id="check_card">ตรวจสอบ</button>
                    </div>
                    <div class="invalid-feedback">กรุณากรอกเลขประจำตัวประชาชน</div>
                    <span id="card_status" class="mt-2 d-block"></span>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">ที่อยู่</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $rs['address']; ?>">
                </div>
                <div class="form-group">
                    <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="number" name="tel" class="form-control" id="tel" value="<?php echo $rs['tel']; ?>" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 10) || event.keyCode === 8">
                    <div class="invalid-feedback">
                        กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก
                    </div>
                    <span id="tel_status" class="mt-2 d-block"></span>
                </div>
                <div class="text-center">
                    <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
                    <button id="submitBtn" type="submit" class="btn btn-primary">บันทึก</button>
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