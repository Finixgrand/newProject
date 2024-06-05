<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $b_date = $_POST['qt_date'];
    $b_time = $_POST['qt_time'];
    $qt_id = $_POST['qt_id'];
    $u_name = $_SESSION['valid_uname'];
    $p_id = $_POST['p_id'];
    $quota = $_POST['quota'];


    // ตรวจสอบว่าโควต้าการจองได้ถูกเต็มหรือไม่
    $sql_count = "SELECT COUNT(qt_id) AS booked_count FROM booking WHERE qt_id = '$qt_id'";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $booked_count = $row_count['booked_count'];

    // ตรวจสอบว่าผู้ใช้ได้จองคิวเวลานี้ไปแล้วหรือไม่
    $sql_time = "SELECT COUNT(b_time) as b_count FROM booking WHERE qt_id = '$qt_id' AND u_name = '$u_name'";
    $result_time = mysqli_query($conn, $sql_time);
    $row_time = mysqli_fetch_assoc($result_time);
    $booked_time = $row_time['b_count'];

    if ($booked_count == $quota) {
        echo "<script>alert('ไม่สามารถทำการจองได้เนื่องจากโควต้าการจองได้ถูกเต็มแล้ว'); window.location='../add_Booking.php';</script>";
        exit();
    } else {
        if ($booked_time != 0) {
            echo "<script>alert('คุณได้จองคิวเวลานี้ไปแล้ว'); window.location='../add_Booking.php';</script>";
            exit();
        } else {
            $sql_booking = "INSERT INTO booking (b_time, b_date, qt_id, u_name) 
                         VALUES ('$b_time', '$b_date', '$qt_id', '$u_name')";

            if (mysqli_query($conn, $sql_booking)) {
                echo "<script>alert('จองคิวเรียบร้อยแล้ว'); window.location='../cusHome.php';</script>";
                exit();
            } else {
                echo "<script>alert('ไม่สามารถบันทึกข้อมูลลูกค้าได้'); window.location='../add_Booking.php';</script>";
                exit();
            }
        }
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
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>