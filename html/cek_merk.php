<?php
    require_once("module/model/koneksi/koneksi.php");
    
	if($_POST["KODE_MERK"] == 777) //tidak digunakan lagi
    {
		?>
        <div class="form-group">
            <label for="JUMLAH">Jumlah Upload</label><br>
            <input type="text" class="form-control" id="TAMBAH" maxlength="2" name="TAMBAH" oninput="getUPLOAD(this.value);" onkeypress="return event.keyCode!=13">
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="form-group">
            <label for="FILE">Upload IM General (PDF)</label><br>
            <input type="file" required="" name="FILE[]" accept="application/pdf" /> <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB</strong></i></span><br/>
        </div>
        <?php
    }
?>