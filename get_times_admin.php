<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    // รับค่าจาก AJAX request
    $qt_date = $_POST['qt_date']; 
    $p_id = $_POST['p_id']; 

    // สร้าง SQL Query เพื่อดึงข้อมูลเวลาที่ว่าง
    $sql = "SELECT queue_table.qt_time, queue_table.quota, queue_table.qt_id,
                   (SELECT COUNT(*) FROM booking WHERE booking.qt_id = queue_table.qt_id) AS booking_count
            FROM queue_table
            INNER JOIN program ON queue_table.p_id = program.p_id
            WHERE queue_table.qt_date = '$qt_date'
            AND program.p_id = '$p_id'
            ORDER BY queue_table.qt_time ASC";

    $result = mysqli_query($conn, $sql);

    // สร้าง array เพื่อเก็บข้อมูลที่ได้
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        // เปรียบเทียบระหว่าง queue_table.quota และ จำนวนแถวที่นับได้ของ booking.qt_id
        if ($row['booking_count'] < $row['quota']) {
            $data[] = array(
                "qt_time" => $row['qt_time'],
                "quota" => $row['quota'] - $row['booking_count'], // เหลือโควต้าเท่าไหร่
                "qt_id" => $row['qt_id']
            );
        }
    }

    // ส่งข้อมูลเป็น JSON กลับไปยังหน้าเว็บ
    echo json_encode($data);

} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
