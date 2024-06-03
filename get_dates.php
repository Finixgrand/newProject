<?php
include 'module/connect.php';

$p_id = $_POST['p_id'];

$stmt = $conn->prepare("SELECT DISTINCT qt_date FROM queue_table WHERE p_id = ?");
$stmt->bind_param("i", $p_id);
$stmt->execute();
$result = $stmt->get_result();

$dates = [];
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['qt_date'];
}
$stmt->close();

echo json_encode($dates);
?>