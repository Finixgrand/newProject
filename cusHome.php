<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $username = $_SESSION["valid_uname"];

    $sql = "SELECT * FROM user WHERE u_name = '$username'";

    $result = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_assoc($result);
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
        include 'component/user_nav.php';
        ?>

        <main>
            <h2 class="mb-4">หน้าแรก</h2>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">ข้อมูลส่วนตัว</h5>
                                <p class="card-text">ดูข้อมูลและแก้ไขข้อมูลส่วนตัว</p>
                                <a href="user_Detail.php" class="btn btn-primary">เข้าสู่หน้านี้</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">จองคิวนวดแผนไทย</h5>
                                <p class="card-text">ต้องการจองคิว</p>
                                <a href="add_Booking.php" class="btn btn-primary">เข้าสู่หน้านี้</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">ประวัติการใช้บริการ</h5>
                                <p class="card-text">การใช้บริการที่ผ่านมาทั้งหมด</p>
                                <a href="cus_History.php" class="btn btn-primary">เข้าสู่หน้านี้</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <br>
<div align="center">
        <h4>สวัสดี คุณ <?php echo $_SESSION["valid_uname"] ?></h4>
</div>
    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>