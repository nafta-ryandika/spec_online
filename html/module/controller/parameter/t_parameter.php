<?php
$u          = date("Ym");
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

$result = $db1->prepare("select * from p_audit"); 
$result->execute();
while ($rowau   = $result->fetch(PDO::FETCH_ASSOC)) 
{
    $MODE_AUDIT = $rowau["MODE_AUDIT"];
}

$result2 = $db1->prepare("select STS_MAIL from m_user where KODE_USER = '$ID_USER1'"); 
$result2->execute();
while ($rowm    = $result2->fetch(PDO::FETCH_ASSOC)) 
{
    $MODE_EMAIL = $rowm["STS_MAIL"];
}

if(isset($_POST["simpan"]))
{
    $MODE_AUDIT1 = $_POST["MODE_AUDIT"];
    $MODE_EMAIL1 = $_POST["MODE_EMAIL"];

    $result1 = $db1->prepare(
        "insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                        values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Parameter','Edit','Mode Audit : $MODE_AUDIT1, Mode Email : $MODE_EMAIL1')"); 
	$result1->execute();

    $result2 = $db1->prepare("update p_audit set MODE_AUDIT = '$MODE_AUDIT1' where MODE_AUDIT = '$MODE_AUDIT'"); 
    $result2->execute();
    
    $result3 = $db1->prepare("update m_user set STS_MAIL = '$MODE_EMAIL1' where KODE_USER = '$ID_USER1'"); 
	$result3->execute();

    ?><script>document.location.href='menuutama.php';</script><?php
    die(0);
}
?>