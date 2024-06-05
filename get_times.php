<?php
include 'module/connect.php';

$p_id = $_POST['p_id'];
$qt_date = $_POST['qt_date'];

// Query to get qt_time, qt_id, and quota
$stmt = $conn->prepare("SELECT qt_time, qt_id, quota 
FROM queue_table WHERE p_id = ? AND qt_date = ? ORDER BY qt_time ASC");
$stmt->bind_param("is", $p_id, $qt_date);
$stmt->execute();
$result = $stmt->get_result();

$times = [];
while ($row = $result->fetch_assoc()) {
    $times[] = [
        "qt_time" => $row['qt_time'],
        "qt_id" => $row['qt_id'],
        "quota" => $row['quota']
    ];
}
$stmt->close();

echo json_encode(["times" => $times]);
?>
