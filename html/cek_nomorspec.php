<?php
	require_once("module/model/koneksi/koneksi.php");
	$PER = $_SESSION["LOGINPER_SPEC_BB"];

	if(!empty($_POST["SPEC_CODE"])) {
		$SPEC_CODE = $_POST["SPEC_CODE"];
		$results = $db1->prepare("select count(SPEC_CODE) as count from t_spec where SPEC_CODE = '$SPEC_CODE' and KODE_PERUSAHAAN = '$PER'") or trigger_error(mysql_error()); 
		$results->execute();
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) {
			if ($rowz["count"] != 0) {
				?>
					<span style="color:red;"><i>Nomor Dokumen Sudah Tersedia*</i></span>
				<?php
			}
		}
	}
?>