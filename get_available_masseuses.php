<?php
include 'connect.php';

if (isset($_POST['qt_id'])) {
    $qt_id = $_POST['qt_id'];

    // ดึงข้อมูลผู้นวดที่ยังไม่มีการจองใน qt_id นี้
    $sql = "SELECT * FROM masseuse WHERE ma_id NOT IN (SELECT ma_id FROM booking WHERE qt_id = '$qt_id')";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

    $masseuses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $masseuses[] = $row;
    }

    echo json_encode($masseuses);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>
