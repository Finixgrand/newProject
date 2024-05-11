<?php
    include 'connect.php';

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $id_card = $_POST['id_card'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];

    $sql = "INSERT INTO masseuse (ma_name, ma_gender, ma_age, ma_id_card, ma_address, ma_tel) 
            VALUES ('$name', '$gender', '$age', '$id_card', '$address', '$tel')";

    mysqli_query($conn, $sql)
        or die("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);

    echo "<script language=\"javascript\">";
    echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
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