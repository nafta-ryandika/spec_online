<?php
$u          = date("Ym");
$NOMOR      = "";
$JOIN_NAMA  = "";
$NAMA_USER  = "";
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE_USER"]))
{
    $KODE_USER = $_GET["KODE_USER"];
    $result = $db1->prepare("select NOMOR,JOIN_NAMA,NAMA_USER from m_user where KODE_USER = '$KODE_USER'"); 
	$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $NOMOR     = $row["NOMOR"];
        $JOIN_NAMA = $row["JOIN_NAMA"];
        $NAMA_USER = $row["NAMA_USER"];
    }

    if(isset($_POST["simpan"]))
    {
        $NOMOR     = $_POST["NOMOR"];
        $JOIN_NAMA = $_POST["JOIN_NAMA"];
        $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Nomor','Edit','Kode = $KODE_USER')"); 
        $result->execute();

        $result = $db1->prepare("update m_user set NOMOR = '$NOMOR', JOIN_NAMA = '$JOIN_NAMA' where KODE_USER = '$KODE_USER'"); 
        $result->execute();

        if (!file_exists("pdf/".$NOMOR)) 
        {
            mkdir("pdf/".$NOMOR, 0777, true);
        }
        ?><script>document.location.href='m_nomor.php';</script><?php
        die(0);
    }
}
?>