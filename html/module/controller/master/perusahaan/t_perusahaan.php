<?php
$KODE_PERUSAHAAN    = kodeAuto("m_perusahaan","KODE_PERUSAHAAN");
$DINO               = date('Y-m-d H:i:s');
$NAMA_PERUSAHAAN    = "";
$ALAMAT_PERUSAHAAN  = "";
$NO_TELP            = "";
$KODE_POS           = "";
$ID_USER1           = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS         = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME            = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_PERUSAHAAN"]))
{
    $KODE_PERUSAHAAN = $_GET["KODE_PERUSAHAAN"];
    $result = $db1->prepare("select * from m_perusahaan where KODE_PERUSAHAAN = '$KODE_PERUSAHAAN'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NAMA_PERUSAHAAN    = $row["NAMA_PERUSAHAAN"];
        $ALAMAT_PERUSAHAAN  = $row["ALAMAT_PERUSAHAAN"];
        $NO_TELP            = $row["NO_TELP"];
        $KODE_POS           = $row["KODE_POS"];
    }
    if(isset($_POST["simpan"]))
    {
        $NAMA_PERUSAHAAN    = $_POST["NAMA_PERUSAHAAN"];
        $ALAMAT_PERUSAHAAN  = $_POST["ALAMAT_PERUSAHAAN"];
        $NO_TELP            = $_POST["NO_TELP"];
        $KODE_POS           = $_POST["KODE_POS"];

        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Perusahaan','Edit Perusahaan','User Mengedit Perusahaan dengan Kode $KODE_PERUSAHAAN')"); 
        $result2->execute();

        $result3 = $db1->prepare("update m_perusahaan set NAMA_PERUSAHAAN = '$NAMA_PERUSAHAAN', ALAMAT_PERUSAHAAN = '$ALAMAT_PERUSAHAAN', NO_TELP = '$NO_TELP', KODE_POS = '$KODE_POS' where KODE_PERUSAHAAN = '$KODE_PERUSAHAAN'"); 
        $result3->execute();
        ?><script>document.location.href='m_perusahaan.php';</script><?php
        die(0);
    }
}

//EDIT
if(isset($_POST["simpan"]))
{
    $NAMA_PERUSAHAAN    = $_POST["NAMA_PERUSAHAAN"];
    $ALAMAT_PERUSAHAAN  = $_POST["ALAMAT_PERUSAHAAN"];
    $NO_TELP            = $_POST["NO_TELP"];
    $KODE_POS           = $_POST["KODE_POS"];

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Perusahaan','Tambah','Kode = $KODE_PERUSAHAAN')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_perusahaan (KODE_PERUSAHAAN,NAMA_PERUSAHAAN,ALAMAT_PERUSAHAAN,NO_TELP,KODE_POS) values ('$KODE_PERUSAHAAN','$NAMA_PERUSAHAAN','$ALAMAT_PERUSAHAAN','$NO_TELP','$KODE_POS')"); 
	$result2->execute();
    ?><script>document.location.href='m_perusahaan.php';</script><?php
    die(0);
}
?>