<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';


$p_id = $_GET['p_id'];

// ตรวจสอบว่ามีการส่งค่าวันที่จากฟอร์มหรือไม่
if (isset($_POST['selected_date'])) {
    $selected_date = $_POST['selected_date'];
} else {
    $selected_date = null;
}

$sql = "SELECT * FROM queue_table WHERE p_id = '$p_id'";
if ($selected_date) {
    // แปลงค่าวันที่ให้เป็นฟอร์แมตที่ตรงกับในฐานข้อมูล
    $selected_date_db = DateTime::createFromFormat('d/m/Y', $selected_date)->format('Y-m-d');
    $sql .= " AND qt_date = '$selected_date_db'";
}

$result = mysqli_query($conn, $sql);

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
    <?php include 'component/admin_nav.php'; ?>

    <main>
        <div class="container">
            <h2 class="mb-4">ข้อมูลคิวนวดแผนไทย</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h4><?php echo $rs2['p_name']; ?></h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <div align="right"><a href="add_Queue.php?p_id=<?php echo $p_id; ?>" class="btn btn-primary mb-3">เพิ่มคิว</a></div>
                    <div align="center">
                        <form method="post" action="show_Queue.php?p_id=<?php echo $p_id; ?>">
                            เลือกวันที่ &nbsp;&nbsp;
                            <?php
                            // สร้าง SQL query สำหรับดึงวันที่จากตาราง program
                            $sql_date = "SELECT p_start, p_end FROM program WHERE p_id = $p_id";
                            $result_date = $conn->query($sql_date);

                            // สร้าง select box
                            echo '<select name="selected_date" onchange="this.form.submit()">';
                            echo '<option value="">แสดงทั้งหมด</option>'; // ตัวเลือกสำหรับเลือกวันที่
                            if ($result_date->num_rows > 0) {
                                // วนลูปผ่านแต่ละแถวข้อมูล
                                while ($row_date = $result_date->fetch_assoc()) {
                                    $start_date = new DateTime($row_date["p_start"]);
                                    $end_date = new DateTime($row_date["p_end"]);

                                    // สร้างวันที่ระหว่าง p_start และ p_end
                                    for ($date = $start_date; $date <= $end_date; $date->modify('+1 day')) {
                                        // ตรวจสอบว่าเป็นวันจันทร์ถึงวันศุกร์หรือไม่ (1 = จันทร์, 5 = ศุกร์)
                                        if ($date->format('N') >= 1 && $date->format('N') <= 5) {
                                            $selected = ($date->format("d/m/Y") == $selected_date) ? 'selected' : '';
                                            echo "<option value='" . $date->format("d/m/Y") . "' $selected>" . $date->format("d/m/Y") . "</option>";
                                        }
                                    }
                                }
                            } else {
                                echo "0 results";
                            }
                            echo '</select>';
                            ?>
                        </form>
                    </div>
                    <br>

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>คิวที่เปิดรับได้</th>
                                <th>เวลา</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($rs = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $rs['quota']; ?></td>
                                    <td><?php echo $rs['qt_time']; ?></td>
                                    <td>
                                        <a href="module/delete_queue.php?queue_id=<?php echo $rs['qt_id']; ?>" class="btn btn-danger">ลบ</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>


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