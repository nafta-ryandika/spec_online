<?php
$u              = date("Ym");
$KODE_GENERAL   = "";
$PERIHAL        = "";
$TANGGAL        = date("Y-m-d");
$DINO           = date('Y-m-d H:i:s');
$ID_USER1       = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_SPEC_BB"];

if(isset($_GET["KODE_GENERAL"]))
{
    $KODE_GENERAL = $_GET["KODE_GENERAL"];
    $result = $db1->prepare("select * from m_general where KODE_GENERAL = '$KODE_GENERAL'"); 
	$result->execute();
    while ($row  = $result->fetch(PDO::FETCH_ASSOC)) {
        $PERIHAL = $row["PERIHAL"];
        $TANGGAL = $row["TANGGAL"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERIHAL = $_POST["PERIHAL"];
        $TANGGAL = $_POST["TANGGAL"];

        $result2 = $db1->prepare(
                    "insert into t_userlog (KODE_USER,IP_ADDRESS,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                                    values ('$ID_USER1','$IP_ADDRESS','$DINO','Internal Memo General','Edit Internal Memo General','User Mengedit Internal Memo General dengan Kode $KODE_GENERAL')"); 
	    $result2->execute();

        $result3 = $db1->prepare("update m_general set PERIHAL = '$PERIHAL', TANGGAL = '$TANGGAL' where KODE_GENERAL = '$KODE_GENERAL'"); 
	    $result3->execute();

        ?><script>document.location.href='t_imgeneral.php';</script><?php
        die(0);
    }
}

if(isset($_POST["simpan"]))
{
    $KODE_GENERAL   = $_POST["KODE_GENERAL"];
    $PERIHAL        = $_POST["PERIHAL"];
    $TANGGAL        = $_POST["TANGGAL"];

    $result = $db1->prepare(
                "insert into t_userlog (KODE_USER,IP_ADDRESS,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                                values ('$ID_USER1','$IP_ADDRESS','$DINO','Internal Memo General','Tambah Internal Memo General','User Menambah Internal Memo General dengan Kode $KODE_GENERAL')"); 
	$result->execute();

    $result2 = $db1->prepare("insert into m_general (KODE_GENERAL,PERIHAL,TANGGAL) values ('$KODE_GENERAL','$PERIHAL','$TANGGAL')"); 
	$result2->execute();

    ?><script>document.location.href='t_imgeneral.php';</script><?php
    die(0);
}
?>