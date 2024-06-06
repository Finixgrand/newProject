<?php
require('fpdf/fpdf.php');

include "module/connect.php";


$cus_id = isset($_GET['cus_id']) ? $_GET['cus_id'] : 0;
$p_id = isset($_GET['p_id']) ? $_GET['p_id'] : 0;
$t_id = isset($_GET['t_id']) ? $_GET['t_id'] : 0;
$b_id = isset($_GET['b_id']) ? $_GET['b_id'] : 0;

$p_sql = "SELECT * FROM program 
JOIN teacher ON program.t_id = teacher.t_id 
WHERE p_id = $p_id";
$p_result = mysqli_query($conn, $p_sql);
$p_row = mysqli_fetch_assoc($p_result);
$teacher = $p_row['t_name'];

$b_sql = "SELECT * FROM masseuse
JOIN booking ON masseuse.ma_id = booking.ma_id
WHERE b_id = $b_id";
$b_result = mysqli_query($conn, $b_sql);
$b_row = mysqli_fetch_assoc($b_result);
$mass = $b_row['ma_name'];



if ($cus_id > 0) {
    // Query เพื่อดึงข้อมูลของลูกค้าที่ต้องการพิมพ์
    $sql = "SELECT * FROM user 
    JOIN customer ON user.u_name = customer.u_name
    WHERE cus_id = $cus_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // ดึงข้อมูลที่ต้องการพิมพ์
        $name = $row['name'];
        $age = $row['age'];
        $gender = $row['gender'];
        $s_name = isset($row['s_name']) ? $row['s_name'] : 'ไม่มีข้อมูล';
        $b_time = isset($row['b_time']) ? $row['b_time'] : 'ไม่มีข้อมูล';
        $address = isset($row['address']) ? $row['address'] : 'ไม่มีข้อมูล';
        $tel = isset($row['tel']) ? $row['tel'] : 'ไม่มีข้อมูล';


        if ($gender == '0') 
        {
            $gender = 'ชาย';
        } 
        else 
        {
            $gender = 'หญิง';
        }

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 20, 10);

$pdf->Addfont('THSarabun', '', 'THSarabun.php');
$pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');


$pdf->AddPage();

$pdf->SetFont('THSarabun', 'B', 24);
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', 'คลินิกแพทย์แผนไทย มหาวิทยาลัยราชภัฏเพชรบูรณ์'), 0, 0, 'C');

$pdf->SetY($pdf->GetY() - 10);
$pdf->SetFont('THSarabun', '', 14);
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', 'พิมพ์วันที่'), 0, 1, 'R');
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', date('d/m/') . (date('Y')+543)) , 0, 1, 'R');
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', ' เวลา '  . date('H:i น.', strtotime('+5 hours'))), 0, 1, 'R');

$pdf->SetY($pdf->GetY() + 5);
$pdf->SetFont('THSarabun', 'B', 20);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'ใบประวัติผู้ใช้บริการ'), 0, 1, 'C');
$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');
$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(60, 10, iconv('UTF-8', 'TIS-620', 'ชื่อ - นามสกุล   ' . $name  ), 0, 0, 'L');
$pdf->Cell(20, 10, iconv('UTF-8', 'TIS-620', 'อายุ    ' . $age), 0, 0, 'L');
$pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', 'ปี'), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'เพศ   ' . $gender), 0, 0, 'L');
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'อาชีพ _______________'), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'ที่อยู่ :     ' . $address ), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', 'เบอร์โทร : ' . $tel), 0, 0, 'L');
$pdf->Cell(60, 10, iconv('UTF-8', 'TIS-620', 'วันที่ใช้บริการ : ______________' ), 0, 0, 'L');
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'เวลาที่ใช้บริการ : ______________' ), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'อาการสำคัญ : _____________________________________________________________________'), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'ประวัติการเจ็บป่วยในอดีต : ___________________________________________________________'), 0, 1, 'L');

$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');
$pdf->SetFont('THSarabun', 'B', 18);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'ตรวจร่างกาย'), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'ความดันโลหิต :__________mmHG    ชีพจร________ครั้ง/นาที    น้ำหนัก_____กิโลกรัม    ส่วนสูง_____เซนติเมตร'), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ข้อเท้า : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ข้อเข่า : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'การงอขา : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'กระดูกสันหลัง : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'การไขว้แขน : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ก้มเงยหน้า : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->SetFont('THSarabun', '', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'หันซ้ายขวา : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ปกติ '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     ผิดปกติ _______________________________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 1);
$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ผลการนวด : '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     อาการดีขึ้น '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     อาการคงเดิม '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '     อาการแย่ลง _____________________ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 30);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 60);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 90);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');
$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'คำแนะนำการปฏิบัติหลังการนวด : _____________________________________________________  '), 0, 1, 'L');

$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');
$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'การประเมินผู้ให้บริการ            '), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '                        ดีมาก'), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '                        ดี'), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '                        พอใช้'), 0, 0, 'L');
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', '                        ปรับปรุง'), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 3);
$pdf->SetX($pdf->GetX() + 53);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 83);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 113);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 143);
$pdf->Cell(5, 5, '', 1, 1);

$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');
$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ข้อเสนอแนะ : ____________________________________________________________________  '), 0, 1, 'L');
$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');
$pdf->Cell(0, 3, iconv('UTF-8', 'TIS-620', ' '), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ ___________________________ ผู้ให้บริการ '), 0, 0, 'L');
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 95);
$pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ ___________________________ ผู้รับบริการ '), 0, 1, 'L');

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 7);
$pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '( '.$mass.' )'), 0, 0, 'C');
$pdf->SetY($pdf->GetY() + 0);
$pdf->SetX($pdf->GetX() + 102);
$pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '(  '.$name.'  )'), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 16);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ ___________________________ อาจารย์ผู้ควบคุม '), 0, 1, 'C');
$pdf->SetX($pdf->GetX() + -10);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', '( '.$teacher.' )'), 0, 1, 'C');

$pdf->Output();

} else {
    echo 'ไม่พบข้อมูลลูกค้า';
}
} else {
echo 'ไม่พบรหัสลูกค้าที่ต้องการพิมพ์';
}