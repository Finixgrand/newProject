<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'connect.php';

$p_id = $_POST['p_id'];
$p_name = $_POST['p_name'];
$p_start = $_POST['p_start'];
$p_end = $_POST['p_end'];
$max_hour = $_POST['max_hour'];
$t_id = $_POST['t_id'];
$total_mass = $_POST['total_mass'];



$sql = "UPDATE program SET p_name = '$p_name', p_start = '$p_start', 
    p_end = '$p_end', max_hour = '$max_hour', t_id = $t_id, total_mass = '$total_mass' 
    WHERE p_id = $p_id";

mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
mysqli_close($conn);


echo "<script language=\"javascript\">";
echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
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
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>