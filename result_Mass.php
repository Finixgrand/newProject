<?php
include 'module/connect.php';
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {

    $ma_id = $_GET['ma_id'];
    $p_id = $_GET['p_id'];

    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    $sql = "SELECT * FROM masseuse 
            INNER JOIN booking ON masseuse.ma_id = booking.ma_id 
            INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id 
            INNER JOIN program ON queue_table.p_id = program.p_id 
            INNER JOIN customer ON booking.u_name = customer.u_name
            WHERE program.p_id = $p_id AND masseuse.ma_id = $ma_id";

    if ($start_date && $end_date) {
        $sql .= " AND booking.b_date BETWEEN '$start_date' AND '$end_date'";
    }

    $sql .= " ORDER BY booking.b_date ASC, booking.b_time ASC";

    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql" . mysqli_error($conn));

    $sql_count = "SELECT COUNT(booking.b_id) AS total, program.p_name FROM booking
                  INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id
                  INNER JOIN program ON queue_table.p_id = program.p_id
                  WHERE queue_table.p_id = $p_id AND booking.ma_id = $ma_id";

    if ($start_date && $end_date) {
        $sql_count .= " AND booking.b_date BETWEEN '$start_date' AND '$end_date'";
    }

    $result2 = mysqli_query($conn, $sql_count);
    $rs2 = mysqli_fetch_array($result2);
    $total = $rs2['total'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>รายงานผลโครงการ</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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

            h3,
            h4 {
                margin-bottom: 1rem;
            }

            .table th,
            .table td {
                vertical-align: middle;
            }

            .btn-secondary,
            .btn-primary {
                margin: 0.5rem 0;
            }

            .text-center {
                margin-bottom: 1.5rem;
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
            <h3 class="text-center">สรุปรายการผู้นวด</h3>
            <h4 class="text-center text-secondary"><?php echo $rs2['p_name']; ?></h4>

             <form class="d-flex justify-content-center mb-3" method="GET" action="">
                <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
                <input type="hidden" name="ma_id" value="<?php echo $ma_id; ?>">
                <div class="input-group">
                    <input type="text" class="form-control datepicker" name="start_date" placeholder="วันที่เริ่มต้น" value="<?php echo $start_date; ?>" required readonly>
                    <span class="input-group-text">ถึง</span>
                    <input type="text" class="form-control datepicker" name="end_date" placeholder="วันที่สิ้นสุด" value="<?php echo $end_date; ?>" required readonly>
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </div>
            </form>





            <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-secondary" onclick="window.location.href='massDetail.php?ma_id=<?php echo $ma_id; ?>';">กลับ</button>
                <button type="button" class="btn btn-primary" onclick="printReport('<?php echo $p_id; ?>', '<?php echo $ma_id ?>')">พิมพ์</button>
            </div>

            <div class="text-end mb-4">
                <strong>รวมทั้งหมด:</strong> <?php echo $total; ?> รายการ
                <br>
                <strong>รวม:</strong> <?php echo $hour = $total * 1; ?> ชั่วโมง
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>วันที่</th>
                        <th>ผู้ใช้บริการ</th>
                        <th>เวลา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($rs = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rs['b_date']; ?></td>
                            <td><?php echo $rs['name']; ?></td>
                            <td><?php echo $rs['b_time']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                $('.datepicker').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    yearRange: "-100:+10",
                    showAnim: "fadeIn"

                });
            });

            function printReport(p_id, ma_id) {
                var win = window.open('print_report_mass.php?p_id=' + p_id + '&ma_id=' + ma_id, '_blank');
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