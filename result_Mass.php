<?php
include 'module/connect.php';
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {

    $ma_id = $_GET['ma_id'];
    $p_id = $_GET['p_id'];

    $sql = "SELECT * FROM masseuse 
    INNER JOIN booking ON masseuse.ma_id = booking.ma_id 
    INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id 
    INNER JOIN program ON queue_table.p_id = program.p_id 
    INNER JOIN customer ON booking.u_name = customer.u_name
    WHERE program.p_id = $p_id AND masseuse.ma_id = $ma_id
    ORDER BY booking.b_date ASC, booking.b_time ASC";


    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql" . mysqli_error($conn));

    $sql_count = "SELECT COUNT(booking.b_id) AS total, program.p_name FROM booking
    INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id
    INNER JOIN program ON queue_table.p_id = program.p_id
    WHERE queue_table.p_id = $p_id AND booking.ma_id = $ma_id
    ORDER BY booking.b_date ASC, booking.b_time ASC";

    $result2 = mysqli_query($conn, $sql_count);
    $rs2 = mysqli_fetch_array($result2);
    $total = $rs2['total'];



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php
        include 'component/admin_nav.php';
        ?>

        <h3>สรุปรายการผู้นวด</h3>
        <h4> <?php echo $rs2['p_name'] ?> </h4>

        <main>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-start mt-5">
                            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
                            <button type="button" class="btn btn-primary" onclick="printReport('<?php echo $p_id; ?>', '<?php echo $ma_id ?>')">พิมพ์</button>
                        </div>
                        <br>
                        <div class="text-end">
                            รวมทั้งหมด &nbsp; <?php echo $total; ?> รายการ
                            <br>

                            รวม <?php echo $hour = $total * 1 ?> ชั่วโมง
                        </div>
                            <table class="table">
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
                                            <td><?php echo $i ?></td>
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
                    </div>
                </div>
          

            <script>
                function printReport(p_id, ma_id) {
                    var win = window.open('print_report_mass.php?p_id=' + p_id + '&ma_id=' + ma_id, '_blank');
                    win.focus();
                    win.onload = function() {
                        win.print();
                    }
                }
            </script>

        </main>
    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>