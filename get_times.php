<?php
include 'module/connect.php';

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $p_id = $_POST['p_id'];
    $stmt = $conn->prepare("SELECT qt_id, qt_time FROM queue_table WHERE qt_date = ? AND p_id = ? ORDER BY qt_time ASC");
    $stmt->bind_param("si", $date, $p_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $times = [];
    while ($row = $result->fetch_assoc()) {
        $times[] = $row['qt_time'];
    }

    echo json_encode($times);
}
?>