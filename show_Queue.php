<?php
    include "module/connect.php";
    $p_id = $_GET['p_id'];

    $sql = "SELECT * FROM queue_table WHERE p_id = '$p_id'";

    $result = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_assoc($result);

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

    <main>
        <div class="container">
            <h2 class="mb-4">ข้อมูลคิวนวดแผนไทย</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>วันที่</th>
                            <th>เวลา</th>
                            <th>ประเภทการนวด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rs = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $rs['qt_id']; ?></td>
                                <td><?php echo $rs['qt_date']; ?></td>
                                <td><?php echo $rs['quota']; ?></td>
                                <td><?php echo $rs['qt_time']; ?></td>
                                <td>
                                    <a href="module/delete_Queue.php?queue_id=<?php echo $rs['queue_id']; ?>" class="btn btn-danger">ลบ</a>
                                </td>
                            </tr>
                        <?php
                            mysqli_close($conn);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>