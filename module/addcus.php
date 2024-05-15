<?php
include 'connect.php';

$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$IDcardnumber = $_POST['IDcardnumber'];
$address = $_POST['address'];
$tel = $_POST['tel'];

$sql = "INSERT INTO customer (name, gender, age, IDcardnumber, address, tel) 
VALUES ('$name', '$gender', '$age', '$IDcardnumber', '$address', '$tel')";

mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
mysqli_close($conn);

echo "<script language=\"javascript\">";
echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
echo "window.location = '../showCus.php';";
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