<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-label {
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-custom {
            width: 100%;
            margin-top: 15px;
        }
    </style>

    <script>
        $(document).ready(function() {
            let isUsernameValid = false;
            let isIDCardValid = false;
            let isTelValid = false;

            // ตรวจสอบ Username
            $('#check_user').click(function() {
                var u_name = $('input[name="u_name"]').val().trim();
                if (!validateInput(u_name)) {
                    $('#user_status').text("Username ห้ามมีช่องว่างที่ด้านหน้าและด้านหลัง หรือมีช่องว่างภายใน").css('color', 'red');
                    isUsernameValid = false;
                    return;
                }
                $.ajax({
                    url: 'check_user.php',
                    type: 'post',
                    data: {
                        u_name: u_name
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "exists") {
                            $('#user_status').text("Username นี้มีอยู่แล้ว").css('color', 'red');
                            isUsernameValid = false;
                        } else {
                            $('#user_status').text("Username นี้สามารถใช้ได้").css('color', 'green');
                            isUsernameValid = true;
                        }
                    }
                });
            });

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
                if (!isUsernameValid || !isIDCardValid) {
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

            $('#submitBtn').click(function(event) {
                if (!isTelValid) {
                    alert('กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก');
                    event.preventDefault();
                } else {
                    // ทำงานปกติ
                }
            });

        });   
    </script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>สมัครสมาชิก</h4>
                    </div>
                    <div class="card-body">
                        <form action="module/register.php" method="post">
                            <div class="form-group">

                                <label for="u_name" class="col-sm-2 col-form-label"><b>Username</b></label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <input type="text" name="u_name" class="form-control" required onkeydown="javascript: return (this.value.length < 15) || event.keyCode === 8">
                                        <button type="button" class="btn btn-secondary" id="check_user">ตรวจสอบ</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        กรุณากรอก Username
                                    </div>
                                    <span id="user_status" class="mt-2 d-block"></span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="password" required onkeydown="javascript: return (this.value.length < 15) || event.keyCode === 8">
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">ชื่อ - นามสกุล</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">เพศ</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="0" required>
                                    <label class="form-check-label" for="male">ชาย</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="1" required>
                                    <label class="form-check-label" for="female">หญิง</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="form-label">อายุ</label>
                                <input type="number" name="age" class="form-control" required onkeydown="javascript: return (event.keyCode !== 69 && this.value.length < 2) || event.keyCode === 8">
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
                            <div class="form-group">
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
                            <button id="submitBtn" type="submit" class="btn btn-primary btn-custom">สมัครสมาชิก</button>
                            <a href="javascript:history.back()" class="btn btn-secondary btn-custom">ยกเลิก</a>
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