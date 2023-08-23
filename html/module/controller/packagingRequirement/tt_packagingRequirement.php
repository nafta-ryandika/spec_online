<?php
require_once 'phpmailer/PHPMailerAutoload.php';

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

//GET DATA
if(isset($_GET["inPr_id"])){
    $inPr_id = $_GET["inPr_id"];

    $sql = "SELECT 
            dt1.*,
            dt2.*,
            IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_company, (SELECT NAMA_PERUSAHAAN FROM m_perusahaan WHERE KODE_PERUSAHAAN = dt2.KODE_PERUSAHAAN)) AS company_name,
            IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_product_name, (SELECT NAMA_PRODUK FROM m_produk WHERE KODE_PRODUK = dt2.KODE_PRODUK AND KODE_PERUSAHAAN = dt2.KODE_PERUSAHAAN)) AS product_name,
            IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_product_type, (SELECT NAMA_MERK FROM m_merk WHERE KODE_MERK = dt2.KODE_MERK)) AS type_name,
            IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_packing_style, (SELECT NAMA_PACKING FROM m_packing WHERE KODE_PACKING = dt2.KODE_PACKING)) AS packing_name,
            IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_spec_id, dt1.pr_spec_id) AS pr_spec_id,
            IF(dt1.pr_revised_no = 0, '', dt1.pr_revised_no) as pr_revised_no,
            IF(dt1.pr_code = dt1.pr_spec_id, 'MANUAL', '') AS spec_mode,
            DATE(dt1.pr_revised_date) AS pr_revised_date
            FROM 
            (
                SELECT 
                    pr_id, pr_code, pr_spec_id, pr_date, pr_attachment, pr_revised_no, 
                    pr_revised, pr_revised_date, pr_user, pr_user_date, pr_user_address
                FROM t_packaging_requirement 
                WHERE pr_id = '".$inPr_id."'
            )dt1
            LEFT JOIN 
            (
                SELECT 
                    KODE_SPEC, SPEC_CODE, GENERAL_CODE, ITEM_CODE, KODE_PERUSAHAAN, KODE_BUYER, 
                    KODE_PRODUK, KODE_MERK, KODE_BRAND, KODE_PACKING, KODE_ENDUSER, KODE_COUNTRY, 
                    TANGGAL, TANGGAL_IM, JENIS_SPEC, FILEPROD, FILEPACK, `FILE`, INTERNAL_MEMO, 
                    KETERANGAN, STS_AKTF, USER_INPUT, IP_ADDRESS
                FROM t_spec
            )dt2
            ON dt1.pr_spec_id = dt2.SPEC_CODE
            LEFT JOIN 
            (
                SELECT 
                    sm_id, sm_pr_code, sm_spec_id, sm_product_name, sm_packing_style, sm_company, 
                    sm_product_type, sm_user, sm_user_date, sm_user_address
                FROM t_spec_manual
            )dt3 
            ON dt1.pr_code = dt3.sm_pr_code";

    $res = $db1->prepare($sql);
    $res->execute();

    while ($data = $res->fetch(PDO::FETCH_ASSOC)) {
        $pr_id = $data["pr_id"];
        $pr_code = $data["pr_code"];
        $pr_spec_id = $data["pr_spec_id"];
        $pr_attachment = $data["pr_attachment"];
        $company_name = $data["company_name"];
        $product_name = $data["product_name"];
        $type_name = $data["type_name"];
        $packing_name = $data["packing_name"];
        $pr_revised_no = sprintf("%02d", $data["pr_revised_no"]);
        $pr_revised_date = $data["pr_revised_date"];
        $pr_revised = $data["pr_revised"];
        $spec_mode = $data["spec_mode"];
    }
}

//UPDATE DATA
if(isset($_GET["inPr_id"]) && isset($_POST["simpan"])){
    $inPr_id = strtoupper(trim($_GET["inPr_id"]));
    $inPr_code = strtoupper(trim($_POST["inPr_code"]));
    $inPr_spec_id = strtoupper(trim($_POST["inPr_spec_id"]));
    $inPr_spec_id_name = str_replace('/','-',$inPr_spec_id);

    $inPr_revised_no = trim($_POST["inPr_revised_no"]);
    $inPr_revised = trim($_POST["inPr_revised"]);

    if(trim($_POST["inPr_revised_date"]) != ""){
        $inPr_revised_date = trim($_POST["inPr_revised_date"]);
        $inPr_revised_date = date("Y-m-d H:i:s", strtotime($inPr_revised_date)); 
    }
    else {
        $inPr_revised_date = "";
    }

    $inSpecMode = trim($_POST["inSpecMode"]);

    // $inPr_spec_id = trim($_POST["inPr_spec_id"]);
    $inProductName = trim($_POST["inProductName"]);
    $inPackingStyle = trim($_POST["inPackingStyle"]);
    $inCompany = trim($_POST["inCompany"]);
    $inProductType = trim($_POST["inProductType"]);

    if ($inSpecMode == 'MANUAL') {
        $inPr_spec_id = $pr_code;
    }

    $sql = "UPDATE t_packaging_requirement 
            SET 
            pr_spec_id = '".$inPr_spec_id."', 
            pr_revised_no = '".$inPr_revised_no."', 
            pr_revised = '".$inPr_revised."',
            pr_revised_date = '".$inPr_revised_date."',
            pr_user = '".$ID_USER1."', 
            pr_user_date = NOW(), 
            pr_user_address = '".$PC_NAME."-".$IP_ADDRESS."' 
            WHERE 
            pr_id = '".$inPr_id."'";
    
    $res = $db1->prepare($sql);
    $res->execute();

    // INSERT SPEC MANUAL
    if ($inSpecMode == 'MANUAL') {
        $sql4 = "SELECT * FROM t_spec_manual WHERE sm_pr_code ='".$inPr_code."'";
        $res4 = $db1->prepare($sql4);
        $res4->execute();
        $row4 = $res4->rowCount();

        if($row4 == 0) {
            $sql4 = "INSERT INTO t_spec_manual 
                    (sm_pr_code, sm_spec_id, sm_product_name, sm_packing_style, sm_company, sm_product_type, sm_user, sm_user_date, sm_user_address)
                    VALUES 
                    ('".$inPr_code."','".trim($_POST["inPr_spec_id"])."','".$inProductName."','".$inPackingStyle."','".$inCompany."','".$inProductType."', '".$ID_USER1."', NOW(), '".$PC_NAME."-".$IP_ADDRESS."')";

            $res4 = $db1->prepare($sql4); 
            $res4->execute();
        }
        else {
            $sql5 = "UPDATE t_spec_manual  
                    SET 
                    sm_spec_id = '".trim($_POST["inPr_spec_id"])."',
                    sm_product_name = '".$inProductName."',
                    sm_packing_style = '".$inPackingStyle."',
                    sm_company = '".$inCompany."',
                    sm_product_type = '".$inProductType."',
                    sm_user = '".$ID_USER1."',
                    sm_user_date = NOW(),
                    sm_user_address = '".$PC_NAME."-".$IP_ADDRESS."'
                    WHERE sm_pr_code = '".$inPr_code."'";

            $res5 = $db1->prepare($sql5); 
            $res5->execute();
        }
    }

    // UPLOAD DOCUMENT
    $error = 0 ;
    $exist = false;
    $countx = 0;

    $dirx = scandir('attachment/packagingRequirement');
    foreach ($dirx as $filex) {
        if (strpos($filex,$inPr_spec_id_name) !== false) {
            $countx++;
        }
    }

    if($countx > 0){
        $countx = "_".$countx;
    }

    for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++){
        if($_FILES["FILE"]["tmp_name"][$i] != ""){
            $exist = true;
            $ext = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));

            if($_FILES["FILE"]["error"][$i] > 0){
                ?><script>alert('File yang diupload tidak valid')</script><?php
                $error = 1;
            }
            else if($ext != "pdf"){
                ?><script>alert('Ekstensi file yang diupload tidak valid')</script><?php
                $error = 1;
            }
        }
    }

    if($error == 0){    
        for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++){
            if($_FILES["FILE"]["tmp_name"][$i] != ""){
                $ext        = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));
                $FILE       = "attachment/packagingRequirement/".$inPr_spec_id_name.$countx.".".$ext;

                move_uploaded_file($_FILES["FILE"]["tmp_name"][$i],$FILE);
                
                $sql3 = "UPDATE t_packaging_requirement SET pr_attachment = '".$FILE."' WHERE pr_code = '".$pr_code."'";
                $res3 = $db1->prepare($sql3); 
                $res3->execute();
            }
        }
    }    

    // cek email
    $sql5 = "SELECT STS_MAIL AS MODE_EMAIL FROM m_user WHERE KODE_USER = '$ID_USER1'";
    $res5 = $db1->prepare($sql5);
    $res5->execute();
    while ($data5 = $res5->fetch(PDO::FETCH_ASSOC)) {
        $MODE_EMAIL = $data5["MODE_EMAIL"];
    }

    // SEND EMAIL
    if (strtoupper($MODE_EMAIL) == "AKTIF") {
        $sql6 = "SELECT * FROM m_email WHERE e_menu = 'REQ' AND e_status = 1";
        $res6 = $db1->prepare($sql6);
        $res6->execute();
        $num6 = 0;

        $mail = new PHPMailer;
        $mail->isSendmail();                    
        $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');

        while ($data6 = $res6->fetch(PDO::FETCH_ASSOC)) {
            if ($num6 == 0) {
                $mail->AddAddress($data6["e_email"]);
            }
            else {
                $mail->addCC($data6["e_email"]);
            }

            $num6++;
        }

        if($inPr_revised_date !=""){
            $revisi_date = date("d-m-Y", strtotime($inPr_revised_date));
        }
        else {
            $revisi_date = " - ";
        }

        $mail->Subject = "Packaging Requirement " . $inPr_spec_id_name;
        $mail->msgHTML(
            "
            Kode Product Spec  : " . $inPr_spec_id_name . " <br>
            Revisi No          : " . sprintf("%02d", $inPr_revised_no) . " <br>
            Revisi Date        : " . $revisi_date . " <br>
            =============================================================================<br><br>
            Perusahaan         : " . $inCompany . " <br>
            Tipe Produk        : " . $inProductType . " <br>
            Nama Produk        : " . $inProductName . " <br>
            Packing            : " . $inPackingStyle . " <br>
            Revisi             : <br>" . $inPr_revised . " <br><br>
            =============================================================================<br>
            please do not reply to this email <br>
            for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
            Regards,<br>
            Quality Assurance - Spec");
        $mail->send();
    }

    ?>
    <script>alert('Data Berhasil Disimpan !');</script>
    <script>document.location.href='t_packagingRequirement.php';</script>
    <?php
}

//CREATE NEW
if(!isset($_GET["inPr_id"]) && isset($_POST["simpan"])){
    $inPr_spec_id = strtoupper(trim($_POST["inPr_spec_id"]));
    $inPr_spec_id_name = str_replace('/','-',$inPr_spec_id);

    $inPr_revised_no = trim($_POST["inPr_revised_no"]);
    $inPr_revised = trim($_POST["inPr_revised"]);
    
    if(trim($_POST["inPr_revised_date"]) != ""){
        $inPr_revised_date = trim($_POST["inPr_revised_date"]);
        $inPr_revised_date = date("Y-m-d H:i:s", strtotime($inPr_revised_date)); 
    }
    else {
        $inPr_revised_date = "";
    }

    $inSpecMode = trim($_POST["inSpecMode"]);

    // $inPr_spec_id = trim($_POST["inPr_spec_id"]);
    $inProductName = trim($_POST["inProductName"]);
    $inPackingStyle = trim($_POST["inPackingStyle"]);
    $inCompany = trim($_POST["inCompany"]);
    $inProductType = trim($_POST["inProductType"]);

    // CREATE PR CODE
    $sql = "SELECT * FROM m_code WHERE code_name = 'REQ' AND code_month = '".date('m')."' AND code_year = '".date('Y')."'";
    $res = $db1->prepare($sql);
    $res->execute();
    $row = $res->rowCount();
    $data = $res->fetch(PDO::FETCH_ASSOC);
    $num = 0;

    if ($row == 0) {
        $sql1 = "INSERT INTO m_code 
                (code_name, code_txt, code_month, code_year, code_number, code_user, code_user_date, code_user_address) 
                VALUES 
                ('REQ', 'Packaging Requirement', '".date('m')."', '".date('Y')."', '1', '".$ID_USER1."', NOW(), '".$PC_NAME."')
        ";
        $res1 = $db1->prepare($sql1);
        $res1->execute();

        $num = 1;
    }
    else {
        $sql1 = "UPDATE m_code 
                SET 
                code_number = code_number + 1 
                WHERE 
                code_name = 'REQ' AND 
                code_month = '".date('m')."' AND 
                code_year = '".date('Y')."'";
        
        $res1 = $db1->prepare($sql1);
        $res1->execute();

        $num = $data["code_number"]  + 1;
    }

    $pr_code = "REQ-".date('Y').date('m')."-".sprintf("%04s", $num);

    if ($inSpecMode == 'MANUAL') {
        $inPr_spec_id = $pr_code;
    }

    // INSERT PACKAGING REQUIREMENT
    $sql2 = "INSERT INTO t_packaging_requirement 
             (pr_code, pr_spec_id, pr_date, pr_revised_no, pr_revised, pr_revised_date, pr_user, pr_user_date, pr_user_address) 
             VALUES 
             ('".$pr_code."', '".$inPr_spec_id."', curdate(), '".$inPr_revised_no."', '".$inPr_revised."', '".$inPr_revised_date."', '".$ID_USER1."',NOW(), '".$PC_NAME."-".$IP_ADDRESS."')";
    
    $res2 = $db1->prepare($sql2);
    $res2->execute();

    // INSERT SPEC MANUAL
    if ($inSpecMode == 'MANUAL') {
        $sql3 = "INSERT INTO t_spec_manual 
                (sm_pr_code, sm_spec_id, sm_product_name, sm_packing_style, sm_company, sm_product_type, sm_user, sm_user_date, sm_user_address)
                VALUES 
                ('".$pr_code."','".trim($_POST["inPr_spec_id"])."','".$inProductName."','".$inPackingStyle."','".$inCompany."','".$inProductType."', '".$ID_USER1."', NOW(), '".$PC_NAME."-".$IP_ADDRESS."')";

        $res3 = $db1->prepare($sql3); 
        $res3->execute();
    }

    // UPLOAD DOCUMENT
    $error = 0 ;
    $exist = false;

    for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++){
        if($_FILES["FILE"]["tmp_name"][$i] != ""){
            $exist = true;
            $ext = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));

            if($_FILES["FILE"]["error"][$i] > 0){
                ?><script>alert('File yang diupload tidak valid')</script><?php
                $error = 1;
            }
            else if($ext != "pdf"){
                ?><script>alert('Ekstensi file yang diupload tidak valid')</script><?php
                $error = 1;
            }
        }
    }

    if($exist == false){
        ?><script>alert('Belum ada file yang dimasukkan')</script><?php
        $error = 1;
    }

    if($error == 0){    
        for($i=0; $i<count($_FILES["FILE"]["tmp_name"]); $i++){
            if($_FILES["FILE"]["tmp_name"][$i] != ""){
                $ext        = strtolower(pathinfo($_FILES["FILE"]["name"][$i], PATHINFO_EXTENSION));
                $FILE       = "attachment/packagingRequirement/".$inPr_spec_id_name.".".$ext;

                move_uploaded_file($_FILES["FILE"]["tmp_name"][$i],$FILE);
                
                $sql4 = "UPDATE t_packaging_requirement SET pr_attachment = '".$FILE."' WHERE pr_code = '".$pr_code."'";
                $res4 = $db1->prepare($sql4); 
                $res4->execute();
            }
        }
    }

    // cek email
    $sql5 = "SELECT STS_MAIL AS MODE_EMAIL FROM m_user WHERE KODE_USER = '$ID_USER1'";
    $res5 = $db1->prepare($sql5);
    $res5->execute();
    while ($data5 = $res5->fetch(PDO::FETCH_ASSOC)) {
        $MODE_EMAIL = $data5["MODE_EMAIL"];
    }

    // SEND EMAIL
    if (strtoupper($MODE_EMAIL) == "AKTIF") {
        $sql6 = "SELECT * FROM m_email WHERE e_menu = 'REQ' AND e_status = 1";
        $res6 = $db1->prepare($sql6);
        $res6->execute();
        $num6 = 0;

        $mail = new PHPMailer;
        $mail->isSendmail();                    
        $mail->setFrom('no-reply@baramudabahari.com','MIS Administrator System');

        while ($data6 = $res6->fetch(PDO::FETCH_ASSOC)) {
            if ($num6 == 0) {
                $mail->AddAddress($data6["e_email"]);
            }
            else {
                $mail->addCC($data6["e_email"]);
            }

            $num6++;
        }

        if($inPr_revised_date !=""){
            $revisi_date = date("d-m-Y", strtotime($inPr_revised_date));
        }
        else {
            $revisi_date = " - ";
        }

        $mail->Subject = "Packaging Requirement " . $inPr_spec_id_name;
        $mail->msgHTML(
            "
            Kode Product Spec  : " . $inPr_spec_id_name . " <br>
            Revisi No          : " . sprintf("%02d", $inPr_revised_no) . " <br>
            Revisi Date        : " . $revisi_date . " <br>
            =============================================================================<br><br>
            Perusahaan         : " . $inCompany . " <br>
            Tipe Produk        : " . $inProductType . " <br>
            Nama Produk        : " . $inProductName . " <br>
            Packing            : " . $inPackingStyle . " <br>
            Revisi             : <br>" . $inPr_revised . " <br><br>
            =============================================================================<br>
            please do not reply to this email <br>
            for more information, kindly visit <a href='192.168.10.167/BB/spec'>specproduct.baramudabahari</a><br><br><br>
            Regards,<br>
            Quality Assurance - Spec");
        $mail->send();
    }

    ?>
    <script>alert('Data Berhasil Disimpan !');</script>
    <script>document.location.href='t_packagingRequirement.php';</script>
    <?php
    die(0);
}
?>