<?php
	require_once("module/model/koneksi/koneksi.php");
	
	if(!empty($_POST["KODE_SPEC"])) 
    {
		$KODE_SPEC = $_POST["KODE_SPEC"];
		?>
		<table class="table table-striped table-bordered" id="zero-configuration">
            <thead>
                <tr>
                    <th>Opsi</th>
                    <th>Doc. Number</th>
                    <th>Doc. Name</th>
                    <th>User</th>
                    <th>User Name</th>
                    <th>Department</th>
                    <th>Doc. Spec</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result2 = $db1->prepare("select s.*,u.JOIN_NAMA,u.NAMA_USER,u.DEPARTEMEN from d_spec s, m_user u where s.NOMOR = u.NOMOR and s.KODE_SPEC = '$KODE_SPEC'"); 
                $result2->execute();
                while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <tr>
                        <td align="center"><a href="tambah_finishproduk.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&KODE_BUYER=<?php echo $row["KODE_BUYER"]; ?>&KODE_PRODUK=<?php echo $row["KODE_PRODUK"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a><a href="hapus_finishproduk.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&KODE_BUYER=<?php echo $row["KODE_BUYER"]; ?>&KODE_PRODUK=<?php echo $row["KODE_PRODUK"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus request ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                        <td align="center"><?php echo $row2["NOMOR"]; ?></td>
                        <td align="center"><?php echo $row2["JOIN_NAMA"]; ?></td>
                        <td align="center"><?php echo $row2["NAMA_USER"]; ?></td>
                        <td align="center"><?php echo $row2["DEPARTEMEN"]; ?></td>
                        <td align="center"><a href="<?php echo $row2["FILE"]; ?>"><i class="fa fa-file-pdf-o fa-lg"></i> Document</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
		<?php
	}
?>