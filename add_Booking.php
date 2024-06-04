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
        <link href="css/add_booking.css?v=4" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <style>
            div {
                position: relative;
            }
        </style>

        <script>
            $(document).ready(function() {
    $('#p_id').change(function() {
        var p_id = $(this).val();
        if (p_id != '') {
            $.ajax({
                url: "get_dates.php",
                method: "POST",
                data: { p_id: p_id },
                success: function(data) {
                    console.log('Data from get_dates.php:', data);
                    if (data) {
                        var availableDates = JSON.parse(data);
                        if (availableDates.length > 0) {
                            $('#qt_date').datepicker('destroy').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true,
                                daysOfWeekDisabled: "0,6",
                                startDate: new Date(), // Set startDate to today's date
                                beforeShowDay: function(date) {
                                    // Adjust date to UTC+7
                                    var localDate = new Date(date.getTime() + (7 * 60 * 60 * 1000));
                                    var dateString = localDate.toISOString().split('T')[0];
                                    var today = new Date();
                                    var localToday = new Date(today.getTime() + (7 * 60 * 60 * 1000));
                                    var todayString = localToday.toISOString().split('T')[0];

                                    // Calculate tooltip date
                                    var tooltipDate = new Date(localDate);
                                    tooltipDate.setDate(tooltipDate.getDate() - 1);
                                    var tooltipDateString = tooltipDate.toISOString().split('T')[0];

                                    // Disable dates in the past and future dates that are not in availableDates
                                    if (dateString >= todayString && availableDates.indexOf(dateString) != -1) {
                                        return {
                                            classes: 'highlight',
                                            tooltip: 'Available - ' + tooltipDateString
                                        };
                                    } else {
                                        return {
                                            enabled: false,
                                            tooltip: 'Unavailable - ' + tooltipDateString,
                                            classes: 'unavailable'
                                        };
                                    }
                                }
                            });
                           
                            $('#qt_time').html('<option value="">เลือกเวลา</option>'); // Clear time options
                        } else {
                            console.log('No available dates found.');
                            $('#qt_date').datepicker('destroy');
                            $('#qt_date').val(''); // Clear selected date
                            $('#qt_time').html('<option value="">เลือกเวลา</option>'); // Clear time options
                        }
                    } else {
                        console.log('No data received from get_dates.php');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX call failed:', textStatus, errorThrown);
                }
            });
        } else {
            $('#qt_date').datepicker('destroy');
            $('#qt_date').val(''); // Clear selected date
            $('#qt_time').html('<option value="">เลือกเวลา</option>'); // Clear time options
        }
    });

    $('#qt_date').change(function() {
        updateTimes();
    });

    function updateTimes() {
        var p_id = $('#p_id').val();
        var qt_date = $('#qt_date').val();
        if (p_id != '' && qt_date != '') {
            $.ajax({
                url: "get_times.php",
                method: "POST",
                data: { p_id: p_id, qt_date: qt_date },
                success: function(data) {
                    console.log('Data from get_times.php:', data);
                    var response = JSON.parse(data);
                    var times = response.times;
                    var qt_id = response.qt_id;
                    var quota = response.quota;

                    // Update qt_id and quota fields
                    $('#qt_id').val(qt_id);
                    $('#quota').val(quota);

                    var options = '<option value="">เลือกเวลา</option>';
                    $.each(times, function(index, time) {
                        options += '<option value="' + time + '">' + time + '</option>'; // Assuming time is a simple string
                    });
                    $('#qt_time').html(options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX call failed:', textStatus, errorThrown);
                }
            });
        } else {
            $('#qt_time').html('<option value="">เลือกเวลา</option>'); // Clear time options
        }
    }
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
                                </div>
                                <div class="form-group">
                                    <label for="qt_date" class="form-label">เลือกวันที่</label>
                                    <input type="text" name="qt_date" id="qt_date" class="form-control" readonly>
                                    <input type="hidden" name="qt_id" id="qt_id" value="">
                                    <input type="hidden" name="quota" id="quota" value="">
                                </div>
                                <div class="form-group">
                                    <label for="qt_time" class="form-label">เลือกเวลา</label>
                                    <select name="qt_time" id="qt_time" class="form-control">
                                        <option value="">เลือกเวลา</option>
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

        <div data-spy="scroll" data-target="#navId">

            <div id="navId">
                <ul class="nav nav-tabs" role="tablist">

                </ul>
            </div>

        </div>


        <script>
            $('div{1:div|body}').scrollspy({
                target: '#navId'
            });
        </script>
    </body>

    </html>

<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>