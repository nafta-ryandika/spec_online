<?php
$u              = date("Ym");
$DINO           = date('Y-m-d H:i:s');
$KODE_ENDUSER   = createKode("m_enduser","KODE_ENDUSER","EU-$u-",4);
$NAMA_ENDUSER   = "";
$ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME        = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_ENDUSER"]))
{
    $KODE_ENDUSER = $_GET["KODE_ENDUSER"];
    $result = $db1->prepare("select * from m_enduser where KODE_ENDUSER = '$KODE_ENDUSER'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_ENDUSER = $row["NAMA_ENDUSER"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_ENDUSER = $_POST["NAMA_ENDUSER"];
        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','End User','Edit','Kode = $KODE_ENDUSER')"); 
        $result2->execute();

        $result3 = $db1->prepare("update m_enduser set NAMA_ENDUSER = '$NAMA_ENDUSER' where KODE_ENDUSER = '$KODE_ENDUSER'"); 
        $result3->execute();
        ?><script>document.location.href='m_enduser.php';</script><?php
        die(0);
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $NAMA_ENDUSER = $_POST["NAMA_ENDUSER"];
    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','End User','Tambah','Kode = $KODE_ENDUSER')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_enduser (KODE_ENDUSER,NAMA_ENDUSER) values ('$KODE_ENDUSER','$NAMA_ENDUSER')"); 
	$result2->execute();
    ?><script>document.location.href='m_enduser.php';</script><?php
    die(0);
}
?>