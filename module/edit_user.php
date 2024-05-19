<?php
    include 'connect.php';

    $cus_id = $_POST['cus_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $IDcardnumber = $_POST['IDcardnumber'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];

    $sql = "UPDATE customer SET name = '$name', gender = '$gender', age = '$age', 
    IDcardnumber = '$IDcardnumber', address = '$address', tel = '$tel' 
    WHERE cus_id = '$cus_id'";

    $row = mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    if($row) {
        echo "<script language=\"javascript\">";
        echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = '../user_Detail.php';";
        echo "</script>";
    } else {
        echo "<script language=\"javascript\">";
        echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
        echo "window.location = '../user_Detail.php';";
        echo "</script>";
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