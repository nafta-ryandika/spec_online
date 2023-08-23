<?php
	require_once("module/model/koneksi/koneksi.php");

	if(!empty($_POST["KODE_SPEC"])) {
		$KODE_SPEC = $_POST["KODE_SPEC"];
		?>
		<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Opsi</th>
                    <th>Doc. Number</th>
                    <th>Doc. Name</th>
                    <th>User Name</th>
                    <th>Department</th>
                    <th>Doc. Spec</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result2 = $db1->prepare("select s.*,u.JOIN_NAMA,u.NAMA_USER,u.DEPARTEMEN from d_spec s, m_user u where s.NOMOR = u.NOMOR and s.KODE_SPEC = '$KODE_SPEC' order by s.NOMOR") or trigger_error(mysql_error()); 
		        $result2->execute();
                while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td align="center"><a href="hapus_detailfinishproduk.php?KODE_SPEC=<?php echo $row2["KODE_SPEC"]; ?>&NOMOR=<?php echo $row2["NOMOR"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus request ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                        <td align="center"><?php echo $row2["NOMOR"]; ?></td>
                        <td align="center"><?php echo $row2["JOIN_NAMA"]; ?></td>
                        <td align="center"><?php echo $row2["NAMA_USER"]; ?></td>
                        <td align="center"><?php echo $row2["DEPARTEMEN"]; ?> <br> <i style="color: transparent;"><?php echo $row2["FILE"]; ?></i></td>
                        <td align="center"><a href="<?php echo $row2["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg"></i> Document</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
		<?php
	}
?>