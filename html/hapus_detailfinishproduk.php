<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

if(isset($_GET["KODE_SPEC"]))
{
    $DINO=date('Y-m-d H:i:s');
    $ID_USER1 = $_SESSION["LOGINIDUS_SPEC_BB"];
    $IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
    $KODE_SPEC = $_GET["KODE_SPEC_BB"];
    $NOMOR = $_GET["NOMOR"];
    $PC_NAME = $_SESSION["PC_NAME_SPEC_BB"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Finish Product','Delete Detail Finish Product','User Menghapus Detail Finish Product dengan Kode $KODE_SPEC')"); 
	$result->execute();

    $result2 = $db1->prepare("delete from d_spec where KODE_SPEC = '$KODE_SPEC' and NOMOR = '$NOMOR'"); 
	$result2->execute();

    ?><script>document.location.href='t_finishproduk.php';</script><?php
    die(0);
}
?>