<?php
include 'module/connect.php';

$ma_id = $_POST['ma_id'];
$b_date = $_POST['b_date'];
$b_time = $_POST['b_time'];
$booking_id = $_POST['booking_id'];

$sql = "SELECT * FROM booking 
        JOIN queue_table ON booking.qt_id = queue_table.qt_id
        WHERE queue_table.ma_id = $ma_id AND booking.b_date = '$b_date' AND booking.b_time = '$b_time' AND booking.b_id != $booking_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 'unavailable';
} else {
    echo 'available';
}
?>
