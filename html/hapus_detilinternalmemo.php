<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

if(isset($_GET["KODE_GENERAL"]))
{
    $DINO=date('Y-m-d H:i:s');
    $ID_USER1 = $_SESSION["LOGINIDUS_SPEC_BB"];
    $IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
    $KODE_GENERAL = $_GET["KODE_GENERAL"];
    $GENERAL_CODE = $_GET["INTERNAL_MEMO"];
    $PC_NAME = $_SESSION["PC_NAME_SPEC_BB"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Internal Memo','Delete Detail Internal Memo','User Menghapus Detail Internal Memo dengan Kode $KODE_GENERAL')"); 
	$result->execute();

    GetQuery("update d_internalmemo set STS_AKTIF = '1' where KODE_GENERAL = '$KODE_GENERAL' and GENERAL_CODE = '$GENERAL_CODE'");

    ?><script>document.location.href='l_historyinternalmemo.php';</script><?php
    die(0);
}
?>