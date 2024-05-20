<?php
include 'module/connect.php';

$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/showcus.css?v=2">
</head>

<body>
    <?php
    include 'component/user_nav.php';
    ?>
    <div class="header"><h4>ข้อมูลผู้ใช้บริการ</h4></div>

    <main>
        <table align="center" class="search_tb" cellpadding="3">
            <tr>
                <td>
                    <input type="text" name="search" id="search" placeholder="ค้นหา">

                    <button>ค้นหา</button>
                </td>
            </tr>
        </table>

        <table align="center" class="main_tb">
            <th>เลขที่</th>
            <th>ชื่อ - นามสกุล</th>
            <th>&nbsp;</th>
            <?php
            while ($rs = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $rs['cus_id'] ?> <input type="hidden" name="cus_id" value="<?php echo "$rs[cus_id]"; ?>"></td>
                <td><?php echo $rs['name'] ?></td>
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
                    var cus_id = btn.parentElement.parentElement.querySelector("td").innerText;
                    document.location.href = "detailCusUser.php?cus_id=" + cus_id;
                });
            });
        </script>
    </main>
</body>

</html>