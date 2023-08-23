<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index';</script><?php
    die(0);
}

if(isset($_GET["KODE_MERK"]))
{
    $KODE_MERK      = $_GET["KODE_MERK"];
    $DINO           = date('Y-m-d H:i:s');
    $ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
    $IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];
    $PC_NAME        = $_SESSION["PC_NAME_SPEC_BB"];

    $stmt1 = $db1->prepare(
        "insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                       values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Type Akses','Hapus Type Akses','User Menghapus Master Type Akses KODE AKSES = '$KODE_MERK')");
    $stmt1->execute();

    $stmt2 = $db1->prepare("delete from m_merk where KODE_MERK = '$KODE_MERK'");
    $stmt2->execute();

    ?><script>document.location.href='m_typeakses.php';</script><?php
    die(0);
}
?>