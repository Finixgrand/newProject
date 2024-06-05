<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $p_id = mysqli_real_escape_string($conn, $_POST['p_id']);
    $b_date = mysqli_real_escape_string($conn, $_POST['b_date']);
    $qt_id = mysqli_real_escape_string($conn, $_POST['qt_id']);
    $b_time_hidden = mysqli_real_escape_string($conn, $_POST['b_time_hidden']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $IDcardnumber = mysqli_real_escape_string($conn, $_POST['IDcardnumber']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $u_name = mysqli_real_escape_string($conn, $_POST['u_name']);
    $u_pass = mysqli_real_escape_string($conn, $_POST['u_pass']);
    $quota = mysqli_real_escape_string($conn, $_POST['quota']);


    // ตรวจสอบว่าโควต้าการจองได้ถูกเต็มหรือไม่
    $sql_count = "SELECT COUNT(qt_id) AS booked_count FROM booking WHERE qt_id = '$qt_id'";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $booked_count = $row_count['booked_count'];

    if ($booked_count == $quota) {
        echo "<script>alert('ไม่สามารถทำการจองได้เนื่องจากโควต้าการจองได้ถูกเต็มแล้ว'); window.location='../projectDetail.php?p_id=$p_id';</script>";
        exit();
    } else {

        $sql_customer = "INSERT INTO customer (name, IDcardnumber, age, address, tel, gender, u_name) 
                         VALUES ('$name', '$IDcardnumber', '$age', '$address', '$tel', '$gender', '$u_name')";

        if (mysqli_query($conn, $sql_customer)) {
            $cus_id = mysqli_insert_id($conn);

            $sql_booking = "INSERT INTO booking (b_time, b_date, qt_id, u_name) 
                            VALUES ('$b_time_hidden', '$b_date', '$qt_id', '$u_name')";

            if (mysqli_query($conn, $sql_booking)) {
                $sql_user = "INSERT INTO user (u_name, u_pass, u_type) VALUES ('$u_name', '$u_pass', 2)";
                mysqli_query($conn, $sql_user);

                echo "<script>alert('บันทึกข้อมูลลูกค้าและตารางคิวเรียบร้อยแล้ว'); window.location='../projectDetail.php?p_id=$p_id';</script>";
                exit();
            } else {
                echo "<script>alert('ไม่สามารถบันทึกข้อมูลลูกค้าได้'); window.location='../projectDetail.php?p_id=$p_id';</script>";
                exit();
            }
        } else {
            echo "<script>alert('ไม่สามารถบันทึกข้อมูลลูกค้าและตารางคิวได้'); window.location='../projectDetail.php?p_id=$p_id';</script>";
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
        <title>Booking Result</title>
    </head>

    <body>

    </body>

    </html>
<?php
} else {
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อน'); window.location='frm_login.php';</script>";
    exit();
}
?>