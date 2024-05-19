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
    <link rel="stylesheet" type="text/css" href="css/showcus.css?v=2">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 60%;
            margin: auto;
        }
        .head_tb {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
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
            </table>
            <div class="buttons">
                <input type="submit" value="ตกลง">
                <input type="reset" value="กลับ">
            </div>
        </form>
    </div>
</body>
</html>

