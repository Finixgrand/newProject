<?php
include 'module/connect.php';

if (isset($_POST['p_id']) && isset($_POST['qt_date'])) {
    $p_id = $_POST['p_id'];
    $qt_date = $_POST['qt_date'];

    $stmt = $conn->prepare("SELECT qt_id, qt_time FROM queue_table WHERE p_id = ? AND qt_date = ?");
    $stmt->bind_param("is", $p_id, $qt_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $times = [];
    while ($row = $result->fetch_assoc()) {
        $times[] = ['qt_id' => $row['qt_id'], 'qt_time' => $row['qt_time']];
    }
    
    echo json_encode($times);
    $stmt->close();
}
?>
