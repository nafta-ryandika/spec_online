<?php
require_once ("module/model/koneksi/koneksi.php");

$KODE_SPEC = ""; // Isikan sesuai dengan permintaan

$result3 = $db1->prepare("select e.*,DATE_FORMAT(e.TANGGAL, '%d %M %Y') as TANGGAL,p.NAMA_PERUSAHAAN,b.NAMA_BUYER,t.NAMA_PRODUK,d.NAMA_BRAND,i.NAMA_PACKING,u.NAMA_ENDUSER,c.NAMA_COUNTRY,m.NAMA_MERK,max(h.VERSI) as VERSI from t_spec e, m_perusahaan p, m_buyer b, m_produk t, m_brand d, m_packing i, m_enduser u, m_country c, m_merk m, t_history h where e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and e.KODE_BUYER = b.KODE_BUYER and e.KODE_PRODUK = t.KODE_PRODUK and e.KODE_BRAND = d.KODE_BRAND and e.KODE_PACKING = i.KODE_PACKING and e.KODE_ENDUSER = u.KODE_ENDUSER and e.KODE_COUNTRY = c.KODE_COUNTRY and e.KODE_MERK = m.KODE_MERK and e.KODE_SPEC = h.KODE_SPEC and e.KODE_SPEC = '$KODE_SPEC'"); 
$result3->execute();
while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
    $KODE_MERK = $row3["KODE_MERK"];
    $KODE_PERUSAHAAN = $row3["KODE_PERUSAHAAN"];

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

    $FILE = $row3["FILE"];
    $INTERNAL_MEMO = $row3["INTERNAL_MEMO"];
    $SPEC_CODE = $row3["SPEC_CODE"];
    // START EMAIL
    /**
     * This example shows sending a message using a local sendmail binary.
     */
    //Import the PHPMailer class into the global namespace
    // use phpmailer;
    require_once 'phpmailer/PHPMailerAutoload.php';
    //Create a new PHPMailer instance

    $mail = new PHPMailer;
    // Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
    
    if ($KODE_PERUSAHAAN == 1) {
        //Set who the message is to be sent from
        $mail->setFrom('no-replyspec@megamarinepride.com','no-reply spec');
        //Set who the message is to be sent to
        $mail->addAddress('quality@megamarinepride.com');
        $mail->addCC('spec@megamarinepride.com');
        $mail->addCC('spec1@megamarinepride.com');
        $mail->addCC('spec2@megamarinepride.com');
        $mail->addCC('lab2@megamarinepride.com');
    } else {
        //Set who the message is to be sent from
        $mail->setFrom('no-replyspec@baramudabahari.com','no-reply spec');
        //Set who the message is to be sent to
        $mail->addAddress('quality@baramudabahari.com');
        $mail->addCC('spec@baramudabahari.com');
        $mail->addCC('spec1and2@baramudabahari.com');
        $mail->addCC('ppic3@baramudabahari.com');
        $mail->addCC('ppic7@baramudabahari.com');

        // 12/10/22
        $mail->addCC('lab.admin@baramudabahari.com');
        $mail->addCC('eka@baramudabahari.com');
    }
    while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) {
        $EMAIL = $row6["EMAIL"];
        $mail->addCC($EMAIL);
    }
    $mail->addCC('no-reply@megamarinepride.com','no-reply');
    //Set the subject line
    $mail->Subject = "Product Spec " . $SPEC_CODE;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML("Kode Product Spec : " . $row3["SPEC_CODE"] . " <br>Revisi : " . $row3["VERSI"] . " <br><br>======================================================================================<br><br>Perusahaan : " . $row3["NAMA_PERUSAHAAN"] . " <br>Buyer : " . $row3["NAMA_BUYER"] . " <br>Tipe Produk : " . $row3["NAMA_MERK"] . " <br>Nama Produk : " . $row3["NAMA_PRODUK"] . " <br>Tanggal : " . $row3["TANGGAL"] . " <br>Brand : " . $row3["NAMA_BRAND"] . " <br>Packing : " . $row3["NAMA_PACKING"] . " <br>End User : " . $row3["NAMA_ENDUSER"] . " <br>Country : " . $row3["NAMA_COUNTRY"] . " <br><br> Keterangan Revisi : <br>" . $row3["KETERANGAN"] . " <br><br>======================================================================================<br>please do not reply to this email <br>for more information, kindly visit <a href='192.168.0.167/spec'>specproduct.megamarinepride</a><br><br><br>Regards,<br>Quality Assurance - Spec");
    //Replace the plain text body with one created manually
    // $mail->AltBody = 'This is a plain-text message body';
    //Attach an image file
    // $mail->addAttachment($FILE);
    // $mail->addAttachment($INTERNAL_MEMO);
    $mail->send();
    // END EMAIL
}
?>