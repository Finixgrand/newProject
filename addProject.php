<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>เพิ่มโครงการ</title>
        <link rel="stylesheet" type="text/css" href="css/addProject.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            $(document).ready(function() {

                // เรียกใช้งาน Datepicker สำหรับ input เริ่มต้น
                $("#p_start").datepicker({
                    dateFormat: 'yy-mm-dd', // รูปแบบวันที่                
                    onSelect: function(selectedDate) {
                        // เมื่อเลือกวันที่เริ่ม กำหนดวันที่สิ้นสุดเป็นวันที่เริ่มต้นที่เลือกได้เท่านั้น
                        $("#p_end").datepicker("option", "minDate", selectedDate);
                    }
                });

                // เรียกใช้งาน Datepicker สำหรับ input สิ้นสุด
                $("#p_end").datepicker({
                    dateFormat: 'yy-mm-dd', // รูปแบบวันที่
                    minDate: '+1d' // วันที่เริ่มต้นที่สามารถเลือกได้คือวันที่พรุ่งนี้
                });

            });
        </script>

    </head>
    <?php
    include 'component/admin_nav.php';
    ?>

    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>เพิ่มโครงการ</h4>
                        </div>
                        <div class="card-body">
                            <form action="module/addproject.php" method="post">
                                <div class="mb-3">
                                    <label for="p_name" class="form-label">ชื่อโครงการ</label>
                                    <input type="text" name="p_name" id="p_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="p_start" class="form-label">วันที่เริ่ม</label>
                                    <input name="p_start" id="p_start" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="p_end" class="form-label">วันที่สิ้นสุด</label>
                                    <input name="p_end" id="p_end" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="t_id" class="form-label">อาจารย์ผู้คุม</label>
                                    <select name="t_id" id="t_id" class="form-select">
                                        <?php
                                        $sql = "SELECT * FROM teacher";
                                        $result = mysqli_query($conn, $sql);
                                        while ($rs = mysqli_fetch_array($result)) {
                                            echo "<option value='$rs[t_id]'>$rs[t_name]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="table-responsive" align="center">
                                    <a href="showProject.php" class="btn btn-secondary">กลับ</a>
                                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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