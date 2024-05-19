<?php
  include 'module/connect.php';

  $sql = "SELECT * FROM booking";
  $result = mysqli_query($conn, $sql)
    or die("Error in query: $sql " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" type="text/css" href="css/showbooking.css">
    
</head>
<body>
    <?php include 'component/user_nav.php'; ?>
    
    <div class="container">
        <table class="head_tb">
            <tr>
                <th>การจองคิว</th>
            </tr>
        </table>
        
        <form action="your_action_page.php" method="post">
            <table align="center">
                <tr>
                    <td class="form-group">
                        <label for="name">ชื่อ - นามสกุล</label>
                        <input type="text" name="name">
                    </td>
                </tr>
                <tr>
                    <td class="form-group">
                        <label for="b_date">เลือกวันที่และเวลา</label>
                        <input type="datetime-local" name="b_date">
                    </td>
                </tr>
                <tr>
                    <td class="form-group">
                        <label for="massage">เลือกนวด</label>
                        <select name="massage" id="massage">
                            <option value="1">นวดแผนไทย</option>
                            <option value="2">นวดแผนจีน</option>
                            <option value="3">นวดแผนอินเดีย</option>
                            <option value="4">นวดแผนญี่ปุ่น</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="buttons">
                <input type="submit" value="ตกลง">
                <input type="reset" value="กลับ">
            </div>
        </form>
    </div>
</body>
</html>

