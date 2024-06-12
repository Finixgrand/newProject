<?php
include 'module/connect.php';
session_start();

if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {

    $p_id = $_GET['p_id'];
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    if ($start_date && $end_date) {
        $sql = "SELECT booking.*, customer.*, masseuse.* FROM booking 
                JOIN customer ON booking.u_name = customer.u_name
                JOIN queue_table ON booking.qt_id = queue_table.qt_id
                JOIN masseuse ON booking.ma_id = masseuse.ma_id
                WHERE queue_table.p_id = $p_id AND booking.b_date BETWEEN '$start_date' AND '$end_date'
                ORDER BY booking.b_date ASC, booking.b_time";

        $sql_count = "SELECT COUNT(booking.b_id) AS total, program.p_name, program.p_start, program.p_end FROM booking 
                      JOIN queue_table ON booking.qt_id = queue_table.qt_id
                      JOIN program ON queue_table.p_id = program.p_id
                      WHERE queue_table.p_id = $p_id AND booking.b_status = '1' AND booking.b_date BETWEEN '$start_date' AND '$end_date'";
    } else {
        $sql = "SELECT booking.*, customer.*, masseuse.* FROM booking 
                JOIN customer ON booking.u_name = customer.u_name
                JOIN queue_table ON booking.qt_id = queue_table.qt_id
                JOIN masseuse ON booking.ma_id = masseuse.ma_id
                WHERE queue_table.p_id = $p_id
                ORDER BY booking.b_date ASC, booking.b_time";

        $sql_count = "SELECT COUNT(booking.b_id) AS total, program.p_name, program.p_start, program.p_end FROM booking 
                      JOIN queue_table ON booking.qt_id = queue_table.qt_id
                      JOIN program ON queue_table.p_id = program.p_id
                      WHERE queue_table.p_id = $p_id AND booking.b_status = '1'";
    }

    $result = mysqli_query($conn, $sql) or die("Error in query: $sql" . mysqli_error($conn));
    $result2 = mysqli_query($conn, $sql_count);
    $rs2 = mysqli_fetch_array($result2);
    $total = $rs2['total'];
    $p_start = $rs2['p_start'];
    $p_end = $rs2['p_end'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานผลโครงการ</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3, h4 {
            margin-bottom: 1rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .input-group-text {
            background-color: #e9ecef;
        }
        .datepicker {
            width: auto;
        }
    </style>
</head>

<body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container mt-5">
        <h3 class="text-center">สรุปโครงการ</h3>
        <h4 class="text-center"><?php echo $rs2['p_name']; ?></h4>
        <h6 class="text-center">วันที่เริ่ม <?php echo $rs2['p_start']; ?> วันที่สิ้นสุด <?php echo $rs2['p_end']; ?></h6>

        <form class="d-flex justify-content-center mb-3" method="GET" action="">
            <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="start_date" placeholder="วันที่เริ่มต้น" value="<?php echo $start_date; ?>" required readonly>
                <span class="input-group-text">ถึง</span>
                <input type="text" class="form-control datepicker" name="end_date" placeholder="วันที่สิ้นสุด" value="<?php echo $end_date; ?>" required readonly>
                <button type="submit" class="btn btn-primary">ค้นหา</button>
            </div>
        </form>

        <div class="text-end mb-4">
            <strong>รวมรายการทั้งสิ้น:</strong> <?php echo $total; ?> รายการ
            <br>
            <strong>รวมทั้งสิ้น:</strong> <?php echo $hour = $total * 1; ?> ชั่วโมง
        </div>

        <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-secondary" onclick="window.location.href='projectDetail.php?p_id=<?php echo $p_id; ?>';">กลับ</button>
            <button class="btn btn-primary" onclick="printReport('<?php echo $p_id; ?>','<?php echo $start_date; ?>', '<?php echo $end_date; ?>')">พิมพ์</button>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>เวลา</th>
                    <th>ผู้นวด</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rs = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $rs['b_date']; ?></td>
                        <td><?php echo $rs['name']; ?></td>
                        <td><?php echo $rs['b_time']; ?></td>
                        <td><?php echo $rs['ma_name']; ?></td>
                    </tr>
                <?php
                }
                mysqli_close($conn);    
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            var p_start = "<?php echo $p_start; ?>";
            var p_end = "<?php echo $p_end; ?>";
            
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                yearRange: "-100:+10",
                showAnim: "fadeIn",
                minDate: new Date(p_start),
                maxDate: new Date(p_end)
            });
        }); 

        function printReport(p_id, start_date, end_date) {
            var url = 'print_reportproject.php?p_id=' + p_id;
            if (start_date && end_date) {
                url += '&start_date=' + start_date + '&end_date=' + end_date;
            }
            var win = window.open(url, '_blank');
            win.focus();
            win.onload = function() {
                win.print();
            }
        }
    </script>
</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
