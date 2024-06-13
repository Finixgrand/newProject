<?php
require('fpdf/fpdf.php');
include "module/connect.php";

$p_id = $_GET['p_id'];
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$sql = "SELECT * FROM program WHERE p_id = '$p_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$p_name = $row['p_name'];
$p_start = $row['p_start'];
$p_end = $row['p_end'];

// ตรวจสอบค่า $start_date และ $end_date และปรับรูปแบบตามความเหมาะสม
if ($start_date && $end_date) {
    // SQL query เพื่อดึงข้อมูลโดยใช้ start_date และ end_date
} else {
    // SQL query เพื่อดึงข้อมูลโดยไม่ใช้ start_date และ end_date
}

if ($start_date && $end_date) {
    $sql2 = "SELECT * FROM booking 
             JOIN customer ON booking.u_name = customer.u_name
             JOIN queue_table ON booking.qt_id = queue_table.qt_id
             JOIN masseuse ON booking.ma_id = masseuse.ma_id
             WHERE queue_table.p_id = $p_id AND booking.b_date BETWEEN '$start_date' AND '$end_date'
             ORDER BY booking.b_date ASC , booking.b_time";

    $sql_count = "SELECT COUNT(booking.b_id) AS total, program.* FROM booking 
                  JOIN queue_table ON booking.qt_id = queue_table.qt_id
                  JOIN program ON queue_table.p_id = program.p_id
                  WHERE queue_table.p_id = $p_id AND booking.b_status = '1' AND booking.b_date BETWEEN '$start_date' AND '$end_date'";
} else {
    $sql2 = "SELECT * FROM booking 
             JOIN customer ON booking.u_name = customer.u_name
             JOIN queue_table ON booking.qt_id = queue_table.qt_id
             JOIN masseuse ON booking.ma_id = masseuse.ma_id
             WHERE queue_table.p_id = $p_id
             ORDER BY booking.b_date ASC , booking.b_time";

    $sql_count = "SELECT COUNT(booking.b_id) AS total, program.* FROM booking 
                  JOIN queue_table ON booking.qt_id = queue_table.qt_id
                  JOIN program ON queue_table.p_id = program.p_id
                  WHERE queue_table.p_id = $p_id AND booking.b_status = '1'";
}

$result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2" . mysqli_error($conn));
$result_count = mysqli_query($conn, $sql_count);
$rscnt = mysqli_fetch_array($result_count);
$total = $rscnt['total'];

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 20, 15);

$pdf->Addfont('THSarabun', '', 'THSarabun.php');
$pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');

$pdf->AddPage();

$pdf->SetFont('THSarabun', 'B', 24);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'คลินิกแพทย์แผนไทย มหาวิทยาลัยราชภัฏเพชรบูรณ์'), 0, 1, 'C');

$pdf->SetY($pdf->GetY() - 18);
$pdf->SetFont('THSarabun', '', 14);
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', 'พิมพ์วันที่'), 0, 1, 'R');
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', date('d/m/') . (date('Y')+543)) , 0, 1, 'R');
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', ' เวลา '  . date('H:i น.', strtotime('+5 hours'))), 0, 1, 'R');

$pdf->SetFont('THSarabun', 'B', 20);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รายงานโครงการ ' . $p_name), 0, 1, 'C');

$pdf->SetFont('THSarabun', '', 18);
$start_date_formatted = date('d/m/', strtotime($start_date)) . (date('Y', strtotime($start_date)) + 543);
$end_date_formatted = date('d/m/', strtotime($end_date)) . (date('Y', strtotime($end_date)) + 543);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', ' เริ่มต้น ' . $p_start . '  สิ้นสุด ' . $p_end), 0, 1, 'C');

$pdf->SetFont('THSarabun', '', 16);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'TIS-620', 'วันที่เลือก ' . $start_date_formatted . ' ถึงวันที่ ' . $end_date_formatted), 0, 'C');
$pdf->Cell(0, 5, '', 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'วันที่จอง'), 1, 0, 'C');
$pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', 'ชื่อ - นามสกุล'), 1, 0, 'C');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'เวลาจอง'), 1, 0, 'C');
$pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', 'ชื่อผู้นวด'), 1, 1, 'C');

$pdf->SetFont('THSarabun', '', 16);
$i = 1;
while ($row2 = mysqli_fetch_array($result2)) {
    $pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', date('d/m/Y', strtotime($row2['b_date']))), 1, 0, 'C');
    $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', $row2['name']), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', date('H:i', strtotime($row2['b_time']))), 1, 0, 'C');
    $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', $row2['ma_name']), 1, 1, 'C');
    $i++;
}

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(135, 10, iconv('UTF-8', 'TIS-620', 'รวมรายการทั้งสิ้น ' . $rscnt['total'] . ' รายการ'), 0, 0, 'R');
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'รวมทั้งสิ้น ' . $hour = $rscnt['total'] * 1 . ' ชั่วโมง'), 0, 1, 'R');
$pdf->Output();
?>
