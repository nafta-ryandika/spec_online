<?php
require_once ("koneksi.php");
$DINO	 = date('Y-m-d H:i:s');
$ID_USER = $_SESSION["LOGINIDUS_SPEC_BB"];
$result  = $db1->prepare("insert into t_userlog (KODE_USER,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER','$DINO','Logout','Keluar','Logout User Aplikasi dengan Akses " . $_SESSION["LOGINAKS_SPEC_BB"] . "')"); 
$result->execute();

$result2 = $db1->prepare("update m_user set STS_LGN = '0' where KODE_USER = '$ID_USER'"); 
$result2->execute();

unset($_SESSION["LOGINIDUS_SPEC_BB"]);
?><script>alert('Anda telah logout');</script><?php
?><script>document.location.href='index.php';</script><?php
?>