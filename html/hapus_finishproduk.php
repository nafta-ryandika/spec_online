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
    $DINO           = date('Y-m-d H:i:s');
    $ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
    $IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];
    $PC_NAME        = $_SESSION["PC_NAME_SPEC_BB"];
    $KODE_SPEC      = $_GET["KODE_SPEC"];
    $KODE_BUYER     = $_GET["KODE_BUYER"];
    $KODE_PRODUK    = $_GET["KODE_PRODUK"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Finish Product','Delete','Kode $KODE_SPEC')"); 
	$result->execute();

    GetQuery("update d_spec set STATUS = 1 where KODE_SPEC = '$KODE_SPEC'");

 //    $VERSIAKH = GetQuery(
 //                "select max(VERSI) as VERSIAKHIR,
 //                        FILE 
 //                   from d_spec 
 //                  where KODE_SPEC = '$KODE_SPEC'");
 //    while ($rowAkh = $VERSIAKH->fetch(PDO::FETCH_ASSOC)) 
 //    {
 //        extract($rowAkh);
 //    }
	
	// if ($VERSIAKHIR == 0) 
 //    {
	// 	GetQuery("delete t_spec where KODE_SPEC = '$KODE_SPEC'");
	// 	GetQuery("delete d_spec where KODE_SPEC = '$KODE_SPEC'");
	// }
	// else 
 //    {
 //        GetQuery("update d_spec set STATUS = 1 where KODE_SPEC = '$KODE_SPEC'");
 //        GetQuery("update d_spec set STATUS = 0 where KODE_SPEC = '$KODE_SPEC' and VERSI = '$VERSIAKHIR'");
 //        GetQuery("update t_spec set VERSI = '$VERSIAKHIR', FILE = '$FILE' where KODE_SPEC = '$KODE_SPEC'");
	// }

    ?><script>document.location.href='t_finishproduk.php';</script><?php
    die(0);
}
?>