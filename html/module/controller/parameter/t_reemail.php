<?php
$u          = date("Ym");
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];


if(isset($_POST["simpan"]))
{
    $SPEC_CODE    = $_POST["SPEC_CODE"];
    $GENERAL_CODE = $_POST["GENERAL_CODE"];

    /////////////////////////////////////////////////////////////////////////////////////////////RE EMAIL SPEC
    if ($SPEC_CODE != "") 
    {
        $resultSpec = GetQuery("select KODE_SPEC from t_spec where trim(SPEC_CODE) = '$SPEC_CODE'");
        $resultSpec->execute();
        while ($rowSpec = $resultSpec->fetch(PDO::FETCH_ASSOC)) 
        {
            extract($rowSpec);
            $KODE_SPEC = $rowSpec["KODE_SPEC"];
        }

        $result3 = $db1->prepare(
            "select e.*,
                    DATE_FORMAT(e.TANGGAL, '%d %M %Y') as TANGGAL,
                    p.NAMA_PERUSAHAAN,
                    b.NAMA_BUYER,
                    t.NAMA_PRODUK,
                    d.NAMA_BRAND,
                    i.NAMA_PACKING,
                    u.NAMA_ENDUSER,
                    c.NAMA_COUNTRY,
                    m.NAMA_MERK,
                    h.VERSI 
               from t_spec e, 
                    m_perusahaan p, 
                    m_buyer b, 
                    m_produk t, 
                    m_brand d, 
                    m_packing i,    
                    m_enduser u, 
                    m_country c, 
                    m_merk m, 
                    t_history h 
              where e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and 
                    e.KODE_BUYER = b.KODE_BUYER and 
                    e.KODE_PRODUK = t.KODE_PRODUK and 
                    e.KODE_BRAND = d.KODE_BRAND and 
                    e.KODE_PACKING = i.KODE_PACKING and 
                    e.KODE_ENDUSER = u.KODE_ENDUSER and 
                    e.KODE_COUNTRY = c.KODE_COUNTRY and 
                    e.KODE_MERK = m.KODE_MERK and 
                    e.KODE_SPEC = h.KODE_SPEC and 
                    e.KODE_SPEC = '$KODE_SPEC'
           order by h.TANGGAL desc
              limit 1"); 

        $result3->execute();
        while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) 
        {
            $KODE_MERK       = $row3["KODE_MERK"];
            $KODE_PERUSAHAAN = $row3["KODE_PERUSAHAAN"];
            
            // gawe email
            $result6 = $db1->prepare(
                     "select a.EMAIL as EMAIL, 
                             b.KODE_MERK, 
                             b.KODE_USER, 
                             b.KODE_PERUSAHAAN 
                        from m_user a JOIN
                             m_typeakses b ON a.KODE_USER = b.KODE_USER JOIN  
                             m_merk c ON b.KODE_MERK = c.KODE_MERK
                       where a.EMAIL IS NOT NULL and
                             b.KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and
                             a.KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and
                             b.KODE_MERK = '$KODE_MERK'");
            $result6->execute();
            


            $FILE           = $row3["FILE"];
            $INTERNAL_MEMO  = $row3["INTERNAL_MEMO"];
            $SPEC_CODE      = $row3["SPEC_CODE"];

            require_once 'phpmailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSendmail();
            $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
            $mail->addAddress('junitalia@baramudabahari.com');
            $mail->addCC('specpackaging@baramudabahari.com');
            $mail->addCC('specproduct@baramudabahari.com');
            // $mail->addCC('ppic3@baramudabahari.com');

            // 12/10/22
            $mail->addCC('lab.admin@baramudabahari.com');
            $mail->addCC('eka@baramudabahari.com');

            //gawe email
            while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) 
            {
                $EMAIL = $row6["EMAIL"];
                $mail->addCC($EMAIL);
            }

            $mail->Subject = "Product Spec " . $SPEC_CODE;
            $mail->msgHTML(
                ". <br>
                 Kode Product Spec : " . $row3["SPEC_CODE"] . " <br>
                 Revisi            : " . $row3["VERSI"] . " <br><br>
                 ======================================================================================<br><br>
                 Perusahaan        : " . $row3["NAMA_PERUSAHAAN"] . " <br>
                 Buyer             : " . $row3["NAMA_BUYER"] . " <br>
                 Tipe Produk       : " . $row3["NAMA_MERK"] . " <br>
                 Nama Produk       : " . $row3["NAMA_PRODUK"] . " <br>
                 Tanggal           : " . $row3["TANGGAL"] . " <br>
                 Brand             : " . $row3["NAMA_BRAND"] . " <br>
                 Packing           : " . $row3["NAMA_PACKING"] . " <br>
                 End User          : " . $row3["NAMA_ENDUSER"] . " <br>
                 Country           : " . $row3["NAMA_COUNTRY"] . " <br><br> 
                 Keterangan Revisi : <br>" . $row3["KETERANGAN"] . " <br><br>
                 ======================================================================================<br>
                 Please do not reply to this email <br>
                 for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
                 Regards,<br>
                 Quality Assurance - Spec");
            $mail->send();
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////RE EMAIL INTERNAL MEMO
    if ($GENERAL_CODE != "") 
    {
        $resultMemo = GetQuery("select KODE_GENERAL from m_general where GENERAL_CODE = '$GENERAL_CODE'");
        while ($rowMemo = $resultMemo->fetch(PDO::FETCH_ASSOC)) 
        {
            extract($rowMemo);
            $KODE_GENERAL = $KODE_GENERAL;
        }

        $result4 = $db1->prepare("select *,
                                         DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL 
                                    from m_general 
                                   where KODE_GENERAL = '$KODE_GENERAL'");
        $result4->execute();
        while ($row3 = $result4->fetch(PDO::FETCH_ASSOC)) 
        {
            $FILE               = $row3["FILE"];
            $KODE_MERK          = $row3["KODE_MERK"];
            $KODE_PERUSAHAAN    = $row3["KODE_PERUSAHAAN"];
            $GENERAL_CODE       = $row3["GENERAL_CODE"];
            $NOTE               = $row3["NOTE"];

            //gawe email
            $result6 = $db1->prepare(
                    "select a.EMAIL as EMAIL, 
                            b.KODE_MERK, 
                            b.KODE_USER, 
                            b.KODE_PERUSAHAAN 
                       from m_user a JOIN
                            m_typeakses b ON a.KODE_USER = b.KODE_USER JOIN  
                            m_merk c ON b.KODE_MERK = c.KODE_MERK
                      where a.EMAIL IS NOT NULL and
                            b.KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and
                            a.KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' and
                            b.KODE_MERK = '$KODE_MERK'");
            $result6->execute();
            

            require 'phpmailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSendmail();
            $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
            $mail->addAddress('junitalia@baramudabahari.com');
            $mail->addCC('specpackaging@baramudabahari.com');
            $mail->addCC('specproduct@baramudabahari.com');
            // $mail->addCC('ppic3@baramudabahari.com');

            //12/10/22
            $mail->addCC('lab.admin@baramudabahari.com');
            $mail->addCC('eka@baramudabahari.com');
            //gawe email
            while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) 
            {
                $EMAIL = $row6["EMAIL"];
                $mail->addCC($EMAIL);
            }
            
            $mail->Subject = "Internal Memo General " . $GENERAL_CODE;
            $mail->msgHTML(
                ".. <br>
                 Kode Internal Memo General : " . $row3["GENERAL_CODE"] . " <br>
                 Revisi  : " . $row3["REVISI"] . " <br><br>
                 =============================================================================<br><br>
                 Perihal : " . $row3["PERIHAL"] . " <br>
                 Tanggal : " . $row3["TANGGAL"] . " <br>
                 Keterangan Revisi : " . $row3["NOTE"] . " <br><br>
                 =============================================================================<br>
                 Please do not reply to this email <br>
                 for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
                 Regards,<br>
                 Quality Assurance - Spec");
            $mail->send();
        }
    }
    
    ?>
    <script>alert('Berhasil!');</script>
    <script>document.location.href='menuutama.php';</script><?php
    die(0);
}
?>