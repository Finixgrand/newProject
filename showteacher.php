<?php 

	include"connect.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="630" border="1" align="center" cellpadding="0" cellspacing="0">
<?php 
	include "head.php";
	include "admin_menu.php";
?>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <table width="480" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td>รายงานข้อมูลอาจารย์</td>
          <td align="right">[<a href="frm_addteacher.php">เพิ่มกลุ่มสาระ</a>]</td>
        </tr>
      </table>
      <table width="480" border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td width="80">รหัสอาจารย์</td>
          <td width="150">ชื่ออาจารย์</td>
          <td width="100">กลุ่มสาระ</td>
          <td width="49">&nbsp;</td>
          <td width="39">&nbsp;</td>
        </tr>
<?php
	while($rs = mysqli_fetch_array($result)) {
?>
        <tr>
          <td><?php echo "$rs[t_id]"; ?></td>
          <td><?php echo"<a href=\"frm_detailteacher.php?t_id=$rs[t_id]\">";?><?php echo "$rs[t_name]"; ?><?php echo"</a>"; ?></td>
          <td><?php echo "$rs[d_name]"; ?></td>
          <td><?php echo"<a href=\"frm_editteacher.php?t_id=$rs[t_id]\">";?>แก้ไข<?php echo"</a>"; ?></td>
          <td><?php echo"<a href=\"frm_delteacher.php?t_id=$rs[t_id]\">";?>ลบ<?php echo"</a>"; ?></td>
        </tr>
<?php
	}
	mysqli_close($conn);
?>
      </table>
<p>&nbsp;</p></td>
  </tr>
<?php
	include "foot.php";
?>
</table>
</body>
</html>
