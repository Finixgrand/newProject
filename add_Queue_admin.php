<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $p_id = $_GET['p_id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/showbooking.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                function updateTimes() {
                    var date = $('#b_date').val();
                    $.ajax({
                        url: 'get_times.php',
                        type: 'post',
                        data: {
                            date: date
                        },
                        success: function(response) {
                            $('#b_time').html(response);
                        }
                    });
                }

                $('#b_date').change(updateTimes);

                $('#b_time').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var qt_id = selectedOption.data('qt_id');
                    $('#qt_id').val(qt_id);
                });
            });
        </script>
    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>
        <div class="container mt-5">
            <h2 class="text-center mb-4">การจองคิว</h2>
            <form action="module/add_queue_admin.php" method="post">
                <div class="form-group row">
                    <label for="b_date" class="col-sm-2 col-form-label">เลือกวันที่</label>
                    <div class="col-sm-10">
                        <select name="b_date" id="b_date" class="form-control">
                            <?php
                            $sql1 = "SELECT DISTINCT qt_date FROM queue_table";
                            $result1 = mysqli_query($conn, $sql1);
                            while ($rs1 = mysqli_fetch_array($result1)) {
                                echo "<option value='{$rs1['qt_date']}'>{$rs1['qt_date']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
                </div>
                <div class="form-group row">
                    <label for="b_time" class="col-sm-2 col-form-label">เลือกเวลา</label>
                    <div class="col-sm-10">
                        <select name="b_time" id="b_time" class="form-control">
                            <option value="">เลือกวันที่ก่อน</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_name" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="u_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_pass" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="u_pass" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IDcardnumber" class="col-sm-2 col-form-label">เลขประจำตัวประชาชน</label>
                    <div class="col-sm-10">
                        <input type="text" name="IDcardnumber" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-2 col-form-label">อายุ</label>
                    <div class="col-sm-10">
                        <input type="text" name="age" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">เพศ</label>
                    <div class="col-sm-10 d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="0" required>
                            <label class="form-check-label" for="male">ชาย</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="1" required>
                            <label class="form-check-label" for="female">หญิง</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">ที่อยู่</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tel" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                    <div class="col-sm-10">
                        <input type="text" name="tel" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="s_id" class="col-sm-2 col-form-label">เลือกบริการ</label>
                    <div class="col-sm-10">
                        <select name="s_id" id="s_id" class="form-control">
                            <?php
                            $sql2 = "SELECT * FROM service";
                            $result2 = mysqli_query($conn, $sql2);
                            while ($rs2 = mysqli_fetch_array($result2)) {
                                echo "<option value='{$rs2['s_id']}'>{$rs2['s_name']}</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="qt_id" id="qt_id" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2" align="center">
                        <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">ตกลง</button>
                    </div>
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