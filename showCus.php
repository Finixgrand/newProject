<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $sql = "SELECT GROUP_CONCAT(cus_id) as cus_ids, name, COUNT(*) as count FROM customer GROUP BY name";
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
        include 'component/admin_nav.php';
        ?>
        <div class="header">
            <h4>ข้อมูลผู้ใช้บริการ</h4>
        </div>

        <main>
            <table align="center" class="search_tb" cellpadding="3">
                <tr>
                    <td>
                        <input type="text" name="search" id="search" placeholder="ค้นหา">

                        <button>ค้นหา</button>
                    </td>
                    <td align="right">
                        <a href="./addCus.php"><u>เพิ่มผู้ใช้บริการ</u></a>
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
                        <td><?php echo $rs['cus_ids'] ?> <input type="hidden" name="cus_ids" value="<?php echo "$rs[cus_ids]"; ?>"></td>
                        <td><?php echo $rs['name'] ?></td> <input type="hidden" name="name" value="<?php echo "$rs[name]"; ?>">
                        <td align="center"><button name="btn_detail">รายละเอียด</button></td>
                    </tr>
                <?php
                }
                ?>
            </table>

            <script>
                var btn_details = document.getElementsByName("btn_detail");
                btn_details.forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        var cus_ids = btn.parentElement.parentElement.querySelector("td").innerText;
                        document.location.href = "detailCus.php?cus_ids=" + cus_ids;
                    });
                });
            </script>
        </main>
    </body>

    </html>
<?php
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
