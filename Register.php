<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
    </style>
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
                                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="password" required>
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
                                <input type="number" class="form-control" id="age" name="age" required>
                            </div>
                            <div class="form-group">
                                <label for="IDcardnumber" class="form-label">เลขประจำตัวประชาชน</label>
                                <input type="text" class="form-control" id="IDcardnumber" name="IDcardnumber" required>
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">ที่อยู่</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="tel" name="tel" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-custom">สมัครสมาชิก</button>
                            <a href="javascript:history.back()" class="btn btn-secondary btn-custom">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
