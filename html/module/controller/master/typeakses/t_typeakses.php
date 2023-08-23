<?php

$KODE_AKSES     = "";
$NAMA_AKSES     = "";
$NAMA_MERK      = "";
$KODE_AUTO      = kodeAuto("m_merk", "KODE_MERK");

$options = [
    'cost' => 12,
];

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = $_SESSION["PC_NAME_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

//EDIT TYPE AKSES
if(isset($_GET["KODE_MERK"]))
{
    $KODE_MERK = $_GET["KODE_MERK"];
        
    $result = $db1->prepare("select * from m_merk where KODE_MERK = '$KODE_MERK'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $KODE_MERK       = $row["KODE_MERK"];
        $NAMA_MERK       = $row["NAMA_MERK"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_USER       = $_POST["NAMA_AKSES"];

        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Type Akses','Edit','Kode = $KODE_MERK')"); 
        $result2->execute();

        $result3 = $db1->prepare("update m_merk set NAMA_MERK = '$NAMA_USER' where KODE_MERK = '$KODE_MERK'"); 
        $result3->execute();
        ?><script>document.location.href='m_typeakses.php';</script><?php
        die(0);
    }
}

//TAMBAH_TYPE AKSES
if(isset($_POST["simpan"]))
{
    $NAMA_AKSES       = $_POST["NAMA_AKSES"];

    $result = $db1->prepare(
        "insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Type Akses','Tambah','Kode = $KODE_AUTO')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_merk (KODE_MERK, NAMA_MERK) values ('$KODE_AUTO','$NAMA_AKSES')"); 
	$result2->execute();

    ?><script>document.location.href='m_typeakses.php';</script><?php
    die(0);
}
?>