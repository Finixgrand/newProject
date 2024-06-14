<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>เพิ่มข้อมูลผู้นวด</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
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
                        url: 'check_mass.php',
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
                    if (!isIDCardValid || !isTelValid) {
                        alert('กรุณาตรวจสอบกรอกข้อมูลให้ครบ');
                        event.preventDefault();
                    } else {
                        // ทำงานปกติ
                    }
                });

                function validateInput(value) {
                    value = value.trim();
                    return value !== "" && value.indexOf(' ') === -1;
                }

                // ตรวจสอบเบอร์โทรศัพท์
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

            });
        </script>
    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>เพิ่มข้อมูลผู้นวด</h4>
                        </div>
                        <div class="card-body">
                            <form action="module/addmass.php" method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">ชื่อ - นามสกุล</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">เพศ</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0" required>
                                        <label class="form-check-label" for="gender_male">ชาย</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1" required>
                                        <label class="form-check-label" for="gender_female">หญิง</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">อายุ</label>
                                    <input type="number" class="form-control" id="age" name="age" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 2) || event.keyCode === 8">
                                </div>
                                <div class="form-group">
                                    <label for="IDcardnumber" class="col-sm-4 col-form-label"><b>เลขประจำตัวประชาชน</b></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="number" name="IDcardnumber" class="form-control" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 13) || event.keyCode === 8">
                                            <button type="button" class="btn btn-secondary" id="check_card">ตรวจสอบ</button>
                                        </div>
                                        <div class="invalid-feedback">
                                            กรุณากรอกเลขประจำตัวประชาชน
                                        </div>
                                        <span id="card_status" class="mt-2 d-block"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">ที่อยู่</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                                    <input type="number" name="tel" class="form-control" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 10) || event.keyCode === 8">
                                    <div class="invalid-feedback">
                                        กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก
                                    </div>
                                    <span id="tel_status" class="mt-2 d-block"></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="javascript:history.back()" class="btn btn-secondary">ยกเลิก</a>
                                    <button  id="submitBtn" type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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