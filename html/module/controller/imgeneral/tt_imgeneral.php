<?php
$ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PER            = $_SESSION["LOGINPER_SPEC_BB"];
$u              = date("Ym");
$TANGGAL        = date("Y-m-d");
$JAM            = date("H:i:s");
$DINO           = date('Y-m-d H:i:s');
$KODE_GENERAL   = createKode("m_general","KODE_GENERAL","GNRL-$u-",4);
$GENERAL_CODE   = "";
$PERIHAL        = "";
$KODE_PERUSAHAAN= "";
$KODE_MERK      = "";
$REVISI         = "";
$SPEC_CODE      = "";
$NOTE           = "";
$JENIS          = "";
$PC_NAME        = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_GENERAL"]))
{
    $KODE_GENERAL = $_GET["KODE_GENERAL"];
    $result = $db1->prepare(
                  "select *,
                          date(TANGGAL) as TANGGAL,
                          TANGGAL as TANGGALZ 
                     from m_general 
                     where KODE_GENERAL = '$KODE_GENERAL'");
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $JENIS              = $row["JENIS"];
        $PERIHAL2           = $row["PERIHAL"];
        $KODE_PERUSAHAAN2   = $row["KODE_PERUSAHAAN"];
        $KODE_MERK2         = $row["KODE_MERK"];
        $GENERAL_CODE2      = $row["GENERAL_CODE"];
        $REVISI2            = $row["REVISI"];
        $SPEC_CODE2         = $row["SPEC_CODE"];
        $NOTE2              = $row["NOTE"];
        $TANGGAL2           = $row["TANGGALZ"];
        $FILE2              = $row["FILE"];

        $PERIHAL            = $row["PERIHAL"];
        $KODE_PERUSAHAAN    = $row["KODE_PERUSAHAAN"];
        $KODE_MERK          = $row["KODE_MERK"];
        $GENERAL_CODE       = $row["GENERAL_CODE"];
        $REVISI             = $row["REVISI"];
        $SPEC_CODE          = $row["SPEC_CODE"];
        $NOTE               = $row["NOTE"];
        $TANGGAL            = $row["TANGGAL"];
        $FILE               = $row["FILE"];
    }

    if(isset($_POST["simpan"]))
    {
        $GENERAL_CODE       = str_replace("'","",ltrim(rtrim($_POST["GENERAL_CODE"])));
        $NOTE               = str_replace("'","",ltrim(rtrim($_POST["NOTE"])));
        $REVISI             = str_replace("'","",ltrim(rtrim($_POST["REVISI"])));
        $KODE_PERUSAHAAN    = $_POST["KODE_PERUSAHAAN"];
        $KODE_MERK          = $_POST["KODE_MERK"];
        $PERIHAL            = str_replace("'","",ltrim(rtrim($_POST["PERIHAL"])));
        $TANGGAL            = $_POST["TANGGAL"];
        $SPEC_CODE          = str_replace("'","",ltrim(rtrim($_POST["SPEC_CODE"])));
        $JENIS              = $_POST["JENIS"];
        // $FILE               = $_POST["FILE"];
        
        if ($GENERAL_CODE != $GENERAL_CODE2 or $REVISI != $REVISI2) 
        {
          GetQuery(
                "insert into d_internalmemo (KODE_GENERAL,GENERAL_CODE,NOTE,REVISI,KODE_PERUSAHAAN,KODE_MERK,PERIHAL,TANGGAL,TGL_UP) 
          values ('$KODE_GENERAL','$GENERAL_CODE','$NOTE','$REVISI','$KODE_PERUSAHAAN','$KODE_MERK','$PERIHAL','$TANGGAL','$DINO')");
        }

        $result1 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Internal Memo General','Edit','Kode IM = $KODE_GENERAL')"); 
        $result1->execute();

        $error = 0;
        $ada = false;

        //proses upload file
        for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++)
        {
        
            if($_FILES["FILE"]["tmp_name"][$i] != "") //cek jika nama file tidak kosong
            {
                $ada = true;
                $ext = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));

                if($_FILES["FILE"]["error"][$i] > 0)
                {
                    ?><script>alert('File yang diupload tidak valid')</script><?php
                    $error = 1;
                }
                else if($ext != "pdf" && $ext != "pdf" && $ext != "pdf" && $ext != "pdf")
                {
                    ?><script>alert('Ekstensi file yang diupload tidak valid')</script><?php
                    $error = 1;
                }
            }   
        }

        //jika tidak ada file
        if($ada == false)
        {
            $result2 = $db1->prepare(
                    "update m_general 
                        set GENERAL_CODE    = '$GENERAL_CODE', 
                            JENIS           = '$JENIS' 
                            SPEC_CODE       = '$SPEC_CODE', 
                            NOTE            = '$NOTE', 
                            REVISI          = '$REVISI', 
                            KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', 
                            KODE_MERK       = '$KODE_MERK', 
                            PERIHAL         = '$PERIHAL',
                            INPUTOR         = '$ID_USER1' 
                      where KODE_GENERAL    = '$KODE_GENERAL'"); 
            $result2->execute();
            
            $error = 1;
        }
        
        //jika tidak ada error
        if($error == 0)
        {   
            for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++)
            {

                if($_FILES["FILE"]["tmp_name"][$i] != "") //cek jika nama file tidak kosong
                {
                    $ext = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));

                    $resultInc = GetQuery("select count(KODE_GENERAL) as INC from d_internalmemo where KODE_GENERAL = '$KODE_GENERAL'");
                    while ($rowInc = $resultInc->fetch(PDO::FETCH_ASSOC)) 
                    {
                        extract($rowInc);
                        $INCREMENT = $INC + 1;
                    }

                    $FILE = "imgeneral/".$KODE_GENERAL. " " . $INCREMENT .".".$ext;

                    //jika no revisi yg ada = no revisi yg baru
                    if ($REVISI == $REVISI2) 
                    {
                        $result2 = $db1->prepare(
                                    "update m_general 
                                        set GENERAL_CODE    = '$GENERAL_CODE', 
                                            PERIHAL         = '$PERIHAL', 
                                            KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', 
                                            KODE_MERK       = '$KODE_MERK', 
                                            REVISI          = '$REVISI', 
                                            SPEC_CODE       = '$SPEC_CODE', 
                                            NOTE            = '$NOTE', 
                                            JENIS           = '$JENIS' 
                                      where KODE_GENERAL    = '$KODE_GENERAL'"); 
                        $result2->execute();
                    } 
                    
                    //jika no revisi yg ada != no revisi yg baru
                    else 
                    {
                        $result2 = $db1->prepare(
                                    "update m_general 
                                        set GENERAL_CODE    = '$GENERAL_CODE', 
                                            PERIHAL         = '$PERIHAL', 
                                            TANGGAL         = '$DINO', 
                                            KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', 
                                            KODE_MERK       = '$KODE_MERK', 
                                            REVISI          = '$REVISI', 
                                            SPEC_CODE       = '$SPEC_CODE', 
                                            NOTE            = '$NOTE', 
                                            JENIS           = '$JENIS' 
                                      where KODE_GENERAL    = '$KODE_GENERAL'"); 
                        $result2->execute();
                    }

                    move_uploaded_file($_FILES["FILE"]["tmp_name"][$i],$FILE);
                    $result3 = $db1->prepare("update m_general set FILE = '$FILE' where KODE_GENERAL = '$KODE_GENERAL'"); 
                    $result3->execute();

                    $result4 = $db1->prepare("update d_internalmemo set FILE = '$FILE' where KODE_GENERAL = '$KODE_GENERAL' and GENERAL_CODE = '$GENERAL_CODE' and REVISI = '$REVISI'"); 
                    $result4->execute();
                    

                    $resultmail = $db1->prepare("select STS_MAIL as MODE_EMAIL from m_user where KODE_USER = '$ID_USER1'");
                    $resultmail->execute();
                    while ($resmail = $resultmail->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $MODE_EMAIL = $resmail["MODE_EMAIL"];
                    }

                    if ($MODE_EMAIL == "Aktif") 
                    {
                        $result4 = $db1->prepare(
                                        "select *,
                                                DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL 
                                           from m_general 
                                          where KODE_GENERAL = '$KODE_GENERAL'");
                        $result4->execute();
                        while ($row3 = $result4->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $FILE       = $row3["FILE"];
                            $KODE_MERK  = $row3["KODE_MERK"];
                            $NOTE       = $row3["NOTE"];

                            // 13/10/22
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
                                             b.KODE_MERK = '$KODE_MERK' and 
                                             STATUS = 'Aktif'");
                            $result6->execute();
                            
                            require 'phpmailer/PHPMailerAutoload.php';

                            $mail = new PHPMailer;
                            $mail->isSendmail();
                            $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
                            $mail->addAddress('junitalia@baramudabahari.com');
                            $mail->addCC('specpackaging@baramudabahari.com');
                            $mail->addCC('specproduct@baramudabahari.com');
                            // $mail->addCC('ppic3@baramudabahari.com');
                            $mail->addCC('lab.admin@baramudabahari.com');
                            $mail->addCC('eka@baramudabahari.com');

                            // 14/10/22
                            $mail->addCC('jalil@baramudabahari.com');
                            
                            
                            //gawe email
                            while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) 
                            {
                                $EMAIL = $row6["EMAIL"];
                                // $mail->addCC($EMAIL);

                                // 12/10/22

                                $arrEmail = explode(';', $EMAIL);

                                foreach ($arrEmail as $key => $alamatEmail) {
                                    $mail->addCC($alamatEmail);
                                }
                            }

                            $mail->Subject = "Internal Memo General " . $GENERAL_CODE;
                            $mail->msgHTML(
                                "Kode Internal Memo General : " . $row3["GENERAL_CODE"] . " <br>
                                 Revisi                     : " . $row3["REVISI"] . " <br><br>
                                 =============================================================================<br><br>
                                 Perihal                    : " . $row3["PERIHAL"] . "  <br>
                                 Tanggal                    : " . $row3["TANGGAL"] . " <br>
                                 Keterangan Revisi          : " . $row3["NOTE"] . " <br><br>
                                 =============================================================================<br>
                                 Please do not reply to this email <br>
                                 for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
                                 Regards,<br>
                                 Quality Assurance - Spec");
                            $mail->send();
                            // END EMAIL
                        }
                    }
                }
            }
        }

        ?><script>document.location.href='t_imgeneral.php';</script><?php
        die(0);
    }
}

//BUAT BARU
if(isset($_POST["simpan"]))
{
    $PERIHAL            = str_replace("'","",ltrim(rtrim($_POST["PERIHAL"])));
    $TANGGAL            = $_POST["TANGGAL"];
    $KODE_PERUSAHAAN    = $_POST["KODE_PERUSAHAAN"];
    $KODE_MERK          = $_POST["KODE_MERK"];
    $GENERAL_CODE       = str_replace("'","",ltrim(rtrim($_POST["GENERAL_CODE"])));
    $REVISI             = str_replace("'","",ltrim(rtrim($_POST["REVISI"])));
    $SPEC_CODE          = str_replace("'","",ltrim(rtrim($_POST["SPEC_CODE"])));
    $NOTE               = str_replace("'","",ltrim(rtrim($_POST["NOTE"])));
    $JENIS              = $_POST["JENIS"];
    $PER                = $_SESSION["LOGINPER_SPEC_BB"];

    $results = $db1->prepare("select count(GENERAL_CODE) as count 
                                from m_general 
                               where GENERAL_CODE = '$GENERAL_CODE' and 
                                     KODE_PERUSAHAAN = '$PER'") or trigger_error(mysql_error()); 
    $results->execute();
    while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
    {
        if ($rowz["count"] > 0) 
        {
            ?><script>alert('Nomor dokumen sudah terpakai!')</script><?php
            ?><script>document.location.href='t_imgeneral.php';</script><?php
            die(0);
        }
    }

    $error  = 0;
    $ada    = false;

    for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++)
    {
    
        if($_FILES["FILE"]["tmp_name"][$i] != "") //cek jika upload
        {
            $ada = true;
            $ext = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));

            if($_FILES["FILE"]["error"][$i] > 0)
            {
                ?><script>alert('File yang diupload tidak valid')</script><?php
                $error = 1;
            }
            else if($ext != "pdf")
            {
                ?><script>alert('Ekstensi file yang diupload tidak valid')</script><?php
                $error = 1;
            }
        }   
    }
    if($ada == false)
    {
        ?><script>alert('Belum ada file yang dimasukkan')</script><?php
        $error = 1;
    }

    if($error == 0)
    {    
        for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++)
        {

            if($_FILES["FILE"]["tmp_name"][$i] != "")
            {
                $ext        = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));
                $INCREMENT  = kodeAuto("d_internalmemo","KODE_GENERAL");
                $FILE       = "imgeneral/".$KODE_GENERAL. " " . $INCREMENT .".".$ext;
                
                $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Internal Memo General','Tambah','Kode IM = $KODE_GENERAL')"); 
                $result->execute();

                $result2 = $db1->prepare("insert into m_general (KODE_GENERAL,PERIHAL,TANGGAL,KODE_PERUSAHAAN,KODE_MERK,GENERAL_CODE,REVISI,SPEC_CODE,NOTE,JENIS,INPUTOR) values ('$KODE_GENERAL','$PERIHAL','$TANGGAL $JAM','$KODE_PERUSAHAAN','$KODE_MERK','$GENERAL_CODE','$REVISI','$SPEC_CODE','$NOTE','$JENIS', '$ID_USER1')"); 
                $result2->execute();

                move_uploaded_file($_FILES["FILE"]["tmp_name"][$i],$FILE);
                $result11 = $db1->prepare("update m_general set FILE = '$FILE' where KODE_GENERAL = '$KODE_GENERAL'"); 
                $result11->execute();

                $resultmail = $db1->prepare("select STS_MAIL as MODE_EMAIL from m_user where KODE_USER = '$ID_USER1'");
                $resultmail->execute();
                while ($resmail = $resultmail->fetch(PDO::FETCH_ASSOC)) 
                {
                    $MODE_EMAIL = $resmail["MODE_EMAIL"];
                }

                if ($MODE_EMAIL == "Aktif") 
                {
                    $result4 = $db1->prepare("select *,
                                                     DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL 
                                                from m_general 
                                               where KODE_GENERAL = '$KODE_GENERAL'");
                    $result4->execute();
                    while ($row3 = $result4->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $FILE       = $row3["FILE"];
                        $KODE_MERK  = $row3["KODE_MERK"];
                        $NOTE       = $row3["NOTE"];

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
                                     b.KODE_MERK = '$KODE_MERK' and 
                                     STATUS = 'Aktif'");
                        $result6->execute();
                        
                        require 'phpmailer/PHPMailerAutoload.php';

                        $mail = new PHPMailer;
                        $mail->isSendmail();
                        $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
                        $mail->addAddress('junitalia@baramudabahari.com');
                        $mail->addCC('specpackaging@baramudabahari.com');
                        $mail->addCC('specproduct@baramudabahari.com');
                        // $mail->addCC('ppic3@baramudabahari.com');
                        $mail->addCC('lab.admin@baramudabahari.com');
                        $mail->addCC('eka@baramudabahari.com');
                        
                        // 14/10/22
                        $mail->addCC('jalil@baramudabahari.com');
                            
                        //gawe email
                        while ($row6 = $result6->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $EMAIL = $row6["EMAIL"];
                            // $mail->addCC($EMAIL);

                            // 12/10/22

                            $arrEmail = explode(';', $EMAIL);

                            foreach ($arrEmail as $key => $alamatEmail) {
                                $mail->addCC($alamatEmail);
                            }
                        }
                        
                        $mail->Subject = "Internal Memo General " . $GENERAL_CODE;
                        $mail->msgHTML(
                            "Kode Internal Memo General : " . $row3["GENERAL_CODE"] . " <br>
                             Revisi : " . $row3["REVISI"] . " <br><br>
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
                        // END EMAIL
                    }
                }
            }
        }
    }
    ?><script>document.location.href='t_imgeneral.php';</script><?php
    die(0);
}
?>