<?php
$u                = date("Ym");
$DATE             = date("Y-m-d H:i:s");
$KODE_SPEC        = createKode("t_spec","KODE_SPEC","SPC-$u-",4);
$SPEC_CODE        = "";
$KODE_PERUSAHAAN  = "";
$KODE_BUYER       = "";
$KODE_PRODUK      = "";
$KODE_BRAND       = "";
$KODE_PACKING     = "";
$KODE_ENDUSER     = "";
$KODE_COUNTRY     = "";
$FILEPROD         = "";
$FILEPACK         = "";
$FILE             = "";
$KODE_MERK        = "";
$JENIS_SPEC       = "";
$VERSI            = "";
$KETERANGAN       = "";
$ITEM_CODE        = "";

require_once 'phpmailer/PHPMailerAutoload.php';

$mail       = new PHPMailer;
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);
$PER        = $_SESSION["LOGINPER_SPEC_BB"];

//EDIT / REVISI------------------------------------------------------------------------------------------------- 
if(isset($_GET["KODE_SPEC"]))
{
    $KODE_SPEC = $_GET["KODE_SPEC"];

    $result = $db1->prepare("select s.*,
                                    h.VERSI 
                               from t_spec s, 
                                    t_history h 
                              where s.KODE_SPEC = h.KODE_SPEC and 
                                    s.KODE_SPEC = '$KODE_SPEC'
                           order by h.TANGGAL desc
                              LIMIT 1");
	  $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $KODE_PERUSAHAAN  = $row["KODE_PERUSAHAAN"];
        $KODE_BUYER       = $row["KODE_BUYER"];
        $KODE_PRODUK      = $row["KODE_PRODUK"];
        $KODE_BRAND       = $row["KODE_BRAND"];
        $KODE_PACKING     = $row["KODE_PACKING"];
        $KODE_ENDUSER     = $row["KODE_ENDUSER"];
        $KODE_COUNTRY     = $row["KODE_COUNTRY"];
        $KODE_MERK        = $row["KODE_MERK"];
        $JENIS_SPEC       = $row["JENIS_SPEC"];
        $VERSI            = $row["VERSI"];
        $SPEC_CODE        = $row["SPEC_CODE"];
        $KETERANGAN       = $row["KETERANGAN"];
        $VRS              = $row["VERSI"];
        $ITEM_CODE        = $row["ITEM_CODE"];
    }

    if(isset($_POST["simpan"]))
    {
        $KODE_PERUSAHAAN  = $_POST["KODE_PERUSAHAAN"];
        $KODE_BUYER       = $_POST["KODE_BUYER"];
        $KODE_PRODUK      = $_POST["KODE_PRODUK"];
        $KODE_BRAND       = $_POST["KODE_BRAND"];
        $KODE_PACKING     = $_POST["KODE_PACKING"];
        $KODE_ENDUSER     = $_POST["KODE_ENDUSER"];
        $KODE_COUNTRY     = $_POST["KODE_COUNTRY"];
        $KODE_MERK        = $_POST["KODE_MERK"];
        $JENIS_SPEC       = $_POST["JENIS_SPEC"];
        $SPEC_CODE        = str_replace("'","",ltrim(rtrim($_POST["SPEC_CODE"])));
        $VERSI            = str_replace("'","",rtrim($_POST["VERSI"]));
        $ITEM_CODE        = str_replace("'","",rtrim($_POST["ITEM_CODE"]));
        $KETERANGAN       = str_replace("'","",rtrim($_POST["KETERANGAN"]));

        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                                    values ('$ID_USER1','$IP_ADDRESS','$DINO','Finish Produk','Edit', 'Kode Spec = $KODE_SPEC')"); 
        $result2->execute();
        
        // UPLOAD FILE CUY
        $error  = 0;
        $ada    = false;

        //cek apakah variable ada isinya?
        if($_FILES["FILE"]["tmp_name"] != "" or $_FILES["FILEPROD"]["tmp_name"] != "" or $_FILES["FILEPACK"]["tmp_name"] != "")
        {
            $ada  = true;
            $ext  = strtolower(pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION));
            $ext2 = strtolower(pathinfo($_FILES["FILEPROD"]["name"], PATHINFO_EXTENSION));
            $ext3 = strtolower(pathinfo($_FILES["FILEPACK"]["name"], PATHINFO_EXTENSION));

            if($_FILES["FILE"]["error"] > 0 or $_FILES["FILEPROD"]["error"] > 0 or $_FILES["FILEPACK"]["error"] > 0)
            {
              ?><script>alert('File yang diupload tidak valid')</script><?php
              $error = 1;
            }
            else if($ext != "pdf" or $ext2 != "pdf" or $ext3 != "pdf")
            {
              ?><script>alert('Ekstensi file yang diupload tidak valid')</script><?php
              $error = 1;
            }
        }           
        
        if($ada == false)
        {
            $result3 = $db1->prepare(
                      "update t_spec 
                          set SPEC_CODE       = '$SPEC_CODE', 
                              KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', 
                              KODE_BUYER      = '$KODE_BUYER', 
                              KODE_PRODUK     = '$KODE_PRODUK', 
                              KODE_BRAND      = '$KODE_BRAND', 
                              KODE_PACKING    = '$KODE_PACKING', 
                              KODE_ENDUSER    = '$KODE_ENDUSER', 
                              KODE_COUNTRY    = '$KODE_COUNTRY', 
                              USER_INPUT      = '$ID_USER1', 
                              IP_ADDRESS      = '$IP_ADDRESS', 
                              KODE_MERK       = '$KODE_MERK', 
                              JENIS_SPEC      = '$JENIS_SPEC', 
                              KETERANGAN      = '$KETERANGAN', 
                              ITEM_CODE       = '$ITEM_CODE' 
                        where KODE_SPEC       = '$KODE_SPEC' "); 
            $result3->execute();            
            $error = 1;
        }
        
        if($error == 0)
        {   
            $resultm = $db1->prepare("select TANGGAL_HISTORY as TGLHIS from d_spec where KODE_SPEC = '$KODE_SPEC' AND STATUS = '0'");
            $resultm->execute();
            while ($resm = $resultm->fetch(PDO::FETCH_ASSOC)) 
            {
                $TANGGALLL = $resm["TGLHIS"];
            }

            if ($VRS != $VERSI or $ada == true) 
            {
                $result4 = $db1->prepare("update d_spec set STATUS = 1 where KODE_SPEC = '$KODE_SPEC'"); 
                $result4->execute();
            }

            $resultmail = $db1->prepare("select STS_MAIL as MODE_EMAIL from m_user where KODE_USER = '$ID_USER1'");
            $resultmail->execute();
            while ($resmail = $resultmail->fetch(PDO::FETCH_ASSOC)) 
            {
                $MODE_EMAIL = $resmail["MODE_EMAIL"];
            }
            
            if($_FILES["FILE"]["tmp_name"] != "" or $_FILES["FILEPROD"]["tmp_name"] != "" or $_FILES["FILEPACK"]["tmp_name"] != "")
            {
                $ext  = strtolower(pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION));
                $ext2 = strtolower(pathinfo($_FILES["FILEPROD"]["name"], PATHINFO_EXTENSION));
                $ext3 = strtolower(pathinfo($_FILES["FILEPACK"]["name"], PATHINFO_EXTENSION));

                // Create Directory sesuai nama spec
                $KODE_HISTORY = kodeAuto("t_history","KODE_HISTORY");
                
                if (!file_exists("pdf/".$SPEC_CODE)) 
                {
                    echo('<br> create dir spec code : '.$SPEC_CODE);
                    if(mkdir("pdf/".$SPEC_CODE, 0755, true))
                    {
                      echo('<br> sukses create dir spec code : '.$SPEC_CODE);
                    }
                    else
                    {
                      echo('<br> error create dir spec code : '.$SPEC_CODE);
                      exit;
                    }
                }

                $FILE = "pdf/".$SPEC_CODE."/".$KODE_SPEC." " . $KODE_HISTORY . ".".$ext;
                $FILEPROD = "pdf/".$SPEC_CODE."/".$KODE_SPEC." " . $KODE_HISTORY . "-PROD.".$ext;
                $FILEPACK = "pdf/".$SPEC_CODE."/".$KODE_SPEC." " . $KODE_HISTORY . "-PACK.".$ext;

                $result3 = $db1->prepare(
                          "update t_spec 
                              set SPEC_CODE       = '$SPEC_CODE', 
                                  KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', 
                                  KODE_BUYER      = '$KODE_BUYER', 
                                  KODE_PRODUK     = '$KODE_PRODUK', 
                                  KODE_BRAND      = '$KODE_BRAND', 
                                  KODE_PACKING    = '$KODE_PACKING', 
                                  KODE_ENDUSER    = '$KODE_ENDUSER', 
                                  KODE_COUNTRY    = '$KODE_COUNTRY', 
                                  USER_INPUT      = '$ID_USER1', 
                                  IP_ADDRESS      = '$IP_ADDRESS', 
                                  KODE_MERK       = '$KODE_MERK', 
                                  JENIS_SPEC      = '$JENIS_SPEC', 
                                  KETERANGAN      = '$KETERANGAN', 
                                  ITEM_CODE       = '$ITEM_CODE' 
                            where KODE_SPEC       = '$KODE_SPEC'"); 
                  $result3->execute();

                move_uploaded_file($_FILES["FILE"]["tmp_name"],$FILE);
                move_uploaded_file($_FILES["FILEPROD"]["tmp_name"],$FILEPROD);
                move_uploaded_file($_FILES["FILEPACK"]["tmp_name"],$FILEPACK);

                if ($VERSI == $VRS) 
                {
                    $result5 = $db1->prepare("update t_spec set FILE = '$FILE', FILEPROD = '$FILEPROD', FILEPACK = '$FILEPACK' 
                                              where KODE_SPEC = '$KODE_SPEC'"); 
                    $result5->execute();
                } 
                else 
                {
                    $result5 = $db1->prepare("update t_spec set FILE = '$FILE',
                                                                FILEPROD = '$FILEPROD',
                                                                FILEPACK = '$FILEPACK', 
                                                                TANGGAL = '$DATE' 
                                              where KODE_SPEC = '$KODE_SPEC'"); 
                    $result5->execute();
                }                    

                if ($MODE_EMAIL == "Aktif") 
                {
                  $result6 = $db1->prepare("
                                insert into d_spec (KODE_SPEC, PRODUCT_CODE, FILE, FILEPROD, FILEPACK, REVISED, VERSI, TANGGAL_HISTORY) 
                                values ('$KODE_SPEC', '$SPEC_CODE', '$FILE', '$FILEPROD', '$FILEPACK', '$KETERANGAN', '$VERSI', '$DATE')");
                }
                else
                {
                  $result6 = $db1->prepare("
                        insert into d_spec (KODE_SPEC, PRODUCT_CODE, FILE, FILEPROD, FILEPACK, REVISED, VERSI, TANGGAL_HISTORY) 
                        values ('$KODE_SPEC', '$SPEC_CODE', '$FILE', '$FILEPROD', '$FILEPACK', '$KETERANGAN', '$VERSI', '$TANGGALLL')");
                } 
                $result6->execute();

                $result7 = $db1->prepare("
                            insert into t_history (KODE_HISTORY, KODE_SPEC, TANGGAL, FILE, FILEPROD, FILEPACK, VERSI, SPEC_CODE) 
                            values ('$KODE_HISTORY', '$KODE_SPEC', '$DATE', '$FILE', '$FILEPROD', '$FILEPACK', '$VERSI', '$SPEC_CODE')");
                $result7->execute();
            }

            if ($MODE_EMAIL == "Aktif") 
            {
              $result8 = $db1->prepare(
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
                                   
                $result8->execute();
                while ($row3 = $result8->fetch(PDO::FETCH_ASSOC)) 
                {
                    $KODE_MERK       = $row3["KODE_MERK"];
                    $KODE_PERUSAHAAN = $row3["KODE_PERUSAHAAN"];

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

                    $FILE           = $row3["FILE"];
                    $INTERNAL_MEMO  = $row3["INTERNAL_MEMO"];
                    $SPEC_CODE      = $row3["SPEC_CODE"];
                    
                    $mail->isSendmail();                    
                    $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
                    $mail->addAddress('junitalia@baramudabahari.com');
                    $mail->addCC('specpackaging@baramudabahari.com');
                    $mail->addCC('specproduct@baramudabahari.com');
                    $mail->addCC('lab.admin@baramudabahari.com');
                    $mail->addCC('eka@baramudabahari.com');

                    // 12/12/22
                    $mail->addCC('ppic4@baramudabahari.com');

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

                    $mail->Subject = "Product Spec " . $SPEC_CODE;
                    $mail->msgHTML(
                      "Kode Product Spec : " . $row3["SPEC_CODE"] . " <br>
                       Revisi            : " . $row3["VERSI"] . " <br>
                       Item Code         : " . $row3["ITEM_CODE"] . " <br><br>
                       =============================================================================<br><br>
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
                       =============================================================================<br>
                       please do not reply to this email <br>
                       for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
                       Regards,<br>
                       Quality Assurance - Spec");
                    $mail->send();
                }
            }
        }

        ?><script>document.location.href='t_finishproduk.php';</script><?php
        die(0);
    }
}

//TAMBAH BARU-------------------------------------------------------------------------------------------------------
if(isset($_POST["simpan"]))
{
    $SPEC_CODE        = str_replace("'","",ltrim(rtrim($_POST["SPEC_CODE"])));
    $KODE_PERUSAHAAN  = $_POST["KODE_PERUSAHAAN"];
    $KODE_BUYER       = $_POST["KODE_BUYER"];
    $KODE_PRODUK      = $_POST["KODE_PRODUK"];
    $KODE_BRAND       = $_POST["KODE_BRAND"];
    $KODE_PACKING     = $_POST["KODE_PACKING"];
    $KODE_ENDUSER     = $_POST["KODE_ENDUSER"];
    $KODE_COUNTRY     = $_POST["KODE_COUNTRY"];
    $KODE_MERK        = $_POST["KODE_MERK"];
    $JENIS_SPEC       = $_POST["JENIS_SPEC"];
    $VERSI            = str_replace("'","",rtrim($_POST["VERSI"]));
    $ITEM_CODE        = str_replace("'","",rtrim($_POST["ITEM_CODE"]));
    $KETERANGAN       = str_replace("'","",rtrim($_POST["KETERANGAN"]));

    //lek nodoc e wes onk gausah nambah maneh
    $results = $db1->prepare("select count(SPEC_CODE) as count from t_spec where SPEC_CODE = '$SPEC_CODE' and KODE_PERUSAHAAN = '$PER'") or trigger_error(mysql_error()); 
    $results->execute();
    while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
    {
        if ($rowz["count"] == 1) 
        {
            ?><script>alert('Nomor Dokumen Sudah Ada')</script><?php
            ?><script>document.location.href='t_finishproduk.php';</script><?php
            die(0);
        }
    }

    $error = 0;
    $ada   = false;

    //cek apakah variable ada isinya?
    if($_FILES["FILE"]["tmp_name"] != "" or $_FILES["FILEPROD"]["tmp_name"] != "" or $_FILES["FILEPACK"]["tmp_name"] != "")
    {
        $ada  = true;
        $ext  = strtolower(pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION));
        $ext2 = strtolower(pathinfo($_FILES["FILEPROD"]["name"], PATHINFO_EXTENSION));
        $ext3 = strtolower(pathinfo($_FILES["FILEPACK"]["name"], PATHINFO_EXTENSION));

        if($_FILES["FILE"]["error"] > 0 or $_FILES["FILEPROD"]["error"] > 0 or $_FILES["FILEPACK"]["error"] > 0)
        {
          ?><script>alert('File yang diupload tidak valid')</script><?php
          $error = 1;
        }
        else if($ext != "pdf" or $ext2 != "pdf" or $ext3 != "pdf")
        {
          ?><script>alert('Ekstensi file yang diupload tidak valid')</script><?php
          $error = 1;
        }
    }   
    
    if($ada == false)
    {
        ?><script>alert('Belum ada file yang dimasukkan')</script><?php
        $error = 1;
    }
    
    if($error == 0)
    {    
        $result11 = $db1->prepare(
                  "insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                  values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Finish Product','Tambah','Kode Spec = $KODE_SPEC')"); 
        $result11->execute();

        //cek apakah variable ada isinya?
        if($_FILES["FILE"]["tmp_name"] or $_FILES["FILEPROD"]["tmp_name"] or $_FILES["FILEPACK"]["tmp_name"] != "")
        {
            $ext  = strtolower(pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION));
            $ext2 = strtolower(pathinfo($_FILES["FILEPROD"]["name"], PATHINFO_EXTENSION));
            $ext3 = strtolower(pathinfo($_FILES["FILEPACK"]["name"], PATHINFO_EXTENSION));

            $KODE_HISTORY = kodeAuto("t_history","KODE_HISTORY");
            if (!file_exists("pdf/".$SPEC_CODE)) 
            {
                mkdir("pdf/".$SPEC_CODE, 0777, true);
            }

            $FILE     = "pdf/".$SPEC_CODE."/".$KODE_SPEC." " . $KODE_HISTORY . ".".$ext;
            $FILEPROD = "pdf/".$SPEC_CODE."/".$KODE_SPEC." " . $KODE_HISTORY . "-PROD.".$ext;
            $FILEPACK = "pdf/".$SPEC_CODE."/".$KODE_SPEC." " . $KODE_HISTORY . "-PACK.".$ext;
            
            $result12 = $db1->prepare(
                        "insert into t_spec (KODE_SPEC,KODE_PERUSAHAAN,KODE_BUYER,KODE_PRODUK,KODE_BRAND,KODE_PACKING,KODE_ENDUSER,KODE_COUNTRY,USER_INPUT,IP_ADDRESS,KODE_MERK,JENIS_SPEC,TANGGAL,SPEC_CODE,KETERANGAN,ITEM_CODE) 
                        values ('$KODE_SPEC','$KODE_PERUSAHAAN','$KODE_BUYER','$KODE_PRODUK','$KODE_BRAND','$KODE_PACKING','$KODE_ENDUSER','$KODE_COUNTRY','$ID_USER1','$IP_ADDRESS','$KODE_MERK','$JENIS_SPEC','$DATE','$SPEC_CODE','$KETERANGAN','$ITEM_CODE')");
            $result12->execute();

            move_uploaded_file($_FILES["FILE"]["tmp_name"],$FILE);
            move_uploaded_file($_FILES["FILEPROD"]["tmp_name"],$FILEPROD);
            move_uploaded_file($_FILES["FILEPACK"]["tmp_name"],$FILEPACK);

            $result13 = $db1->prepare("update t_spec 
                                          set FILE = '$FILE',
                                              FILEPROD = '$FILEPROD',
                                              FILEPACK = '$FILEPACK', 
                                              TANGGAL = '$DATE' 
                                        where KODE_SPEC = '$KODE_SPEC'"); 
            $result13->execute();


            $result14 = $db1->prepare("insert into d_spec (KODE_SPEC, FILE, FILEPROD, FILEPACK, VERSI, TANGGAL_HISTORY) 
                                                  values ('$KODE_SPEC', '$FILE', '$FILEPROD', '$FILEPACK', '$VERSI', '$DATE')"); 
            $result14->execute();

            
            $result15 = $db1->prepare("insert into t_history (KODE_HISTORY,KODE_SPEC,TANGGAL,FILE,FILEPROD,FILEPACK,VERSI,SPEC_CODE) 
                                                    values ('$KODE_HISTORY','$KODE_SPEC','$DATE','$FILE','$FILEPROD','$FILEPACK','$VERSI','$SPEC_CODE')"); 
            $result15->execute();
        }
        
    }

    $resultmail = $db1->prepare("select STS_MAIL as MODE_EMAIL from m_user where KODE_USER = '$ID_USER1'");
    $resultmail->execute();
    while ($resmail = $resultmail->fetch(PDO::FETCH_ASSOC)) 
    {
        $MODE_EMAIL = $resmail["MODE_EMAIL"];
    }

    if ($MODE_EMAIL == "Aktif") 
    {
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
            $FILE            = $row3["FILE"];
            $INTERNAL_MEMO   = $row3["INTERNAL_MEMO"];
            $SPEC_CODE       = $row3["SPEC_CODE"];

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
            
            // START EMAIL
            require_once 'phpmailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;
            $mail->isSendmail();                   
            $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');
            $mail->addAddress('junitalia@baramudabahari.com');
            $mail->addCC('specpackaging@baramudabahari.com');
            $mail->addCC('specproduct@baramudabahari.com');
            $mail->addCC('lab.admin@baramudabahari.com');
            $mail->addCC('eka@baramudabahari.com');

            // 12/12/22
            $mail->addCC('ppic4@baramudabahari.com');

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

            $mail->Subject = "Product Spec " . $SPEC_CODE;
            $mail->msgHTML(
              "Kode Product Spec : " . $row3["SPEC_CODE"] . " <br>
               Revisi            : " . $row3["VERSI"] . " <br>
               Item Code         : " . $row3["ITEM_CODE"] . " <br><br>
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
               please do not reply to this email <br>
               for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
               Regards,<br>
               Quality Assurance - Spec");
            $mail->send();
        }
    }
    ?><script>document.location.href='t_finishproduk.php';</script><?php
    die(0);
}
?>