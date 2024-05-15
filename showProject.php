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
    <link rel="stylesheet" type="text/css" href="css/show.css">
</head>
<body>
<?php
    include 'component/admin_nav.php';
?>

<table align="center" class="top">
  <tr>
    <th>จัดการโครงการ</th>
    <td align="right"><a href="./addProject.php"><u>เพิ่มโครงการ</u></a></td>
  </tr>
</table>

<table align="center"  class="show">
  <tr>
    <th>โครงการ</th>
    <td ></td>
  </tr>
  <?php 
    while($rs = mysqli_fetch_array($result)) {
  ?>
  <tr>
    <td><?php echo "$rs[p_name]"; ?></td>
    <td align="center"><input type="hidden" name="p_id" value="<?php echo "$rs[p_id]"; ?>">
    <button name="btn_detail">รายละเอียด</button></td>
  </tr>
  <?php
    }
    mysqli_close($conn);
  ?>
</table>

<script> // ส่วนควบคุมปุ่มรายละเอียด ให้ลิงค์ไปหน้า projectDetail โดยส่ง p_id ไปด้วย
    var btn_details = document.getElementsByName("btn_detail");
    btn_details.forEach(function(btn) {
        btn.addEventListener("click", function() {
            var p_id = btn.parentElement.querySelector("input[name='p_id']").value;
            document.location.href = "projectDetail.php?p_id=" + p_id;
        });
    });
</script>


</body>
</html>
