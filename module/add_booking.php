<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

    $b_date = $_POST['qt_date'];
    $b_time = $_POST['qt_time'];
    $qt_id = $_POST['qt_id'];
    $u_name = $_SESSION['valid_uname'];

    $sql_cus = "SELECT * FROM customer WHERE u_name = '$u_name'"; 
    $result_cus = mysqli_query($conn, $sql_cus); 

    if (mysqli_num_rows($result_cus) > 0) {
        $row = mysqli_fetch_assoc($result_cus);
        $cus_id = $row['cus_id'];
    }

    $sql = "INSERT INTO booking (b_date, b_time, qt_id, u_name) 
    VALUES ('$b_date', '$b_time', '$qt_id', '$u_name')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script language=\"javascript\">";
        echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = '../cusHome.php';";
        echo "</script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }

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