<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="">Choose Product</option>
	<?php
	if(!empty($_POST["KODE_PERUSAHAAN"])) {
		$KODE_PERUSAHAAN = $_POST["KODE_PERUSAHAAN"];
		$results = $db1->prepare("select * from m_produk where KODE_PERUSAHAAN = '$KODE_PERUSAHAAN' AND STS_HAPUS = '0' order by NAMA_PRODUK asc") or trigger_error(mysql_error()); 
		$results->execute();
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $rowz["KODE_PRODUK"]; ?>"><?php echo $rowz["NAMA_PRODUK"]; ?></option>
			<?php
		}
	}
?>