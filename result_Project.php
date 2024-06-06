<?php
include 'module/connect.php';
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {

    $p_id = $_GET['p_id'];

    $sql = "SELECT booking.*, customer.*, masseuse.* FROM booking 
             JOIN customer ON booking.u_name = customer.u_name
             JOIN queue_table ON booking.qt_id = queue_table.qt_id
             JOIN masseuse ON booking.ma_id = masseuse.ma_id
             WHERE queue_table.p_id = $p_id
             ORDER BY booking.b_date ASC , booking.b_time";

    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql" . mysqli_error($conn));

    $sql_count = "SELECT COUNT(booking.b_id) AS total FROM booking 
    JOIN queue_table ON booking.qt_id = queue_table.qt_id
    JOIN program ON queue_table.p_id = program.p_id
    WHERE queue_table.p_id = $p_id";

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

        <h3>สรุปโครงการ</h3>
        <main>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <div class="text-end">
                           รวมรายการทั้งสิ้น &nbsp; <?php echo $total; ?> รายการ
                           <br>

                          รวมทั้งสิ้น <?php echo $hour = $total * 1.5 ?> ชั่วโมง
                        </div>
                        <br>
                        <div class="text-start">
                            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
                    </div>
                    <br>
                        <table class="table table-bordered">
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