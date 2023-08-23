<?php
$u              = date("Ym");
$DINO           = date('Y-m-d H:i:s');
$KODE_COUNTRY   = createKode("m_country","KODE_COUNTRY","CNTR-$u-",4);
$NAMA_COUNTRY   = "";
$ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME        = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_COUNTRY"]))
{
    $KODE_COUNTRY = $_GET["KODE_COUNTRY"];
    $result = $db1->prepare("select * from m_country where KODE_COUNTRY = '$KODE_COUNTRY'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_COUNTRY = $row["NAMA_COUNTRY"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_COUNTRY = $_POST["NAMA_COUNTRY"];
        $result1 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Country','Edit','Kode = $KODE_COUNTRY')"); 
	    $result1->execute();

        $result2 = $db1->prepare("update m_country set NAMA_COUNTRY = '$NAMA_COUNTRY' where KODE_COUNTRY = '$KODE_COUNTRY'"); 
        $result2->execute();
        ?><script>document.location.href='m_country.php';</script><?php
        die(0);
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $NAMA_COUNTRY = $_POST["NAMA_COUNTRY"];
    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Country','Tambah','Kode = $KODE_COUNTRY')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_country (KODE_COUNTRY,NAMA_COUNTRY) values ('$KODE_COUNTRY','$NAMA_COUNTRY')"); 
	$result2->execute();

    ?><script>document.location.href='m_country.php';</script><?php
    die(0);
}
?>