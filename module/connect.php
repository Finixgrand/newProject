<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "myproject";
      $conn = mysqli_connect($server,$user,$password);

      if (!$conn)
        die("1. ไม่สามารถติดต่อกับ MySQL ได้");

      mysqli_select_db($conn,$dbname)
        or die("2. ไม่สามารถเลือกใช้งานฐานข้อมูลได้");

    mysqli_set_charset($conn,"utf8");
?>