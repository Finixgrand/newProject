<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
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
                <th>User</th>
                <th>ชื่อ - นามสกุล</th>
                <th>&nbsp;</th>
                <?php
                while ($rs = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $rs['u_name'] ?> <input type="hidden" name="cus_id" value="<?php echo "$rs[cus_id]"; ?>"></td>
                        <td><?php echo $rs['name'] ?> <input type="hidden" name="u_name" value="<?php echo "$rs[u_name]"; ?>"></td> 
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
            var u_name = btn.parentElement.parentElement.querySelector("td:nth-child(2)").querySelector("input[name='u_name']").value;
            document.location.href = "detailCus.php?u_name=" + u_name;
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