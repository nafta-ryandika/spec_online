<?php
$DINO       = date('Y-m-d H:i:s');
$NAMA_USER  = $_SESSION["LOGINNAMAUS_SPEC_BB"];
$PASSWORD   = "";
$ID_USER1   = $_SESSION["LOGINIDUS_SPEC_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_SPEC_BB"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

$options = [
    'cost' => 12,
];

if(isset($_POST["simpan"]))
{
    $PASSWORD   =  password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);
    $PASS       = $_POST["PASSWORD"];
    $NAMA_USER  = $_POST["NAMA_USER"];

    $result = $db1->prepare(
        "insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) 
                        values ('$ID_USER1','$IP_ADDRESS','$PC_NAME','$DINO','Profile','Edit','User = '$NAMA_USER', Pass = $PASS')"); 
	$result->execute();

    $result2 = $db1->prepare(
        "update m_user 
         set NAMA_USER = '$NAMA_USER', PASSWORD = '$PASSWORD' 
         where KODE_USER = '$ID_USER1'"); 
	$result2->execute();

    ?><script>document.location.href='menuutama.php';</script><?php
    die(0);
}
?>