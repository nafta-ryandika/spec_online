
<script type="text/javascript">
    function getKODE_SPEC(val) {
      $.ajax({
      type: "POST",
      url: "cek_nomorspec.php",
      data:'SPEC_CODE='+val,
      success: function(data){
        $("#VALID").html(data);
      }
      });
    }
</script>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="SPEC_CODE">No. Document Spec <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" id="SPEC_CODE" name="SPEC_CODE" value="<?php echo $SPEC_CODE; ?>" oninput="getKODE_SPEC(this.value);" onkeypress="return event.keyCode!=13" data-parsley-required>
            <div id="VALID"></div>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="JENIS_SPEC">Document Type <span class="text-danger">*</span></label>
            <select name="JENIS_SPEC" id="JENIS_SPEC" required="" class="form-control" data-parsley-required>
                <option value="">Choose Type</option>
                <?php
                $result = $db1->prepare("select JENIS_SPEC from param where JENIS_SPEC != ''"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["JENIS_SPEC"]; ?>"<?php if($JENIS_SPEC == $row["JENIS_SPEC"]) { echo "selected"; } ?>><?php echo $row["JENIS_SPEC"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="VERSI">Revisi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" id="VERSI" name="VERSI" value="<?php echo $VERSI; ?>" data-parsley-required>
        </div>                           
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Item Code <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" id="ITEM_CODE" name="ITEM_CODE" value="<?php echo $ITEM_CODE; ?>" data-parsley-required>
        </div>                           
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_PERUSAHAAN">Company Name <span class="text-danger">*</span></label>
            <select name="KODE_PERUSAHAAN" id="KODE_PERUSAHAAN" required="" class="form-control" onChange="getKODE_PERUSAHAAN(this.value);getKODE_BUYER(this.value);" data-parsley-required>
                <option value="">Choose Company</option>
                <?php
                $result = $db1->prepare("select * from m_perusahaan"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["KODE_PERUSAHAAN"]; ?>"<?php if($KODE_PERUSAHAAN == $row["KODE_PERUSAHAAN"]) { echo "selected"; } ?>><?php echo $row["NAMA_PERUSAHAAN"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_BUYER">Buyer <span class="text-danger">*</span></label>
            <select name="KODE_BUYER" id="KODE_BUYER" required="" class="form-control" data-parsley-required>
                <option value="">Choose Buyer</option>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_MERK">Product Type <span class="text-danger">*</span></label>
            <select name="KODE_MERK" id="KODE_MERK" required="" class="form-control" data-parsley-required>
                <option value="">Choose Product Type</option>
                <?php
                $result = $db1->prepare("select * from m_merk order by NAMA_MERK"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["KODE_MERK"]; ?>"<?php if($KODE_MERK == $row["KODE_MERK"]) { echo "selected"; } ?>><?php echo $row["NAMA_MERK"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_PRODUK">Product Name<span class="text-danger">*</span></label>
            <select name="KODE_PRODUK" id="KODE_PRODUK" required="" class="form-control" onChange="getKODE_PRODUK(this.value);" data-parsley-required>
                <option value="">Choose Product</option>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_BRAND">Brand Name <span class="text-danger">*</span></label>
            <select name="KODE_BRAND" id="selectize-ooo" required="" class="form-control" data-parsley-required>
                <option value="">Choose Brand</option>
                <?php
                $result = $db1->prepare("select * from m_brand order by NAMA_BRAND"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["KODE_BRAND"]; ?>"<?php if($KODE_BRAND == $row["KODE_BRAND"]) { echo "selected"; } ?>><?php echo $row["NAMA_BRAND"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_PACKING">Packing Name <span class="text-danger">*</span></label>
            <select name="KODE_PACKING" id="selectize-customselect" required="" class="form-control" data-parsley-required>
                <option value="">Choose Packing</option>
                <?php
                $result = $db1->prepare("select * from m_packing order by NAMA_PACKING"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["KODE_PACKING"]; ?>"<?php if($KODE_PACKING == $row["KODE_PACKING"]) { echo "selected"; } ?>><?php echo $row["NAMA_PACKING"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_ENDUSER">End User <span class="text-danger">*</span></label>
            <select name="KODE_ENDUSER" id="KODE_ENDUSER" required="" class="form-control" data-parsley-required>
                <option value="">Choose End User</option>
                <?php
                $result = $db1->prepare("select * from m_enduser order by NAMA_ENDUSER"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["KODE_ENDUSER"]; ?>"<?php if($KODE_ENDUSER == $row["KODE_ENDUSER"]) { echo "selected"; } ?>><?php echo $row["NAMA_ENDUSER"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="KODE_COUNTRY">Country of Origin <span class="text-danger">*</span></label>
            <select name="KODE_COUNTRY" id="KODE_COUNTRY" required="" class="form-control" data-parsley-required>
                <option value="">Choose Country of Origin</option>
                <?php
                $result = $db1->prepare("select * from m_country order by NAMA_COUNTRY"); 
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                {
                    ?>
                    <option value="<?php echo $row["KODE_COUNTRY"]; ?>"<?php if($KODE_COUNTRY == $row["KODE_COUNTRY"]) { echo "selected"; } ?>><?php echo $row["NAMA_COUNTRY"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>                           
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="KETERANGAN">Revised </label>
            <textarea class="form-control" name="KETERANGAN" id="KETERANGAN" rows="6"><?php echo $KETERANGAN; ?></textarea>
        </div>                          
    </div>
</div>
<div class="row">
    <div class="col-md-4" id="UPLOAD">
        <div class="form-group">
            <label for="FILEPROD">Upload Dok. Spec Product (PDF)</label><br>
            <input type="file" required="" name="FILEPROD" accept="application/pdf" /> <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB</strong></i></span><br/>
        </div>
    </div>
    <div class="col-md-4" id="UPLOAD">
        <div class="form-group">
            <label for="FILEPACK">Upload Dok. Spec Packaging (PDF)</label><br>
            <input type="file" required="" name="FILEPACK" accept="application/pdf" /> <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB</strong></i></span><br/>
        </div>
    </div>
    <div class="col-md-4" id="UPLOAD">
        <div class="form-group">
            <label for="FILE">Upload Dok. Spec Full (PDF)</label><br>
            <input type="file" required="" name="FILE" accept="application/pdf" /> <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB</strong></i></span><br/>
        </div>
    </div>
</div>