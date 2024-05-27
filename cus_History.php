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
    <title>ประวัติการใช้บริการ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header {
            margin-top: 30px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'component/user_nav.php'; ?>
    <div class="container">
        <div class="header text-center">
            <h4>ประวัติการใช้บริการ</h4>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
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
                    echo "<tr><td colspan='3' class='text-center'>ไม่มีข้อมูล</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
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
