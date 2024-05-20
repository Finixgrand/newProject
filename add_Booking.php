<?php
include 'module/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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
    <?php include 'component/user_nav.php'; ?>
    <div class="container">
        <table class="head_tb">
            <tr>
                <th>การจองคิว</th>
            </tr>
        </table>
        <form action="module/add_booking.php" method="post">
            <table align="center">
                <tr>
                    <td class="form-group">
                        <label for="b_date">เลือกวันที่</label>
                        <select name="b_date" id="b_date">
                            <?php
                            $sql1 = "SELECT DISTINCT qt_date FROM queue_table";
                            $result1 = mysqli_query($conn, $sql1);
                            while ($rs1 = mysqli_fetch_array($result1)) {
                                echo "<option value='{$rs1['qt_date']}'>{$rs1['qt_date']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="form-group">
                        <label for="b_time">เลือกเวลา</label>
                        <select name="b_time" id="b_time">
                            <option value="">เลือกวันที่ก่อน</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="form-group">
                        <label for="massage">เลือกบริการ</label>
                        <select name="s_id" id="s_id">
                            <?php
                            $sql2 = "SELECT * FROM service";
                            $result2 = mysqli_query($conn, $sql2);
                            while ($rs2 = mysqli_fetch_array($result2)) {
                                echo "<option value='{$rs2['s_id']}'>{$rs2['s_name']}</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="qt_id" id="qt_id" value="">
                    </td>
                </tr>
            </table>
            <div class="buttons">
                <a href="javascript:history.back()" class="btn btn-secondary">ย้อนกลับ</a>
                <input type="submit" value="ตกลง">
            </div>
        </form>
    </div>
</body>
</html>
