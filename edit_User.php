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
        <title>ข้อมูลผู้ใช้บริการ</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                let isTelValid = false;

                // Validate phone number input
                $('input[name="tel"]').on('input', function() {
                    var tel = $(this).val().trim();
                    if (tel.length === 10) {
                        $('#tel_status').text("").css('color', '');
                        isTelValid = true;
                    } else {
                        $('#tel_status').text("กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก").css('color', 'red');
                        isTelValid = false;
                    }
                });

                $('#submitBtn').click(function(event) {
                    if (!isTelValid) {
                        alert('กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก');
                        event.preventDefault();
                    }
                });
            });
        </script>
    </head>

    <body>
        <?php include 'component/user_nav.php'; ?>

        <main class="container">
            <h2 class="mb-4">ข้อมูลผู้ใช้บริการ</h2>
            <form action="module/edit_user.php" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <td>ชื่อ - นามสกุล</td>
                                <td>
                                    <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>">
                                    <input type="text" name="name" value="<?php echo $rs['name']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>เพศ</td>
                                <td>
                                    <input type="radio" id="male" name="gender" value="0" <?php echo ($rs['gender'] == '0') ? 'checked' : '' ?>>
                                    <label for="male">ชาย</label>
                                    <input type="radio" id="female" name="gender" value="1" <?php echo ($rs['gender'] == '1') ? 'checked' : '' ?>>
                                    <label for="female">หญิง</label>
                                </td>
                            </tr>
                            <tr>
                                <td>อายุ</td>
                                <td>
                                    <input type="number" name="age" value="<?php echo $rs['age']; ?>" onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 2) || event.keyCode === 8">
                                </td>
                            </tr>
                            <tr>
                                <td>เลขประจำตัวประชาชน</td>
                                <td>
                                    <input type="number" name="IDcardnumber" value="<?php echo $rs['IDcardnumber']; ?>" readonly onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 13) || event.keyCode === 8">
                                </td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><input type="text" name="address" value="<?php echo $rs['address']; ?>"></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทรศัพท์</td>
                                <td>
                                    <input type="number" name="tel" class="form-control" id="tel" value="<?php echo $rs['tel']; ?>" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 10) || event.keyCode === 8">
                                    <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก</div>
                                    <span id="tel_status" class="mt-2 d-block"></span>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
                    <button id="submitBtn" type="submit" class="btn btn-primary">บันทึก</button>
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
