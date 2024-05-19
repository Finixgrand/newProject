<?php
    include "connect.php";

    $s_name = $_POST['s_name'];

    $sql = "INSERT INTO service (s_name) VALUES ('$s_name')";

    mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    echo "<script language=\"javascript\">";
    echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
    echo "window.location = '../showService.php';";
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