<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

if(isset($_GET["inPr_id"])){
    $PC_NAME = $_SESSION["PC_NAME_SPEC_BB"];

    $inPr_id = $_GET["inPr_id"];

    $res1 = $db1->prepare("DELETE FROM t_spec_manual where sm_pr_code = (SELECT pr_code FROM t_packaging_requirement where pr_id = '$inPr_id')"); 
	$res1->execute();

    $res2 = $db1->prepare("DELETE FROM t_packaging_requirement where pr_id = '$inPr_id'"); 
	$res2->execute();

    ?>
    <script>alert('Data Berhasil Dihapus !');</script>
    <script>document.location.href='t_packagingRequirement.php';</script>
    <?php
    die(0);
}
?>