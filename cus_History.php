<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $u_name = $_SESSION['valid_uname'];
    $sql = "SELECT booking.b_date, booking.b_time, service.s_name FROM booking 
            JOIN service ON booking.s_id = service.s_id 
            WHERE booking.u_name = '$u_name'";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'component/user_nav.php'; ?>
<div class="container">
    <div class="header">
        <h4>ประวัติการใช้บริการ</h4>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>วันที่เข้ารับบริการ</th>
                <th>เวลา</th>
                <th>ประเภทการใช้บริการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($rs = mysqli_fetch_array($result)) {
            ?>
                    <tr>
                        <td><?php echo $rs['b_date']; ?></td>
                        <td><?php echo $rs['b_time']; ?></td>
                        <td><?php echo $rs['s_name']; ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='3'>ไม่มีข้อมูล</td></tr>";
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
