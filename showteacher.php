<?php
include "module/connect.php";

$sql = "SELECT * FROM teacher";
$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'component/admin_nav.php';
    ?>
    <h2 class="mb-4">รายชื่ออาจารย์</h2>

    <main>

        <div class="table-responsive">
            <a href="addTeacher.php" class="btn btn-primary">เพิ่มอาจารย์</a>
        </div>
        <br>

        <table class="table">
            <tr>
                <th>
                    ลำดับที่
                </th>
                <th>
                    ชื่อ - นามสกุล
                </th>
                <th>
                    ที่อยู่
                </th>
                <th>
                    เบอร์โทรศัพท์
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            <?php
            while ($rs = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td>
                        <?php echo $rs['t_id'] ?>
                    </td>
                    <td>
                        <?php echo "$rs[t_name]"; ?>
                    </td>
                    <td>
                        <?php echo "$rs[t_address]"; ?>
                    </td>
                    <td>
                        <?php echo "$rs[t_tel]"; ?>
                    </td>
                    <td>
                        <button class="btn btn-warning">แก้ไข</button>
                        <button class="btn btn-danger">ลบ</button>
                    </td>
                </tr>
            <?php
            }
            mysqli_close($conn);
            ?>
        </table>

    </main>
</body>

</html>