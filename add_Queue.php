<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

$p_id = $_GET['p_id'];



$sql2 = "SELECT p_name FROM program WHERE p_id = $p_id";
$result2 = mysqli_query($conn, $sql2);
$rs2 = mysqli_fetch_assoc($result2);
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

    <main>
        <div class="container">
            <h2 class="mb-4">เพิ่มคิวนวดแผนไทย</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="module/add_queue.php" method="post">
                        <div class="form-group">
                            <label for="p_id">ชื่อโครงการ</label>
                            <input type="text" class="form-control" name="p_id" value="<?php echo $rs2['p_name']; ?>" readonly>
                            <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="qt_date">วันที่</label>

                            <?php
                        // สร้าง SQL query สำหรับดึงวันที่จากตาราง program
                        $sql_date = "SELECT p_start, p_end FROM program WHERE p_id = $p_id";
                        $result_date = $conn->query($sql_date);

                        // สร้าง select box
                        echo '<select name="qt_date" id="qt_date">';
                        if ($result_date->num_rows > 0) {
                            // วนลูปผ่านแต่ละแถวข้อมูล
                            while ($row_date = $result_date->fetch_assoc()) {
                                $start_date = new DateTime($row_date["p_start"]);
                                $end_date = new DateTime($row_date["p_end"]);

                                // สร้างวันที่ระหว่าง p_start และ p_end
                                for ($date = $start_date; $date <= $end_date; $date->modify('+1 day')) {
                                    // ตรวจสอบว่าเป็นวันจันทร์ถึงวันศุกร์หรือไม่ (1 = จันทร์, 5 = ศุกร์)
                                    if ($date->format('N') >= 1 && $date->format('N') <= 5) {
                                        echo "<option value='" . $date->format("d/m/YY") . "'>" . $date->format("d/m/Y") . "</option>";
                                    }
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                        echo '</select>';
                        ?>
                    
                    <input type="checkbox" name="add_all_dates" value="1"> นำไปใช้ทั้งโครงการ<br>
                    
                        </div>
                        <div class="form-group">
                            <label for="qt_time">เวลาที่เริ่ม</label>
                            <input type="time" class="form-control" name="qt_time" required>
                        </div>
                        <div class="form-group">
                            <label for="qouta">จำนวนคิวที่รับ</label>
                            <input type="number" class="form-control" name="qouta" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
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