<?php
    include 'connect.php';
    $p_name = $_POST['p_name'];
    $p_start = $_POST['p_start'];
    $p_end = $_POST['p_end'];
    $max_hour = $_POST['max_hour'];
    $teacher = $_POST['teacher'];
    $total_mass = $_POST['total_mass'];

    $sql = "INSERT INTO program (p_name, p_start, p_end, max_hour, teacher, total_mass) 
            VALUES ('$p_name', '$p_start', '$p_end', '$max_hour', '$teacher', '$total_mass')";

    mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    echo "<script language=\"javascript\">";
	echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
	echo "window.location = '../showProject.php';";
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