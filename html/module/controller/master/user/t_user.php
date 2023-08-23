<?php
$KODE_USER      = "";
$NAMA_USER      = "";
$DEPARTEMEN     = "";
$PASSWORD       = "";
$AUTH           = "";
$AKSES_DOC      = "";
$KODE_PERUSAHAAN= "";
$EMAIL          = "";
$STATUS         = "";
$NOMOR          = "";
$JOIN_NAMA      = "";

$options = [
    'cost' => 12,
];

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = $_SESSION["PC_NAME_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

//EDIT USER
if(isset($_GET["KODE_USER"]))
{
    $KODE_USER = $_GET["KODE_USER"];
    $KP        = $_GET["KP"];
        
    $result = $db1->prepare("select * from m_user where KODE_USER = '$KODE_USER' and KODE_PERUSAHAAN = '$KP'"); 
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        $DEPARTEMEN      = $row["DEPARTEMEN"];
        $NAMA_USER       = $row["NAMA_USER"];
        $STATUS          = $row["STATUS"];
        $AUTH            = $row["AKSES"];
        $AKSES_DOC       = $row["AKSES_DOC"];
        $KODE_PERUSAHAAN = $row["KODE_PERUSAHAAN"];
        $PASSWORD_BCRYPT = $row["PASSWORD"];
        $EMAIL           = $row["EMAIL"];
        $STATUS          = $row["STATUS"];
        $NOMOR           = $row["NOMOR"];
        $JOIN_NAMA       = $row["JOIN_NAMA"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_USER       = $_POST["NAMA_USER"];
        $PASSWORD        = password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);
        $DEPARTEMEN      = $_POST["DEPARTEMEN"];
        $STATUS          = $_POST["STATUS"];
        $AUTH            = $_POST["AUTH"];
        $AKSES_DOC       = $_POST["AKSES_DOC"];
        $PWD             = $_POST["PASSWORD"];
        $EMAIL           = $_POST["EMAIL"];
        $NOMOR           = $_POST["NOMOR"];
        $JOIN_NAMA       = $_POST["JOIN_NAMA"];

        $result2 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','User','Edit','Kode = $KODE_USER, Pass = $PWD')"); 
        $result2->execute();

        $result3 = $db1->prepare("update m_user set NAMA_USER = '$NAMA_USER', PASSWORD = '$PASSWORD', DEPARTEMEN = '$DEPARTEMEN', STATUS = '$STATUS', AKSES = '$AUTH', AKSES_DOC = '$AKSES_DOC', EMAIL = '$EMAIL', KODE_PERUSAHAAN = '$KODE_PERUSAHAAN', NOMOR = '$NOMOR', JOIN_NAMA = '$JOIN_NAMA' where KODE_USER = '$KODE_USER'"); 
        $result3->execute();
        ?><script>document.location.href='m_user.php';</script><?php
        die(0);
    }
}

//TAMBAH TYPE_AKSES
if(isset($_POST["simpan3"]))
{
    $KODE_AUTO       = kodeAuto("m_typeakses", "ID_SEQ");
    $KODE_USER       = $_GET["KODE_USER"];
    $KP              = $_GET["KP"];
    $KODE_MERK       = $_POST["AKSES"];

    $resultak        = $db1->prepare("select * from m_user where KODE_USER = '$KODE_USER'"); 
    $resultak->execute();
    if($rowtak = $resultak->fetch(PDO::FETCH_ASSOC))
    {
        $ACCESS = $rowtak["AKSES"]; 
    }

    $result = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                             values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Akses User','Tambah Akses','Kode User = $KODE_USER, Kode Akses = $KODE_MERK')"); 
    $result->execute();

    $result2 = $db1->prepare("insert into m_typeakses (
                ID_SEQ, KODE_MERK, KODE_USER, KODE_PERUSAHAAN, CREATED_DATE, CREATED_BY, ACCESS_TYPE) 
        values ('$KODE_AUTO','$KODE_MERK','$KODE_USER','$KP','$DINO', '$ID_USER1','$ACCESS')"); 
    $result2->execute();
    ?><script>document.location.href='edit_akses.php?KODE_USER=<?php echo $KODE_USER; ?>&&KP=<?php echo $KP; ?>';</script><?php
    die(0);
}


//TAMBAH_USER
if(isset($_POST["simpan"]))
{
    $KODE_USER       = $_POST["KODE_USER"];
    $NAMA_USER       = $_POST["NAMA_USER"];
    $PASSWORD        = password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);
    $DEPARTEMEN      = $_POST["DEPARTEMEN"];
    $AUTH            = $_POST["AUTH"];
    $AKSES_DOC       = $_POST["AKSES_DOC"];
    $PWD             = $_POST["PASSWORD"];
    $EMAIL           = $_POST["EMAIL"];
    $KODE_PERUSAHAAN = $_POST["KODE_PERUSAHAAN"];
    $NOMOR           = $_POST["NOMOR"];
    $JOIN_NAMA       = $_POST["JOIN_NAMA"];

    $result = $db1->prepare(
        "insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','User','Tambah','Kode = $KODE_USER, Pass = $PWD')"); 
    $result->execute();

    $result2 = $db1->prepare("insert into m_user (KODE_USER,DEPARTEMEN,NAMA_USER,PASSWORD,STATUS,AKSES,AKSES_DOC,EMAIL,KODE_PERUSAHAAN,NOMOR,JOIN_NAMA) values ('$KODE_USER','$DEPARTEMEN','$NAMA_USER','$PASSWORD','Aktif','$AUTH','$AKSES_DOC','$EMAIL','$KODE_PERUSAHAAN','$NOMOR','$JOIN_NAMA')"); 
    $result2->execute();

    ?><script>document.location.href='edit_akses.php?KODE_USER=<?php echo $KODE_USER;?>&&KP=<?php echo $KODE_PERUSAHAAN;?>'</script><?php
    die(0);
}
?>