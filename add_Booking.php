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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                <label for="b_date" class="form-label">เลือกวันที่</label>
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
                            <div class="form-group">
                                <label for="b_time" class="form-label">เลือกเวลา</label>
                                <select name="b_time" id="b_time" class="form-control">
                                    <option value="">เลือกวันที่ก่อน</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="s_id" class="form-label">เลือกบริการ</label>
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
