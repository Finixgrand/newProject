<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
  include 'module/connect.php';

  $ma_id = $_GET['ma_id'];

  $sql = "SELECT * FROM masseuse WHERE ma_id = $ma_id";
  $result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
  $rs = mysqli_fetch_array($result);


  $sql_apply = "SELECT * FROM masseuse
  JOIN booking ON masseuse.ma_id = booking.ma_id
  JOIN queue_table ON booking.qt_id = queue_table.qt_id
  JOIN program ON queue_table.p_id = program.p_id
  WHERE masseuse.ma_id = $ma_id
  GROUP BY program.p_id
  ORDER BY program.p_id ASC";

  $result_apply = mysqli_query($conn, $sql_apply)
    or die("Error in query: $sql_apply " . mysqli_error($conn));


?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้นวด</title>

  </head>

  <body>
    <?php include 'component/admin_nav.php'; ?>

    <div class="container mt-5">
      <h2 class="mb-4">ข้อมูลผู้นวด</h2>

      <table class="table table-bordered">
        <thead class="table-dark gray">
          <tr>
            <th>รหัส</th>
            <th>ชื่อ</th>
            <th>เพศ</th>
            <th>อายุ</th>
            <th>เลขประจำตัวประชาชน</th>
            <th>ที่อยู่</th>
            <th>เบอร์โทรศัพท์</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $rs['ma_id']; ?><input type="hidden" name="ma_id" value="<?php echo $rs['ma_id']; ?>"></td>
            <td><?php echo $rs['ma_name']; ?></td>
            <td><?php echo $rs['ma_gender'] == 0 ? "ชาย" : "หญิง"; ?></td>
            <td><?php echo $rs['ma_age']; ?></td>
            <td><?php echo $rs['ma_card']; ?></td>
            <td><?php echo $rs['ma_address']; ?></td>
            <td><?php echo $rs['ma_tel']; ?></td>
          </tr>
        </tbody>
      </table>

      <div class="text-center mt-4">
        <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        <button class="btn btn-warning" name="btn_Edit">แก้ไข</button>
        <button class="btn btn-danger" onclick="del()">ลบ</button>
      </div>
    </div>

    <script>
      var btn_Edit = document.getElementsByName("btn_Edit")[0];

      btn_Edit.addEventListener("click", function(event) {
        event.preventDefault();
        var ma_id = document.querySelector("input[name='ma_id']").value;
        document.location.href = "editMass.php?ma_id=" + ma_id;
      });

      function del() {
        var ma_id = document.querySelector("input[name='ma_id']").value;
        var conf = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
        if (conf) {
          document.location.href = "module/deletemass.php?ma_id=" + ma_id;
        }
      }
    </script>

    <main>

      <div class="container mt-5">
        <h5>โครงการที่เข้าร่วม</h5>

        <table class="table table-bordered">
          <thead class="table-dark gray">
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อโครงการ</th>
              <th>เริ่มต้น</th>
              <th>สิ้นสุด</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            while ($rs_apply = mysqli_fetch_array($result_apply)) {
            ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs_apply['p_name'] ?></td>
                <td><?php echo $rs_apply['p_start'] ?></td>
                <td><?php echo $rs_apply['p_end'] ?></td>
                <td align="center"><input type="hidden" name="p_id" value="<?php echo $rs_apply['p_id']; ?>">
                  <button name="btn_Detail" class="btn btn-info">ดูรายละเอียด</button>
                </td>
              </tr>
            <?php
              $i++;
            }
            mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
      <script>
        var btn_Detail = document.querySelectorAll("button[name='btn_Detail']");
        btn_Detail.forEach(function(btn) {
          btn.addEventListener("click", function(event) {
            event.preventDefault();
            var ma_id = document.querySelector("input[name='ma_id']").value;
            var p_id = this.previousElementSibling.value; // get p_id from the hidden input field before the button
            document.location.href = "result_Mass.php?ma_id=" + ma_id + "&p_id=" + p_id; // add p_id to the URL
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