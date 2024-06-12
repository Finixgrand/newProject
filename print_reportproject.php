<?php
require('fpdf/fpdf.php');
include "module/connect.php";

$p_id = $_GET['p_id'];

$sql = "SELECT * FROM program WHERE p_id = '$p_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$p_name = $row['p_name'];

$sql2 = "SELECT * FROM booking 
             JOIN customer ON booking.u_name = customer.u_name
             JOIN queue_table ON booking.qt_id = queue_table.qt_id
             JOIN masseuse ON booking.ma_id = masseuse.ma_id
             WHERE queue_table.p_id = $p_id
             ORDER BY booking.b_date ASC , booking.b_time";

$result2 = mysqli_query($conn, $sql2)
    or die("Error in query: $sql2" . mysqli_error($conn));

$sql_count = "SELECT COUNT(booking.b_id) AS total, program.* FROM booking 
    JOIN queue_table ON booking.qt_id = queue_table.qt_id
    JOIN program ON queue_table.p_id = program.p_id
    WHERE queue_table.p_id = $p_id AND booking.b_status = '1'";

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
$start_date = date('d/m/', strtotime($rscnt['p_start'])) . (date('Y', strtotime($rscnt['p_start'])) + 543);
$end_date = date('d/m/', strtotime($rscnt['p_end'])) . (date('Y', strtotime($rscnt['p_end'])) + 543);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', ' เริ่มต้น ' . $start_date . '  สิ้นสุด ' . $end_date), 0, 1, 'C');


$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', ' วันที่ ' . date('d/m/') . (date('Y') + 543)), 0, 0, 'R');
$pdf->Cell(25, 10, iconv('UTF-8', 'TIS-620', '  เวลา '  . date('H:i น.', strtotime('+5 hours'))), 0, 1, 'R');
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');

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
    $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', $row2['name']) , 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', date('H:i', strtotime($row2['b_time']))), 1, 0, 'C');
    $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', $row2['ma_name'] ), 1, 1, 'C');
    $i++;
}

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(135, 10, iconv('UTF-8', 'TIS-620', 'รวมรายการทั้งสิ้น ' . $rscnt['total'] . ' รายการ'), 0, 0, 'R');
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'รวมทั้งสิ้น ' . $hour = $rscnt['total'] * 1 . ' ชั่วโมง'), 0, 1, 'R');

$pdf->Output();
