<?php
require('fpdf/fpdf.php');
include "module/connect.php";

$p_id = $_GET['p_id'];
$ma_id = $_GET['ma_id'];

$sql = "SELECT * FROM masseuse 
INNER JOIN booking ON masseuse.ma_id = booking.ma_id 
INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id 
INNER JOIN program ON queue_table.p_id = program.p_id 
INNER JOIN customer ON booking.u_name = customer.u_name
WHERE program.p_id = $p_id AND masseuse.ma_id = $ma_id
ORDER BY booking.b_date ASC, booking.b_time ASC";

$result = mysqli_query($conn, $sql)
    or die("Error in query: $sql" . mysqli_error($conn));

$sql_count = "SELECT COUNT(booking.b_id) AS total, program.* FROM booking
INNER JOIN queue_table ON booking.qt_id = queue_table.qt_id
INNER JOIN program ON queue_table.p_id = program.p_id
WHERE queue_table.p_id = $p_id AND booking.ma_id = $ma_id";

$result2 = mysqli_query($conn, $sql_count);
$rs2 = mysqli_fetch_array($result2);
$total = $rs2['total'];

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 20, 15);

$pdf->Addfont('THSarabun', '', 'THSarabun.php');
$pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');

$pdf->AddPage();

$pdf->SetFont('THSarabun', 'B', 24);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'คลินิกแพทย์แผนไทย มหาวิทยาลัยราชภัฏเพชรบูรณ์'), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 20);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รายงานผู้นวดโครงการ ' . $rs2['p_name']), 0, 1, 'C');

$pdf->SetFont('THSarabun', '', 18);
$start_date = date('d/m/', strtotime($rs2['p_start'])) . (date('Y', strtotime($rs2['p_start'])) + 543);
$end_date = date('d/m/', strtotime($rs2['p_end'])) . (date('Y', strtotime($rs2['p_end'])) + 543);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', ' เริ่มต้น ' . $start_date . '  สิ้นสุด ' . $end_date), 0, 1, 'C');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(98, 10, iconv('UTF-8', 'TIS-620', ' พิมพ์วันที่ ' . date('d/m/') . (date('Y') + 543)), 0, 0, 'R');
$pdf->Cell(25, 10, iconv('UTF-8', 'TIS-620', '  เวลา '  . date('H:i น.', strtotime('+5 hours'))), 0, 1, 'R');
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'วันที่จอง'), 1, 0, 'C');
$pdf->Cell(85, 10, iconv('UTF-8', 'TIS-620', 'ผู้ใช้บริการ'), 1, 0, 'C');
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'เวลาใช้บริการ'), 1, 1, 'C');

$pdf->SetFont('THSarabun', '', 16);
$i = 1;
while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
    $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', $row['b_date']), 1, 0, 'C');
    $pdf->Cell(85, 10, iconv('UTF-8', 'TIS-620', $row['name']), 1, 0, 'C');
    $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', $row['b_time']), 1, 1, 'C');
    $i++;
}

$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รวมทั้งหมด ' . $total . ' รายการ'), 0, 1, 'R');

$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รวม ' . $hour = $total * 1 . ' ชั่วโมง'), 0, 1, 'R');

$pdf->Output();
