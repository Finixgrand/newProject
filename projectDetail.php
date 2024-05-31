<?php
include 'module/connect.php';
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    $p_id = $_GET['p_id'];

    // ดึงข้อมูลโครงการและอาจารย์ที่คุมโครงการ
    $sql = "SELECT program.*, teacher.t_name FROM program 
            LEFT JOIN teacher ON program.t_id = teacher.t_id 
            WHERE p_id = $p_id";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
    $rs = mysqli_fetch_array($result);

    // ดึงวันที่จาก qt_date สำหรับ select box
    $dateSql = "SELECT DISTINCT qt_date FROM queue_table WHERE p_id = $p_id ORDER BY qt_date ASC";
    $dateResult = mysqli_query($conn, $dateSql) or die("Error in query: $dateSql " . mysqli_error($conn));

    // ดึงวันที่ที่มีการจองเพื่อไฮไลต์ในปฏิทิน
    $dates = [];
    while ($dateRow = mysqli_fetch_assoc($dateResult)) {
        $dates[] = $dateRow['qt_date'];
    }
    $dates_json = json_encode($dates);

    $selected_date = $_GET['selected_date'] ?? null;

    $sql2 = "SELECT booking.*, customer.name, customer.age, customer.cus_id FROM booking 
             JOIN customer ON booking.u_name = customer.u_name
             JOIN queue_table ON booking.qt_id = queue_table.qt_id
             WHERE queue_table.p_id = $p_id";

    if ($selected_date) {
        $sql2 .= " AND booking.b_date = '$selected_date'";
    }

    $sql2 .= " ORDER BY booking.b_date ASC";
    $result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>รายละเอียดโครงการ</title>
        <link rel="stylesheet" type="text/css" href="css/projectdetail.css?v=3">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>

    <body>
        <?php include 'component/admin_nav.php'; ?>

        <div class="headtopic">
            <h4>รายละเอียดโครงการ</h4>
        </div>

        <div class="container">
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>รหัสโครงการ</th>
                            <th>ชื่อโครงการ</th>
                            <th>วันที่เริ่ม</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>อาจารย์ผู้คุม</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $rs['p_id']; ?></td>
                            <td><?php echo $rs['p_name']; ?></td>
                            <td><?php echo $rs['p_start']; ?></td>
                            <td><?php echo $rs['p_end']; ?></td>
                            <td><?php echo $rs['t_name']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-edit" name="btn_Edit">แก้ไข</button>
                                <button class="btn btn-danger btn-delete" onclick="del()">ลบ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            // ปุ่มแก้ไข ส่ง p_id เพื่อไปหน้า editproject.php
            document.querySelector('.btn-edit').addEventListener('click', function(event) {
                event.preventDefault();
                var p_id = <?php echo json_encode($rs['p_id']); ?>;
                document.location.href = "editProject.php?p_id=" + p_id;
            });

            // ปุ่มลบ ส่ง p_id เพื่อไปหน้า deleteproject.php
            function del() {
                var p_id = <?php echo json_encode($rs['p_id']); ?>;
                var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
                if (conf) {
                    document.location.href = "module/deleteproject.php?p_id=" + p_id;
                }
            }
        </script>

        <div class="container booking-section">
            <h5>รายการจอง</h5>
            <div class="text-end">
                <a href="add_Queue_admin.php?p_id=<?php echo $p_id; ?>" class="btn btn-success">เพิ่มการจอง</a>
            </div>

            <!-- เพิ่ม form สำหรับเลือกวันที่ -->
            <form method="get" action="projectDetail.php">
                <label for="datepicker">เลือกวันที่ &nbsp;</label>
                <input type="text" id="datepicker" name="selected_date" value="<?php echo $selected_date; ?>" readonly>
                <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">

            </form>

            <div class="table-responsive-sm mt-3">
                <?php if (mysqli_num_rows($result2) > 0) : ?>
                    <form action="" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>อายุ</th>
                                    <th>เวลาที่จอง</th>
                                    <th>ผู้นวด</th>
                                    <th>สถานะ</th>
                                    <th>พิมพ์</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rs2 = mysqli_fetch_array($result2)) : ?>
                                    <tr>
                                        <td><?php echo date("d-m-Y", strtotime($rs2['b_date'])); ?></td>
                                        <td><?php echo $rs2['name']; ?></td>
                                        <td><?php echo $rs2['age']; ?></td>
                                        <td><?php echo $rs2['b_time']; ?></td>

                                        <td>
                                            <?php
                                            if ($rs2['b_status'] == 0) {
                                                echo '<select name="ma_id" class="ma_id" data-b_date="' . $rs2['b_date'] . '" data-b_time="' . $rs2['b_time'] . '" data-booking-id="' . $rs2['b_id'] . '">';
                                                echo '<option value="">--เลือกผู้นวด--</option>';

                                                $sql3 = "SELECT * FROM masseuse";
                                                $result3 = mysqli_query($conn, $sql3);
                                                while ($rs3 = mysqli_fetch_array($result3)) {
                                                    echo "<option value=\"{$rs3['ma_id']}\"";
                                                    if ($rs3['ma_id'] == $rs2['ma_id']) {
                                                        echo ' selected';
                                                    }
                                                    echo ">{$rs3['ma_name']}</option>\n";
                                                }
                                                echo '</select>';
                                            } else {
                                                $sql3 = "SELECT * FROM masseuse";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $rs3 = mysqli_fetch_array($result3);
                                                echo "$rs3[ma_name]";
                                            }
                                            
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($rs2['b_status'] == 0) {
                                                echo '<button type="button" onclick="btn_con(' . $rs2['b_id'] . ', this.closest(\'tr\').querySelector(\'.ma_id\').value)" class="btn btn-success">ยืนยัน</button>';
                                            } else {
                                                echo "เข้ารับบริการแล้ว";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" onclick="printPage('<?php echo $rs2['cus_id']; ?>')">พิมพ์</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </form>
                <?php else : ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>อายุ</th>
                                <th>เวลาที่จอง</th>
                                <th>ผู้นวด</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" align="center">ยังไม่มีการจองคิว</td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

        </div>

        <div class="text-center my-4">
            <a href="showProject.php" class="btn btn-secondary">กลับ</a>
        </div>

        <script>
            function printPage(cus_id) {
                var win = window.open('print.php?cus_id=' + cus_id, '_blank');
                win.focus();
                win.onload = function() {
                    win.print();
                }
            }

            function btn_con(b_id, ma_id) {
                var conf = confirm("คุณต้องการยืนยันการจองใช่หรือไม่");
                if (conf) {
                    $.ajax({
                        url: 'module/confirm.php',
                        type: 'POST',
                        data: {
                            'b_id': b_id,
                            'ma_id': ma_id,
                            'status': 1
                        },
                        success: function(response) {
                            if (response.trim() === 'success') {
                                alert('ยืนยันการจองเรียบร้อยแล้ว');
                                location.reload();
                            } else {
                                alert('มีบางอย่างผิดพลาด: ' + response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            }


            // ปฏิทิน jQuery UI
            $(function() {
                var dates = <?php echo $dates_json; ?>;
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date) {
                        var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                        if (dates.includes(dateString)) {
                            return [true, "highlight-date"];
                        }
                        return [false, ""];
                    },
                    onSelect: function(dateText) {
                        this.form.submit();
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // ตรวจสอบเวลาที่ผู้นวดถูกเลือก
                $('.ma_id').change(function() {
                    var selectedMaId = $(this).val();
                    var selectedBDate = $(this).data('b_date');
                    var selectedBTime = $(this).data('b_time');
                    var bookingId = $(this).data('booking-id');

                    // AJAX request เพื่อตรวจสอบความสามารถในการจองของผู้นวด
                    $.ajax({
                        url: 'check_masseuse_availability.php',
                        type: 'POST',
                        data: {
                            ma_id: selectedMaId,
                            b_date: selectedBDate,
                            b_time: selectedBTime,
                            b_id: bookingId
                        },
                        success: function(response) {
                            if (response.trim() === 'invalid') {
                                alert('ผู้นวดที่คุณเลือกมีการจองไว้ในเวลาดังกล่าวแล้ว');
                                // ลบตัวเลือกที่ถูกเลือกแล้ว
                                $('.ma_id option:selected').prop('selected', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });
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

