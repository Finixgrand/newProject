<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $p_id = mysqli_real_escape_string($conn, $_POST['p_id']);
    $b_date = mysqli_real_escape_string($conn, $_POST['b_date']);
    $qt_id = mysqli_real_escape_string($conn, $_POST['qt_id']); 
    $b_time = mysqli_real_escape_string($conn, $_POST['b_time']);
    $u_name = mysqli_real_escape_string($conn, $_POST['u_name']);
    $quota = mysqli_real_escape_string($conn, $_POST['quota']);
    
    // ตรวจสอบว่าโควต้าการจองได้ถูกเต็มหรือไม่
    $sql_count = "SELECT COUNT(qt_id) AS booked_count FROM booking WHERE qt_id = '$qt_id'";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $booked_count = $row_count['booked_count'];

    if ($booked_count == $quota) 
    {
        echo "<script>alert('ไม่สามารถทำการจองได้เนื่องจากโควต้าการจองได้ถูกเต็มแล้ว'); window.location='../projectDetail.php?p_id=$p_id';</script>";
        exit();
    } 
    else 
    {  
            $sql_booking = "INSERT INTO booking (b_time, b_date, qt_id, u_name) 
                            VALUES ('$b_time', '$b_date', '$qt_id', '$u_name')";

            if (mysqli_query($conn, $sql_booking)) 
            {
                echo "<script>alert('บันทึกคิวเรียบร้อยแล้ว'); window.location='../projectDetail.php?p_id=$p_id';</script>";
                exit();
            } 
            else 
            {
                echo "<script>alert('ไม่สามารถบันทึกข้อมูลลูกค้าได้'); window.location='../projectDetail.php?p_id=$p_id';</script>";
                exit();
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