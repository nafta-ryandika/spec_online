<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="">Choose Buyer</option>
	<?php
	if(!empty($_POST["KODE_PERUSAHAAN"])) {
		$KODE_PERUSAHAAN = $_POST["KODE_PERUSAHAAN"];
		$results = $db1->prepare("select * from m_buyer where KODE_PERUSAHAAN = '$KODE_PERUSAHAAN'") or trigger_error(mysql_error()); 
		$results->execute();
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $rowz["KODE_BUYER"]; ?>"><?php echo $rowz["NAMA_BUYER"]; ?></option>
			<?php
		}
	}
?>