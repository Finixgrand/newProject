<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $p_id = $_GET['p_id'];

    // เรียกดูข้อมูลจากตาราง program เพื่อใช้กำหนดวันที่เริ่มต้นและสิ้นสุด
    $query = "SELECT * FROM program WHERE p_id = '$p_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $p_start = $row['p_start']; // วันที่เริ่มต้นที่สามารถเลือกได้
    $p_end = $row['p_end']; // วันที่สิ้นสุดที่สามารถเลือกได้

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>จองคิวสมาชิกเก่า</title>
        <link rel="stylesheet" type="text/css" href="css/showbooking.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script>
            $(document).ready(function() {
                let isUsernameValid = false;

                $('#b_date').datepicker({
                    format: 'yyyy-mm-dd', // รูปแบบวันที่ที่ต้องการ (เช่น 'yyyy-mm-dd' หรือ 'dd/mm/yyyy')
                    autoclose: true, // ปิด Datepicker เมื่อเลือกวันที่เสร็จสิ้น
                    todayHighlight: true, // เน้นวันที่ปัจจุบัน
                    startDate: '<?php echo $p_start; ?>', // วันที่เริ่มต้นที่สามารถเลือกได้
                    endDate: '<?php echo $p_end; ?>', // วันที่สิ้นสุดที่สามารถเลือกได้
                    daysOfWeekDisabled: [0, 6], // ไม่ให้เลือกวันเสาร์และอาทิตย์
                    beforeShowDay: function(date) {
                        var day = date.getDay();
                        return [(day != 0 && day != 6)]; // ไม่ให้เลือกวันเสาร์และอาทิตย์
                    },
                    timezone: 'UTC+7' // เปลี่ยนไทม์โซนเป็น UTC+7
                }).on('changeDate', function() {
                    let qt_date = $(this).val();
                    let p_id = $('input[name="p_id"]').val();
                    $.ajax({
                        url: 'get_times_admin.php',
                        type: 'post',
                        data: {
                            qt_date: qt_date,
                            p_id: p_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            $("#b_time").empty();
                            // เพิ่ม option สำหรับ "เลือกเวลา" เป็นค่าเริ่มต้น
                            $("#b_time").append("<option value=''>เลือกเวลา</option>");
                            for (var i = 0; i < len; i++) {
                                var qt_id = response[i]['qt_id'];
                                var qt_time = response[i]['qt_time'];
                                var quota = response[i]['quota'];
                                if (quota > 0) {
                                    $("#b_time").append("<option value='" + qt_id + "' data-qt_time='" + qt_time + "' data-quota='" + quota + "'>" + qt_time + "</option>");
                                }
                            }
                            // ล้างค่าของ input qt_id และ quota
                            $('#qt_id').val('');
                            $('#quota').val('');
                        }
                    });
                });

                $('#b_time').on('change', function() {
                    // ดึง qt_id และ quota จาก option ที่เลือก
                    var selectedOption = $(this).find('option:selected');
                    var qt_id = selectedOption.val();
                    var qt_time = selectedOption.data('qt_time');
                    var quota = selectedOption.data('quota');

                    // กำหนดค่าให้กับ input qt_id และ quota
                    $('#qt_id').val(qt_id);
                    $('#quota').val(quota);
                    $('#b_time_hidden').val(qt_time);
                });

                function toggleSubmitButton() {
                    if (isUsernameValid) {
                        $('button[type="submit"]').prop('disabled', false);
                    } else {
                        $('button[type="submit"]').prop('disabled', true);
                    }
                }

                function validateInput(value) {
                    value = value.trim();
                    return value !== "" && value.indexOf(' ') === -1;
                }

                // ตรวจสอบ Username
                $('#check_user').click(function() {
                    var u_name = $('input[name="u_name"]').val().trim();
                    if (!validateInput(u_name)) {
                        $('#user_status').text("Username ห้ามมีช่องว่างที่ด้านหน้าและด้านหลัง หรือมีช่องว่างภายใน").css('color', 'red');
                        isUsernameValid = false;
                        
                        return;
                    }
                    $.ajax({
                        url: 'check_member.php',
                        type: 'post',
                        data: {
                            u_name: u_name
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == "exists") {
                                $('#user_status').text("ชื่อลูกค้า: " + response.name).css('color', 'green');
                                isUsernameValid = true;
                            } else {
                                $('#user_status').text("ไม่พบผู้ใช้งาน").css('color', 'red');
                                isUsernameValid = false;
                            }
                            
                        }
                    });
                });

                $('#submitBtn').click(function(event) {
                    if (!isUsernameValid) {
                        alert('กรุณาตรวจสอบ Username ให้ถูกต้อง');
                        event.preventDefault();
                    } else {
                        // ทำงานปกติ
                    }
                });
  
            });
        </script>
    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>

        <main>
            <div class="container my-5">

                <h2 class="text-center mb-4">จองคิว (เก่า)</h2>

                <form action="module/add_q_member.php" method="post" class="needs-validation" novalidate>

                    <div class="form-group row">
                        <label for="u_name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="u_name" class="form-control" required>
                            <button type="button" class="btn btn-secondary" id="check_user">ตรวจสอบ</button>
                        </div>
                        <span id="user_status" class="mt-2 d-block"></span>
                    </div>

                    <div class="form-group row">
                        <label for="b_date" class="col-sm-2 col-form-label">เลือกวันที่</label>
                        <div class="col-sm-10">
                            <input type="text" name="b_date" id="b_date" class="form-control" autocomplete="off" readonly>
                        </div>



                    </div>

                    <div class="form-group row">
                        <label for="b_time" class="col-sm-2 col-form-label">เลือกเวลา</label>
                        <div class="col-sm-10">
                            <select name="b_time" id="b_time" class="form-control">
                                <option value="">โปรดเลือกวันที่ก่อน</option>
                            </select>
                            <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
                            <input type="hidden" name="qt_id" id="qt_id" value="">
                            <input type="hidden" name="quota" id="quota" value="">
                            <input type="hidden" name="b_time_hidden" id="b_time_hidden" value="">
                        </div>
                    </div>

                    <div class="text-center">

                        <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
                        <button id="submitBtn" type="submit" class="btn btn-primary">ตกลง</button>
                    </div>
                </form>
            </div>
            </div>
        </main>

    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>