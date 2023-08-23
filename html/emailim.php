<?php
require_once ("module/model/koneksi/koneksi.php");

$KODE_GENERAL = "";

$result4 = $db1->prepare("select *,DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL from m_general where KODE_GENERAL = '$KODE_GENERAL'");
$result4->execute();
while ($row3 = $result4->fetch(PDO::FETCH_ASSOC)) {
    $FILE = $row3["FILE"];
    $KODE_MERK = $row3["KODE_MERK"];
    $KODE_PERUSAHAAN = $row3["KODE_PERUSAHAAN"];
    $GENERAL_CODE = $row3["GENERAL_CODE"];
    $NOTE = $row3["NOTE"];

    if ($KODE_PERUSAHAAN == 1) {
        if ($KODE_MERK == 1) {
            $AKSES = "Crab Product";
            $result6 = $db1->prepare("select EMAIL from m_user where EMAIL IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Fish and Crab Product' or AKSES = 'QA Fish and Crab Product' or AKSES = 'View MMP' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 2) {
            $AKSES = "Fish Product";
            $result6 = $db1->prepare("select EMAIL from m_user where EMAIL IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'QA Fish and Crab Product' or AKSES = 'Fish and Crab Product' or AKSES = 'View MMP' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 3) {
            $AKSES = "Cook & Custom Shrimp";
            $result6 = $db1->prepare("select EMAIL from m_user where EMAIL IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Shrimp Product' or AKSES = 'View MMP' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 5) {
            $AKSES = "Cook & Custom Shrimp";
            $result6 = $db1->prepare("select EMAIL from m_user where EMAIL IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Shrimp Product' or AKSES = 'View MMP' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 6) {
            $AKSES = "Shrimp Product";
            $result6 = $db1->prepare("select EMAIL from m_user where EMAIL IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Cook & Custom Shrimp' or AKSES = 'View MMP' or AKSES = 'View')"); 
            $result6->execute();
        }
        else {
            $AKSES = "Shrimp Product";
            $result6 = $db1->prepare("select EMAIL from m_user where EMAIL IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Shrimp Product' or AKSES = 'View MMP' or AKSES = 'View')"); 
            $result6->execute();
        }
    }
    else{
        if ($KODE_MERK == 1) {
            $AKSES = "Crab Product";
            $result6 = $db1->prepare("select EMAIL_BB as EMAIL from m_user where EMAIL_BB IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Fish and Crab Product' or AKSES = 'QA Fish and Crab Product' or AKSES = 'View BB' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 2) {
            $AKSES = "Fish Product";
            $result6 = $db1->prepare("select EMAIL_BB as EMAIL from m_user where EMAIL_BB IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'QA Fish and Crab Product' or AKSES = 'Fish and Crab Product' or AKSES = 'View BB' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 3) {
            $AKSES = "Cook & Custom Shrimp";
            $result6 = $db1->prepare("select EMAIL_BB as EMAIL from m_user where EMAIL_BB IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Shrimp Product' or AKSES = 'View BB' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 5) {
            $AKSES = "Cook & Custom Shrimp";
            $result6 = $db1->prepare("select EMAIL_BB as EMAIL from m_user where EMAIL_BB IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Shrimp Product' or AKSES = 'View BB' or AKSES = 'View')"); 
            $result6->execute();
        }
        elseif ($KODE_MERK == 6) {
            $AKSES = "Shrimp Product";
            $result6 = $db1->prepare("select EMAIL_BB as EMAIL from m_user where EMAIL_BB IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Cook & Custom Shrimp' or AKSES = 'View BB' or AKSES = 'View')"); 
            $result6->execute();
        }
        else {
            $AKSES = "Shrimp Product";
            $result6 = $db1->prepare("select EMAIL_BB as EMAIL from m_user where EMAIL_BB IS NOT NULL and KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and (AKSES = '$AKSES' or AKSES = 'Shrimp Product' or AKSES = 'View BB' or AKSES = 'View')"); 
            $result6->execute();
        }
    }

    // START EMAIL
    /**
     * This example shows sending a message using a local sendmail binary.
     */
    //Import the PHPMailer class into the global namespace
    // use phpmailer;
    require 'phpmailer/PHPMailerAutoload.php';
    //Create a new PHPMailer instance

    $mail = new PHPMailer;
    // Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
    // $mail->addCC('recruitment@megamarinepride.com','recruitment');
    if ($KODE_PERUSAHAAN == 1) {
        //Set who the message is to be sent from
        $mail->setFrom('no-reply@megamarinepride.com','no-reply');
        //Set who the message is to be sent to
        $mail->addAddress('quality@megamarinepride.com');
        $mail->addCC('spec@megamarinepride.com');
        $mail->addCC('spec1@megamarinepride.com');
        $mail->addCC('spec2@megamarinepride.com');
        $mail->addCC('lab2@megamarinepride.com');
    } else {
        //Set who the message is to be sent from
        $mail->setFrom('no-reply@baramudabahari.com','no-reply');
        //Set who the message is to be sent to
        $mail->addAddress('quality@baramudabahari.com');
        $mail->addCC('spec@baramudabahari.com');
        $mail->addCC('spec1and2@baramudabahari.com');
        $mail->addCC('ppic3@baramudabahari.com');
        $mail->addCC('ppic7@baramudabahari.com');

        // 12/10/22
        $mail->addCC('lab.admin@baramudabahari.com');
    }
    while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) {
        $EMAIL = $row6["EMAIL"];
        $mail->addCC($EMAIL);
    }
    $mail->addCC('no-reply@megamarinepride.com','no-reply');
    //Set the subject line
    $mail->Subject = "Internal Memo General " . $GENERAL_CODE;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML("Kode Internal Memo General : " . $row3["GENERAL_CODE"] . " <br>Revisi : " . $row3["REVISI"] . " <br><br>=============================================================================<br><br>Perihal : " . $row3["PERIHAL"] . " <br>Tanggal : " . $row3["TANGGAL"] . " <br>Keterangan Revisi : " . $row3["NOTE"] . " <br><br>=============================================================================<br>please do not reply to this email <br>for more information, kindly visit <a href='192.168.0.167/spec'>specproduct.megamarinepride</a><br><br><br>Regards,<br>Quality Assurance - Spec");
    //Replace the plain text body with one created manually
    // $mail->AltBody = 'This is a plain-text message body';
    //Attach an image file
    $mail->send();
    // END EMAIL
}
?>