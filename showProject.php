<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_upass"]) && isset($_SESSION["valid_utype"])) {
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
  <title>จัดการโครงการ</title>
  <style>
    .container {
      margin-top: 50px;
    }
    .headtopic {
      margin-bottom: 20px;
    }
    .table th, .table td {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php include 'component/admin_nav.php'; ?>

  <div class="container">
    <div class="headtopic">
      <h3 class="text-center">จัดการโครงการ</h3>
    </div>

    <h5>สวัสดีคุณ <?php echo $_SESSION["valid_uname"] ?></h5>

    <div class="d-flex justify-content-end mb-3">
      <a href="addProject.php" class="btn btn-primary">เพิ่มโครงการ</a>
    </div>

    <table class="table table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th scope="col">โครงการ</th>
          <th scope="col">เริ่มต้นโครงการ</th>
          <th scope="col">สิ้นสุดโครงการ</th>
          <th scope="col">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($rs = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $rs['p_name']; ?></td>
            <td><?php echo $rs['p_start']; ?></td>
            <td><?php echo $rs['p_end']; ?></td>
            <td>
              <input type="hidden" name="p_id" value="<?php echo $rs['p_id']; ?>">
              <button class="btn btn-success" name="btn_q">จัดการตารางเวลา</button> &nbsp; &nbsp; &nbsp; 
              <button class="btn btn-warning" name="btn_detail">รายละเอียด</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <script>
    document.querySelectorAll("[name='btn_detail']").forEach(btn => {
      btn.addEventListener("click", function() {
        const p_id = btn.closest("td").querySelector("input[name='p_id']").value;
        document.location.href = "projectDetail.php?p_id=" + p_id;
      });
    });

    document.querySelectorAll("[name='btn_q']").forEach(btn => {
      btn.addEventListener("click", function() {
        const p_id = btn.closest("td").querySelector("input[name='p_id']").value;
        document.location.href = "show_Queue.php?p_id=" + p_id;
      });
    });
  </script>
</body>

</html>
<?php
    mysqli_close($conn);
} else {
    echo "<script> alert('Please Login'); window.location='frm_login.php';</script>";
    exit();
}
?>
