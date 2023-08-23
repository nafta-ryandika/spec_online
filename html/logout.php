<?php
require_once ("module/model/koneksi/koneksi.php");
$DINO=date('Y-m-d H:i:s');
$ID_USER = $_SESSION["LOGINIDUS_SPEC_BB"];
$PC_NAME = $_SESSION["PC_NAME_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];

$result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER','$IP_ADDRESS','$PC_NAME','$DINO','Logout','Keluar','Logout User Aplikasi dengan Akses " . $_SESSION["LOGINAKS_SPEC_BB"] . "')"); 
$result->execute();

$result2 = $db1->prepare("update m_user set STS_LGN = '0' where KODE_USER = '$ID_USER'"); 
$result2->execute();

unset($_SESSION["LOGINIDUS_SPEC_BB"]);
unset($_SESSION["LOGINPER_SPEC_BB"]);
unset($_SESSION["IP_ADDRESS_SPEC_BB"]);
unset($_SESSION["PC_NAME_SPEC_BB"]);
unset($_SESSION["LOGINNAMAUS_SPEC_BB"]);
unset($_SESSION["LOGINAKS_SPEC_BB"]);
unset($_SESSION["LOGINAUTH_SPEC_BB"]);
unset($_SESSION["LOGINNOM_SPEC_BB"]);
unset($_SESSION["LOGINAKSDOC_SPEC_BB"]);
?><script>alert('Anda telah logout');</script><?php
?><script>document.location.href='index.php';</script><?php

?>