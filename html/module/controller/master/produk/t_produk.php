<?php
$u                  = date("Ym");
$DINO               = date('Y-m-d H:i:s');
$KODE_PRODUK        = createKode("m_produk","KODE_PRODUK","PROD-$u-",4);
$KODE_PERUSAHAAN    = "";
$KODE_BUYER         = "";
$NAMA_PRODUK        = "";
$ID_USER1           = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS         = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME            = gethostbyaddr($IP_ADDRESS);

//edit
if(isset($_GET["KODE_PRODUK"]))
{
    $KODE_PRODUK = $_GET["KODE_PRODUK"];
    $result = $db1->prepare("select * from m_produk where KODE_PRODUK = '$KODE_PRODUK'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_PRODUK        = $row["NAMA_PRODUK"];
        $KODE_PERUSAHAAN    = $row["KODE_PERUSAHAAN"];
        $KODE_BUYER         = $row["KODE_BUYER"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_PRODUK        = $_POST["NAMA_PRODUK"];
        $KODE_PERUSAHAAN    = $_POST["KODE_PERUSAHAAN"];
        $KODE_BUYER         = $_POST["KODE_BUYER"];

        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$DINO','Produk','Edit','Kode = $KODE_PRODUK')"); 
        $result2->execute();

        $result3 = $db1->prepare("update m_produk set NAMA_PRODUK = '$NAMA_PRODUK', KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', KODE_BUYER = '$KODE_BUYER' where KODE_PRODUK = '$KODE_PRODUK'"); 
        $result3->execute();
        ?><script>document.location.href='m_produk.php';</script><?php
        die(0);
    }
}

//baru
if(isset($_POST["simpan"]))
{
    $NAMA_PRODUK        = $_POST["NAMA_PRODUK"];
    $KODE_PERUSAHAAN    = $_POST["KODE_PERUSAHAAN"];
    $KODE_BUYER         = $_POST["KODE_BUYER"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Produk','Tambah','Kode = $KODE_PRODUK')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_produk (KODE_PRODUK,NAMA_PRODUK,KODE_PERUSAHAAN,KODE_BUYER) values ('$KODE_PRODUK','$NAMA_PRODUK','$KODE_PERUSAHAAN','$KODE_BUYER')"); 
	$result2->execute();

    ?><script>document.location.href='m_produk.php';</script><?php
    die(0);
}
?>