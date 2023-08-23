<?php
	require_once("module/model/koneksi/koneksi.php");
	$PER = $_SESSION["LOGINPER_SPEC_BB"];

	if(!empty($_POST["GENERAL_CODE"])) 
	{
		$GENERAL_CODE = $_POST["GENERAL_CODE"];
		$results 	  = $db1->prepare("select count(GENERAL_CODE) as count from m_general where GENERAL_CODE = '$GENERAL_CODE' and KODE_PERUSAHAAN = '$PER'") or trigger_error(mysql_error()); 
		$results->execute();
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) {
			if ($rowz["count"] != 0) {
				?>
				<span style="color:red;"><i>Nomor Dokumen Sudah Terpakai*</i></span>
				<?php
			}
		}
	}
?>