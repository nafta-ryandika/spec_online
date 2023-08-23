<?php
	require_once("module/model/koneksi/koneksi.php");

	if(!empty($_POST["TAMBAH"])) {
		$TAMBAH = $_POST["TAMBAH"];
		for ($i=0; $i < $TAMBAH; $i++) { 
			?>
			<div class="row">
				<div class="col-md-3">
			        <div class="form-group">
			            <label for="File">Upload File (PDF)</label><br>
			            <div>
			                <input type="file" name="FILE[]" accept="application/pdf" /> <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB / FILE</strong></i></span><br/>
			            </div>
			        </div>
			    </div>
			    <div class="col-md-4">
			        <div class="form-group">
			            <label for="NOMOR">Number / Department / User <span class="text-danger">*</span></label>
				            <select name="NOMOR[]" id="NOMOR" class="form-control">
			                <option value="">Choose User</option>
			                <?php
							$result = $db1->prepare("select NOMOR,DEPARTEMEN,JOIN_NAMA from m_user where NOMOR != '' group by NOMOR") or trigger_error(mysql_error()); 
							$result->execute();
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    ?>
			                    <option value="<?php echo $row["NOMOR"]; ?>"><?php echo $row["NOMOR"]; ?> / <?php echo $row["DEPARTEMEN"]; ?> / <?php echo $row["JOIN_NAMA"]; ?></option>
			                    <?php
			                }
			                ?>
			            </select>
			        </div>                           
			    </div>
			</div>
			<?php
		}
	}
?>