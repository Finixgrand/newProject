<?php
include 'module/connect.php';

$sql = "SELECT * FROM masseuse";
$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/showmass.css?v=4">
</head>

<body>
    <?php
    include 'component/admin_nav.php';
    ?>

    <table align="center" class="head_tb">
        <tr>
            <th>จัดการโครงการ</th>
            <td align="right"><a href="./addMass.php"><u>เพิ่มผู้นวด</u></a></td>
        </tr>
    </table>

    <table class="main_tb" align="center" cellpadding="10">
        <tr>
            <th style="text-align:center" width="90px">ลำดับ</th>
            <th style="text-align:center">ชื่อ - นามสกุล</th>
            <th style="text-align:center">เพศ</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        while ($rs = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td align="center"><?php echo $rs['ma_id']; ?></td>
            <td><?php echo "$rs[ma_name]"; ?></td>
            <td align="center"><input type="hidden" name="gender" value="<?php echo $rs['ma_gender']; ?>">
        <?php if ($rs['ma_gender'] == 0) echo "ชาย"; else echo "หญิง"; ?></td>
            <td align="center"><button name="btn_detail">รายละเอียด</button></td>
        </tr>
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>

    <script>
        var btn_details = document.getElementsByName("btn_detail");
        btn_details.forEach(function(btn) {
            btn.addEventListener("click", function() {
                var ma_id = btn.parentElement.parentElement.querySelector("td").innerText;
                document.location.href = "massDetail.php?ma_id=" + ma_id;
            });
        });
    </script>
</body>

</html>