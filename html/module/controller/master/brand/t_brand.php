<?php
$u          = date("Ym");
$KODE_BRAND = createKode("m_brand","KODE_BRAND","BRND-$u-",4);
$NAMA_BRAND = "";

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_BRAND"]))
{
    $KODE_BRAND = $_GET["KODE_BRAND"];
    $result = $db1->prepare("select * from m_brand where KODE_BRAND = '$KODE_BRAND'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_BRAND = $row["NAMA_BRAND"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_BRAND = $_POST["NAMA_BRAND"];
        $result1 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Brand','Edit','Kode = $KODE_BRAND')"); 
	    $result1->execute();

        $result2 = $db1->prepare("update m_brand set NAMA_BRAND = '$NAMA_BRAND' where KODE_BRAND = '$KODE_BRAND'"); 
	    $result2->execute();

        ?><script>document.location.href='m_brand.php';</script><?php
        die(0);
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $NAMA_BRAND = $_POST["NAMA_BRAND"];

    $result = $db1->prepare("insert into m_brand (KODE_BRAND,NAMA_BRAND) values ('$KODE_BRAND','$NAMA_BRAND')"); 
	$result->execute();

    
    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','BRAND','Tambah','Kode = $KODE_BRAND')"); 
    $result->execute();

    ?><script>document.location.href='m_brand.php';</script><?php
    die(0);
}
?>