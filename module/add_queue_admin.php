<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    // รับค่าจากฟอร์ม
    $p_id = $_POST['p_id'];
    $b_date = $_POST['b_date'];
    $qt_id = $_POST['qt_id'];
    $b_time = $_POST['b_time'];
    $s_id = $_POST['s_id'];
    $name = $_POST['name'];
    $IDcardnumber = $_POST['IDcardnumber'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];

    // INSERT customer
    $sql_customer = "INSERT INTO customer (name, IDcardnumber, age, gender, address, tel) 
    VALUES ('$name', '$IDcardnumber', '$age', '$gender', '$address', '$tel')";


    if (mysqli_query($conn, $sql_customer)) {
        // INSERT booking
        $cus_id = mysqli_insert_id($conn);

        $sql_booking = "INSERT INTO booking (b_time, b_date, qt_id, s_id, cus_id) 
    VALUES ('$b_time', '$b_date', '$qt_id', '$s_id', '$cus_id')";

        if (mysqli_query($conn, $sql_booking)) {
            echo "<script language=\"javascript\">";
            echo "alert('บันทึกข้อมูลลูกค้าและตารางคิวเรียบร้อยแล้ว');";
            echo "window.location = '../projectDetail.php?p_id=" . $p_id . "';";
            echo "</script>";
        } else {
            echo "<script language=\"javascript\">";
            echo "alert('ไม่สามารถบันทึกข้อมูลลูกค้าได้');";
            echo "window.location = '../projectDetail.php?p_id=" . $p_id . "';";
            echo "</script>" . mysqli_error($conn);
        }
    } else {
        echo "<script language=\"javascript\">";
            echo "alert('ไม่สามารถบันทึกข้อมูลลูกค้าและตารางคิวได้');";
            echo "window.location = '../projectDetail.php?p_id=" . $p_id . "';";
            echo "</script>" . mysqli_error($conn);
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
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>