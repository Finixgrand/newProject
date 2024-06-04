<?php
include 'module/connect.php';

$p_id = $_POST['p_id'];
$qt_date = $_POST['qt_date'];

// Query to get qt_id and quota
$stmt = $conn->prepare("SELECT qt_id, quota FROM queue_table WHERE p_id = ? AND qt_date = ?");
$stmt->bind_param("is", $p_id, $qt_date);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

// Query to get qt_time
$stmt = $conn->prepare("SELECT qt_time FROM queue_table WHERE p_id = ? AND qt_date = ? ORDER BY qt_time ASC");
$stmt->bind_param("is", $p_id, $qt_date);
$stmt->execute();
$result = $stmt->get_result();

$times = [];
while ($row = $result->fetch_assoc()) {
    $times[] = $row['qt_time'];
}
$stmt->close();

$data['times'] = $times;

echo json_encode($data);
?>
