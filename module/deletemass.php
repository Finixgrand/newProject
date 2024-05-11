<?php
    include 'connect.php';

    $ma_id = $_GET['ma_id'];

    $sql = "DELETE FROM masseuse WHERE ma_id = '$ma_id'";

    mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    echo "<script language=\"javascript\">";
    echo "alert('ลบข้อมูลเรียบร้อยแล้ว');";
    echo "window.location = '../showMass.php';";
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