<?php
// ini_set('display_errors', 1);
//     ini_set('display_startup_errors', 1);
//     error_reporting(E_ALL);

require_once ("../../model/koneksi/koneksi.php");
require '../../../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSendmail();
$mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
$mail->addAddress('sysdev@megamarinepride.com');
$mail->addCC('sysdev@baramudabahari.com');


$EMAIL = 'sysdev@megamarinepride.com';

$arrEmail = explode(';', $EMAIL);

foreach ($arrEmail as $key => $alamatEmail) {
    $mail->addCC($alamatEmail);
}

$result6 = $db1->prepare(
    "select a.EMAIL as EMAIL, 
            b.KODE_MERK, 
            b.KODE_USER, 
            b.KODE_PERUSAHAAN 
       from m_user a JOIN
            m_typeakses b ON a.KODE_USER = b.KODE_USER JOIN  
            m_merk c ON b.KODE_MERK = c.KODE_MERK
      where a.EMAIL IS NOT NULL and
            b.KODE_PERUSAHAAN = '2' and
            a.KODE_PERUSAHAAN = '2' and
            b.KODE_MERK = '6' and 
            STATUS = 'aktif'");
 $result6->execute();

 $x = "";

// gawe email
while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) 
{
    $EMAIL = $row6["EMAIL"];
    $arrEmail = explode(';', $EMAIL);

    foreach ($arrEmail as $key => $alamatEmail) {
       $x .=$alamatEmail."<br/>";
    }
}

$mail->Subject = "TEST HALO";
$mail->msgHTML(
   "Please do not reply to this email <br>
    for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
    Regards,<br>
    Quality Assurance - Spec");
$mail->send();

// echo($x);
// END EMAIL

?>