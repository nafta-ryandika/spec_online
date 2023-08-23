<?php
$u              = date("Ym");
$KODE_PACKING   = createKode("m_packing","KODE_PACKING","PACK-$u-",4);
$NAMA_PACKING   = "";
$DINO           = date('Y-m-d H:i:s');
$ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME        = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_PACKING"]))
{
    $KODE_PACKING = $_GET["KODE_PACKING"];
    $result = $db1->prepare("select * from m_packing where KODE_PACKING = '$KODE_PACKING'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_PACKING = $row["NAMA_PACKING"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_PACKING = $_POST["NAMA_PACKING"];
        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Packing','Edit','Kode = $KODE_PACKING')"); 
        $result2->execute();

        $result3 = $db1->prepare("update m_packing set NAMA_PACKING = '$NAMA_PACKING' where KODE_PACKING = '$KODE_PACKING'"); 
        $result3->execute();
        ?><script>document.location.href='m_packing.php';</script><?php
        die(0);
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $NAMA_PACKING = $_POST["NAMA_PACKING"];
    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Packing','Tambah','Kode = $KODE_PACKING')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_packing (KODE_PACKING,NAMA_PACKING) values ('$KODE_PACKING','$NAMA_PACKING')"); 
	$result2->execute();
    ?><script>document.location.href='m_packing.php';</script><?php
    die(0);
}
?>