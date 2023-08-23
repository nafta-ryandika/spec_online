<?php
include "module/controller/imgeneral/tt_imgeneral.php";
$KODPER = $_SESSION["LOGINPER_SPEC_BB"];
?>
<script type="text/javascript">
    function getGENERAL_CODE(val) {
      $.ajax({
      type: "POST",
      url: "cek_nomorim.php",
      data:'GENERAL_CODE='+val,
      success: function(data){
        $("#VALID").html(data);
      }
      });
    }
    function getKODE_MERK(val) {
      $.ajax({
      type: "POST",
      url: "cek_merk.php",
      data:'KODE_MERK='+val,
      success: function(data){
        $("#UPLOAD").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Internal Memo General</li></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="t_imgeneral.php"><i class="fa fa-file fa-lg"></i> Internal Memo General</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Internal Memo General</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" id="form" action="" method="post" enctype="multipart/form-data" data-parsley-validate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Internal Memo Type <span class="text-danger">*</span></label>
                        <select name="JENIS" id="JENIS" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Type</option>
                            <?php
                            $result = $db1->prepare("select JENIS_SPEC as JENIS from param where JENIS_SPEC is not null"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?php echo $row["JENIS"]; ?>"<?php if($JENIS == $row["JENIS"]) { echo "selected"; } ?>><?php echo $row["JENIS"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>   
                </div>  
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="GENERAL_CODE">Internal Memo Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="GENERAL_CODE" name="GENERAL_CODE" value="<?php echo $GENERAL_CODE; ?>" oninput="getGENERAL_CODE(this.value);" onkeypress="return event.keyCode!=13" data-parsley-required>
                        <div id="VALID"></div>
                    </div>                           
                </div>

                <?php
                if(isset($_GET["KODE_GENERAL"])) //jika edit
                {
                ?>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="SPEC_CODE">Doc. Spec Code </label>
                        <input type="text" class="form-control" id="SPEC_CODE" name="SPEC_CODE" value="<?php echo $SPEC_CODE; ?>">
                    </div>                           
                </div>
                <?php
                }
                else //jika IM baru
                {
                ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="SPEC_CODE">Doc. Spec Code </label>
                        <input type="text" class="form-control" list="SPEC_CODE" name="SPEC_CODE" required="" data-parsley-required multiple>
                          <datalist id="SPEC_CODE">
                            <option value="">Choose Company</option>
                            <?php
                            $result = $db1->prepare("select SPEC_CODE from t_spec where STS_AKTF = '0' and KODE_PERUSAHAAN = '$KODPER' order by SPEC_CODE asc"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $row["SPEC_CODE"]; ?>"<?php if($SPEC_CODE == $row["SPEC_CODE"]) { echo "selected"; } ?>>
                                    <?php echo $row["SPEC_CODE"]; ?>
                                </option>
                                <?php
                            }
                            ?>
                          </datalist>
                    </div>                           
                </div>
                <?php
                }
                ?>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="REVISI">Revised Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="REVISI" name="REVISI" value="<?php echo $REVISI; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
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
                        <label for="KODE_MERK">Product Type <span class="text-danger">*</span></label>
                        <select name="KODE_MERK" id="KODE_MERK" required="" class="form-control" data-parsley-required onChange="getKODE_MERK(this.value);">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TANGGAL">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="TANGGAL" id="TANGGAL" data-parsley-required value="<?php echo $TANGGAL; ?>" />
                    </div>                           
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PERIHAL">Subject <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="PERIHAL" name="PERIHAL" required="" data-parsley-required><?php echo $PERIHAL; ?></textarea>
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NOTE">Revised <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="NOTE" name="NOTE" required="" data-parsley-required><?php echo $NOTE; ?></textarea>
                    </div>                           
                </div>
                <div class="col-md-4" id="UPLOAD">
                    <div class="form-group">
                        <label for="FILE">Upload IM General (PDF)</label><br>
                        <input type="file" required="" name="FILE[]" accept="application/pdf" /> <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB</strong></i></span><br/>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp;&nbsp;&nbsp;
                    <a href="t_imgeneral.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('form').preventDoubleSubmission();
</script>