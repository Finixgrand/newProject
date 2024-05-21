<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';


$sql = "SELECT * FROM masseuse as ma, result as re WHERE ma.ma_id = re.ma_id";

$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));

    
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

    <div class="headtopic">
        <h4>รายงานโครงการ</h4>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sd-12">
                
                <br>
                <table class="table table-striped">
                    <tr>
                        <th>ชื่อ</th>
                        <th>จำนวนชั่วโมงสะสม</th>
                        <th>คะแนนที่ได้</th>
                        <th>คะแนนเฉลี่ย</th>
                        <th>ผลการประเมิน</th>
                    </tr>
                    <?php
                    while ($rs = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo "$rs[ma_name]"; ?></td>
                            <td><?php echo "$rs[hour]"; ?></td>
                            <td><?php echo "$rs[re_point]"; ?></td>
                            <td><?php echo "$rs[re_sum]"; ?></td>
                            <td><?php echo "$rs[total]"; ?></td>
                        </tr>
                    <?php
                    }
                    mysqli_close($conn);
                    ?>
                </table>

            </div>
        </div>
</body>
</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>