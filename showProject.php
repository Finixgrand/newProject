<?php
include 'module/connect.php';

$sql = "SELECT * FROM program";
$result = mysqli_query($conn, $sql)
  or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/showproject.css?v=2">
</head>

<body>
  <?php
  include 'component/admin_nav.php';
  ?>

  <div class="headtopic">
    <h4>จัดการโครงการ</h4>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-sd-12">
        <div class="d-flex justify-content-end">
          <a href="addProject.php" class="btn btn-primary">เพิ่มโครงการ</a>
        </div>
        <br>
        <table class="table table-striped">
          <tr>
            <th>โครงการ</th>
            <th>เริ่มต้นโครงการ</th>
            <th>สิ้นสุดโครงการ</th>
            <th>&nbsp;</th>
          </tr>
          <?php
          while ($rs = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo "$rs[p_name]"; ?></td>
              <td><?php echo "$rs[p_start]"; ?></td>
              <td><?php echo "$rs[p_end]"; ?></td>
              <td align="center"><input type="hidden" name="p_id" value="<?php echo "$rs[p_id]"; ?>">
                <button class="btn btn-success" name="btn_q">สร้างคิว</button> &nbsp; <button class="btn btn-warning" name="btn_detail">รายละเอียด</button>
              </td>
            </tr>
          <?php
          }
          mysqli_close($conn);
          ?>
        </table>

      </div>
    </div>
  </div>

  <script>
    // ส่วนควบคุมปุ่มรายละเอียด ให้ลิงค์ไปหน้า projectDetail โดยส่ง p_id ไปด้วย
    var btn_details = document.getElementsByName("btn_detail");
    btn_details.forEach(function(btn) {
      btn.addEventListener("click", function() {
        var p_id = btn.parentElement.querySelector("input[name='p_id']").value;
        document.location.href = "projectDetail.php?p_id=" + p_id;
      });
    });

    var btnq = document.getElementsByName("btn_q");
    btnq.forEach(function(btn) {
      btn.addEventListener("click", function() {
        var p_id = btn.parentElement.querySelector("input[name='p_id']").value;
        document.location.href = "show_Queue.php?p_id=" + p_id;
      });
    });
  </script>


</body>

</html>