<?php
$u               = date("Ym");
$DINO            = date('Y-m-d H:i:s');
$KODE_BUYER      = createKode("m_buyer","KODE_BUYER","BYR-$u-",4);
$NAMA_BUYER      = "";
$KODE_PERUSAHAAN = "";

$ID_USER1        = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME         = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_BUYER"]))
{
    $KODE_BUYER = $_GET["KODE_BUYER"];
    $result = $db1->prepare("select * from m_buyer where KODE_BUYER = '$KODE_BUYER'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_BUYER      = $row["NAMA_BUYER"];
        $KODE_PERUSAHAAN = $row["KODE_PERUSAHAAN"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_BUYER      = $_POST["NAMA_BUYER"];
        $KODE_PERUSAHAAN = $_POST["KODE_PERUSAHAAN"];

        $result1 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Buyer','Edit','Kode = $KODE_BUYER')"); 
	    $result1->execute();

        $result2 = $db1->prepare("update m_buyer set NAMA_BUYER = '$NAMA_BUYER', KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' where KODE_BUYER = '$KODE_BUYER'"); 
	    $result2->execute();
        ?><script>document.location.href='m_buyer.php';</script><?php
        die(0);
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $NAMA_BUYER      = $_POST["NAMA_BUYER"];
    $KODE_PERUSAHAAN = $_POST["KODE_PERUSAHAAN"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Buyer','Tambah','Kode = $KODE_BUYER')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_buyer (KODE_BUYER,NAMA_BUYER,KODE_PERUSAHAAN) values ('$KODE_BUYER','$NAMA_BUYER','$KODE_PERUSAHAAN')");
	$result2->execute();

    ?><script>document.location.href='m_buyer.php';</script><?php
    die(0);
}
?>