<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

if(isset($_GET["KODE_USER"]))
{
    $DINO=date('Y-m-d H:i:s');
    $ID_USER1 = $_SESSION["LOGINIDUS_SPEC_BB"];
    $IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
    $KODE_USER = $_GET["KODE_USER"];
    $PC_NAME = $_SESSION["PC_NAME_SPEC_BB"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Nomor','Delete Nomor','User Menghapus Nomor dengan Kode $KODE_USER')"); 
	$result->execute();

    $result2 = $db1->prepare("update m_user set NOMOR = '', JOIN_NAMA = '' where KODE_USER = '$KODE_USER'"); 
	$result2->execute();

    ?><script>document.location.href='m_nomor.php';</script><?php
    die(0);
}
?>