<?php
include 'module/connect.php';

$sql = "SELECT * FROM customer WHERE cus_id = $_GET[cus_id]";
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
    <link rel="stylesheet" type="text/css" href="css/detailcus.css">
</head>

<body>
    <?php
    include 'component/admin_nav.php';
    ?>

    <main>
        <h2 class="mb-4">ข้อมูลผู้ใช้บริการ</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>เพศ</th>
                        <th>อายุ</th>
                        <th>เลขประจำตัวประชาชน</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo "$rs[cus_id]"; ?> <input type="hidden" name="cus_id" value="<?php echo $rs['cus_id']; ?>"></td>
                        <td><?php echo "$rs[name]"; ?></td>
                        <td><?php if ($rs['gender'] == 0) echo "ชาย";
                            else echo "หญิง"; ?></td>
                        <td><?php echo "$rs[age]"; ?></td>
                        <td><?php echo "$rs[IDcardnumber]"; ?></td>
                        <td><?php echo "$rs[address]"; ?></td>
                        <td><?php echo "$rs[tel]"; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4"> <!-- ปุ่มย้อนกลับ แก้ไข ลบ -->
            <button onclick="window.history.back();" class="btn btn-secondary mr-2">กลับ</button>
            <button name="btn_Edit" class="btn btn-primary mr-2">แก้ไข</button>
            <button onclick="del()" class="btn btn-danger">ลบ</button>
        </div>

        <br>

        <script>
            var btn_Edit = document.getElementsByName("btn_Edit")[0];
            btn_Edit.addEventListener("click", function(event) {
                event.preventDefault();
                var cus_id = document.querySelector("input[name='cus_id']").value;
                document.location.href = "editCus.php?cus_id=" + cus_id;
            });
        </script>

        <script>
            function del() {
                if (confirm("ยืนยันการลบข้อมูล")) {
                    var cus_id = document.querySelector("input[name='cus_id']").value;
                    document.location.href = "module/deletecus.php?cus_id=" + cus_id;
                }
            }
        </script>


        <div class="container">
            <h5>ประวัติการใช้บริการ</h5>
            <div class="table-responsive-sm mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>วันที่ใช้บริการ</th>
                            <th>ประเภทที่มาใช้บริการ</th>

                            <th>ผู้นวด</th>
                            <th>หมายเหตุ</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>12/12/2563</td>
                            <td>นวดพุง</td>

                            <td>มาสาย</td>
                            <td>มาสวย</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>