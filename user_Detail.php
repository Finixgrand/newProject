<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $username = $_SESSION["valid_uname"];

    $sql = "SELECT * FROM customer INNER JOIN user ON customer.u_name = user.u_name WHERE user.u_name = '$username'";
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
            <div class="container">
                <h2 class="mb-4">ข้อมูลผู้ใช้บริการ</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>ชื่อ - นามสกุล</th>
                                <th>เพศ</th>
                                <th>อายุ</th>
                                <th>เลขประจำตัวประชาชน</th>
                                <th>ที่อยู่</th>
                                <th>เบอร์โทรศัพท์</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>"></td>
                                <td><?php echo "$rs[name]"; ?></td>
                                <td><?php if ($rs['gender'] == 0) echo "ชาย";
                                    else echo "หญิง"; ?></td>
                                <td><?php echo "$rs[age]"; ?></td>
                                <td><?php echo "$rs[IDcardnumber]"; ?></td>
                                <td><?php echo "$rs[address]"; ?></td>
                                <td><?php echo "$rs[tel]"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4"> <!-- ปุ่มย้อนกลับ แก้ไข ลบ -->
                    <button onclick="window.history.back();" class="btn btn-secondary mr-2">กลับ</button>
                    <button name="btn_Edit" class="btn btn-primary mr-2">แก้ไข</button>
                </div>
            </div>

        </main>

        <script>
            document.querySelector('[name="btn_Edit"]').addEventListener('click', function() {
                window.location = 'edit_User.php';
            });
        </script>
    </body>
    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>