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
    WHERE program.p_id = $p_id AND masseuse.ma_id = $ma_id";
    

    $result = mysqli_query($conn, $sql)
        or die("Error in query: $sql" . mysqli_error($conn));

    $sql_count = "SELECT COUNT(booking.b_id) AS total, program.p_name FROM booking
    INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id
    INNER JOIN program ON queue_table.p_id = program.p_id
    WHERE queue_table.p_id = $p_id AND booking.ma_id = $ma_id";

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
                        <div class="text-start">
                            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
                        </div>
                        <br>
                        <div class="text-end">
                        รวมรายการทั้งสิ้น &nbsp; <?php echo $total; ?> รายการ
                           <br>

                          รวมทั้งสิ้น <?php echo $hour = $total * 1.5 ?> ชั่วโมง
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>วันที่</th>
                                        <th>เวลา</th>
                                        <th></th>
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
                        <br>
        </main>
    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>