<?php
include 'module/connect.php';

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $sql = "SELECT qt_id, qt_time FROM queue_table WHERE qt_date = '$date'";
    $result = mysqli_query($conn, $sql);

    $times = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $times[] = $row;
    }

    foreach ($times as $time) {
        echo "<option data-qt_id='{$time['qt_id']}' value='{$time['qt_time']}'>{$time['qt_time']}</option>";
    }
}
?>
