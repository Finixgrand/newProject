<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

$p_id = $_GET['p_id'];


$sql = "SELECT * FROM program WHERE p_id = $p_id";
$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
$rs = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/editproject.css">
</head>

<body>
    <?php
    include 'component/admin_nav.php';
    ?>

    <div class="headtopic">
        <h4>แก้ไขโครงการ</h4>
    </div>
    <form action="module/editproject.php" method="post">
        <table align="center" class="tb_detail">
            <tr>
                <td>รหัสโครงการ</td>
                <td><?php echo "$rs[p_id]"; ?> <input type="hidden" name="p_id" value="<?php echo "$rs[p_id]"; ?>"></td>
            </tr>
            <tr>
                <td>ชื่อโครงการ</td>
                <td><input type="text" name="p_name" value="<?php echo "$rs[p_name]"; ?>"></td>
            </tr>
            <tr>
                <td>วันที่เริ่ม</td>
                <td><input type="date" name="p_start" value="<?php echo "$rs[p_start]"; ?>"></td>
            </tr>
            <tr>
                <td>วันที่สิ้นสุด</td>
                <td><input type="date" name="p_end" value="<?php echo "$rs[p_end]"; ?>"></td>
            </tr>
            <tr>
                <td>อาจารย์ผู้คุม</td>
                <td><select name="t_id" id="t_id">
                        <?php
                        $sql2 = "SELECT * FROM teacher";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($rs2 = mysqli_fetch_array($result2)) {
                            echo "<option value=\"{$rs2['t_id']}\"";
                            if ($rs['t_id'] == $rs2['t_id']) {
                                echo ' selected';
                            }
                            echo ">{$rs2['t_name']}";
                            echo "</option>\n";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
        </table>
        <br>
        <div align="center"> <!-- ปุ่มแก้ไข ยกเลิก -->
            <a href="javascript:history.back()" class="btn">ยกเลิก</a> &nbsp;&nbsp;&nbsp;&nbsp; <button>บันทึก</button>
        </div>
    </form>
</body>

</html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>