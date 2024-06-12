<?php
include 'module/connect.php';

$p_id = $_POST['p_id'];
$qt_date = $_POST['qt_date'];

$stmt = $conn->prepare("
    SELECT qt.qt_time, qt.qt_id, qt.quota, 
    (SELECT COUNT(b.qt_id) FROM booking b WHERE b.qt_id = qt.qt_id) AS booked
    FROM queue_table qt
    WHERE qt.p_id = ? AND qt.qt_date = ?
    ORDER BY qt.qt_time ASC
");
$stmt->bind_param("is", $p_id, $qt_date);
$stmt->execute();
$result = $stmt->get_result();

$times = [];
while ($row = $result->fetch_assoc()) {
    if ($row['booked'] < $row['quota']) {
        $times[] = [
            "qt_time" => $row['qt_time'],
            "qt_id" => $row['qt_id'],
            "quota" => $row['quota'],
            "booked" => $row['booked']
        ];
    }
}
$stmt->close();

echo json_encode(["times" => $times]);
?>
