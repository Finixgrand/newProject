<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
    include 'module/connect.php';

    $search = "";
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    }

    // Updated SQL query to include search filter
    $sql = "SELECT * FROM customer WHERE u_name LIKE '%$search%' OR name LIKE '%$search%'";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้ใช้บริการ</title>
    <link rel="stylesheet" type="text/css" href="css/showcus.css?v=2">

</head>

<body>
    <?php include 'component/admin_nav.php'; ?>
    <div class="row">
        <div class="col-12">    
                <h3>ข้อมูลผู้ใช้บริการ</h3>
        </div>
        </div>
    <div class="container mt-4">
        

        <div class="row">
            <div class="col-md-6 mb-3">
                <form method="post" action="" class="d-flex">
                    <input type="text" name="search" id="search" class="form-control me-2" placeholder="ค้นหา" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </form>
            </div>
            <!-- <div class="col-md-6 text-end">
                <a href="./addCus.php" class="btn btn-success"><u>เพิ่มผู้ใช้บริการ</u></a>
            </div> -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center" style="width: 15%;">User</th>
                                <th class="text-center" style="width: 50%;">ชื่อ - นามสกุล</th>
                                <th class="text-center" style="width: 35%;">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($rs = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo htmlspecialchars($rs['u_name']); ?></td>
                                    <td><?php echo htmlspecialchars($rs['name']); ?></td>
                                    <td class="text-center"><a href="detailCus.php?u_name=<?php echo urlencode($rs['u_name']); ?>" class="btn btn-info btn-sm">รายละเอียด</a></td>
                                </tr>
                            <?php
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
} else {
    echo "<script> alert('กรุณาเข้าสู่ระบบ'); window.location='frm_login.php';</script>";
    exit();
}
?>
