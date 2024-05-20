<?php

include 'connect.php';
// รับข้อมูลจากฟอร์ม
    $p_id = $_POST['p_id'];
    $qt_date = $_POST['qt_date'];
    $qt_time = $_POST['qt_time'];
    $qouta = $_POST['qouta'];
    $add_all_dates = isset($_POST['add_all_dates']) ? $_POST['add_all_dates'] : 0;

    // สร้าง SQL query สำหรับดึงวันที่จากตาราง program
    $sql_date = "SELECT p_start, p_end FROM program";
    $result_date = $conn->query($sql_date);

    if ($result_date->num_rows > 0) {
        // วนลูปผ่านแต่ละแถวข้อมูล
        while ($row_date = $result_date->fetch_assoc()) {
            $start_date = new DateTime($row_date["p_start"]);
            $end_date = new DateTime($row_date["p_end"]);

            // สร้างวันที่ระหว่าง p_start และ p_end
            for ($date = $start_date; $date <= $end_date; $date->modify('+1 day')) {
                // ตรวจสอบว่าเป็นวันจันทร์ถึงวันศุกร์หรือไม่ (1 = จันทร์, 5 = ศุกร์)
                if ($date->format('N') >= 1 && $date->format('N') <= 5) {
                    // ถ้า add_all_dates = 1 เพิ่มข้อมูลลงฐานข้อมูล
                    if ($add_all_dates == 1) {
                        $sql_insert = "INSERT INTO queue_table (qt_date, qt_time, quota, p_id) VALUES ('" . $date->format("Y-m-d") . "', '$qt_time', '$qouta', '$p_id')";
                        if ($conn->query($sql_insert) === TRUE) {
                            echo "<script language=\"javascript\">";
                            echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
                            echo "window.location = '../show_Queue.php?p_id=" . $p_id . "';";
                            echo "</script>";
                        } else {
                            echo "Error: " . $sql_insert . "<br>" . $conn->error;
                        }
                    } else {
                        // เปรียบเทียบ qt_date กับวันที่ปัจจุบันในฟอร์แมต "Y-m-d"
                        $qt_date_obj = DateTime::createFromFormat("d/m/YY", $qt_date);
                        if ($qt_date_obj && $qt_date_obj->format("d/m/YY") == $date->format("d/m/YY")) {
                            $sql_insert = "INSERT INTO queue_table (qt_date, qt_time, quota, p_id) VALUES ('" . $date->format("Y-m-d") . "', '$qt_time', '$qouta', '$p_id')";
                            if ($conn->query($sql_insert) === TRUE) {
                                echo "<script language=\"javascript\">";
                                echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
                                echo "window.location = '../show_Queue.php?p_id=" . $p_id . "';";
                                echo "</script>";
                            } else {
                                echo "Error: " . $sql_insert . "<br>" . $conn->error;
                            }
                            // หยุดการวนลูปหลังจากที่เพิ่มข้อมูลลงฐานข้อมูล
                            break 2;
                        }
                    }
                }
            }
        }
    } else {
        echo "0 results";
    }

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>