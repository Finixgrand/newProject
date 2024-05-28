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
        <title>Booking</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
                margin-top: 10px;
            }
        </style>
        <script>
            $(document).ready(function() {
                function loadDates(p_id) {
                    $.ajax({
                        url: 'get_dates.php',
                        type: 'get',
                        data: {
                            p_id: p_id
                        },
                        success: function(response) {
                            var dates = JSON.parse(response);

                            $("#b_date").prop('disabled', false).datepicker('destroy').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true,
                                daysOfWeekDisabled: [0, 6],
                                beforeShowDay: function(date) {
                                    var dateString = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
                                    return dates.includes(dateString);
                                }
                            }).on('changeDate', function(e) {
                                updateTimes();
                            });
                        }
                    });
                }

                // Function to update available times based on selected date
                function updateTimes() {
    var date = $('#b_date').val();
    var programId = $('#p_id').val();
    $.ajax({
        url: 'get_times.php',
        type: 'post',
        data: {
            date: date,
            p_id: programId
        },
        success: function(response) {
            var times = JSON.parse(response);
            var timeSelect = $('#b_time');
            timeSelect.empty();
            $.each(times, function(index, time) {
                timeSelect.append($('<option></option>').val(time).text(time));
            });
            timeSelect.prop('disabled', false);
        }
    });
}

                // Initial load of dates based on selected project
                $('#p_id').change(function() {
                    var p_id = $(this).val();
                    if (p_id) {
                        loadDates(p_id);
                    }
                });

                // Update times when date is selected
                $('#b_date').change(function() {
                    updateTimes();
                });

                // Update qt_id when time is selected
                $('#b_time').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var qt_id = selectedOption.data('qt_id');
                    $('#qt_id').val(qt_id);
                });

            });
        </script>
    </head>

    <body>
        <?php include 'component/user_nav.php'; ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>การจองคิว</h4>
                        </div>
                        <div class="card-body">
                            <form action="module/add_booking.php" method="post">
                                <div class="form-group">
                                    <label for="p_id" class="form-label">เลือกโครงการ</label>
                                    <select name="p_id" id="p_id" class="form-control">
                                        <option value="">เลือกโครงการ</option>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM program");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($rs = $result->fetch_assoc()) {
                                            echo "<option value='{$rs['p_id']}'>{$rs['p_name']}</option>";
                                        }
                                        $stmt->close();
                                        ?>
                                    </select>
                                    <input type="hidden" name="qt_id" id="qt_id" value="">
                                </div>
                                <div class="form-group">
                                    <label for="b_date" class="form-label">เลือกวันที่</label>
                                    <input type="text" name="b_date" id="b_date" class="form-control" placeholder="เลือกวันที่">
                                </div>

                                <div class="form-group">
                                    <label for="b_time" class="form-label">เลือกเวลา</label>
                                    <select name="b_time" id="b_time" class="form-control">
                                        <option value="">เลือกวันที่ก่อน</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <a href="javascript:history.back()" class="btn btn-secondary btn-custom">ย้อนกลับ</a>
                                    <button type="submit" class="btn btn-primary btn-custom">ตกลง</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>