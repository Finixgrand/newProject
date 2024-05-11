<?php
include 'module/connect.php';

$ma_id = $_GET['ma_id'];

  $sql = "SELECT * FROM masseuse WHERE ma_id = $ma_id";
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
</head>
<body>
  <?php
  include 'component/admin_nav.php';
  ?>
  <p>ข้อมูลผู้นวด</p>

  <table>
    <tr>
      <td>รหัส</td>
      <td><?php echo "$rs[ma_id]"; ?> <input type="hidden" name="ma_id" value="<?php echo $rs['ma_id']; ?>"></td>
    <tr>
      <td>ชื่อ</td>
      <td><?php echo "$rs[ma_name]"; ?></td>
    </tr>
    <tr>
      <td>เพศ</td>
      <td><?php if ($rs['ma_gender'] == 0) echo "ชาย"; else echo "หญิง"; ?></td>
    </tr>
    <tr>
      <td>อายุ</td>
      <td><?php echo "$rs[ma_age]"; ?></td>
    </tr>
    <tr>
      <td>เลขประจำตัวประชาชน</td>
      <td><?php echo "$rs[ma_id_card]"; ?></td>
    </tr>
    <tr>
      <td>ที่อยู่</td>
      <td><?php echo "$rs[ma_address]"; ?></td>
    </tr>
    <tr>
      <td>เบอร์โทรศัพท์</td>
      <td><?php echo "$rs[ma_tel]"; ?></td>
    </tr>
  </table>

  <br>
    <div align="center"> <!-- ปุ่มย้อนกลับ แก้ไข ลบ -->
    <button onclick="window.history.back();">กลับ</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <button name="btn_Edit">แก้ไข</button> &nbsp;&nbsp;&nbsp;&nbsp; 
    <button onclick="del()">ลบ</button>
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
        if(conf) {
            document.location.href = "module/deletemass.php?ma_id=" + ma_id;
        }
    }
    </script>

    
    
</body>
</html>