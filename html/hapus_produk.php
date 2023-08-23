<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

if(isset($_GET["KODE_PRODUK"]))
{
    $DINO=date('Y-m-d H:i:s');
    $ID_USER1 = $_SESSION["LOGINIDUS_SPEC_BB"];
    $IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
    $KODE_PRODUK = $_GET["KODE_PRODUK"];
    $PC_NAME = $_SESSION["PC_NAME_SPEC_BB"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Produk','Delete Produk','User Menghapus Produk dengan Kode $KODE_PRODUK')"); 
	$result->execute();

    // $result = $db1->prepare("delete from m_produk where KODE_PRODUK = '$KODE_PRODUK'"); 
    $result = $db1->prepare("update m_produk set STS_HAPUS='1' where KODE_PRODUK = '$KODE_PRODUK'"); 
	$result->execute();

    ?><script>document.location.href='m_produk.php';</script><?php
    die(0);
}
?>