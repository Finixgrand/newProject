<?php
include 'connect.php';

$b_id = $_POST['b_id'];
$b_date = $_POST['b_date'];
$cus_id = $_POST['cus_id'];
$qt_id = $_POST['qt_id'];

$sql = "INSERT INTO booking (, b_id, b_date, cus_id, qt_id) 
VALUES ('$b_id', '$b_date', '$cus_id', '$qt_id')";

mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
mysqli_close($conn);

echo "<script language=\"javascript\">";
echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
echo "window.location = '../showbooking.php';";
echo "</script>";

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