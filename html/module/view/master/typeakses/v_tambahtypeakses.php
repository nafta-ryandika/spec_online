<?php
include "module/controller/master/typeakses/t_typeakses.php"; 

$KODE_MERK = $_GET["KODE_MERK"];

$result2 = GetQuery("
    select * from m_merk where KODE_MERK = '$KODE_MERK'");  

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Type Akses</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_typeakses.php"><i class="ico-group"></i> Master Type Akses</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Type Akses</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NAMA_AKSES">Nama Type Akses <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="NAMA_AKSES" name="NAMA_AKSES" value="<?php echo $NAMA_MERK; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <br><br>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp;&nbsp;&nbsp;
                    <a href="m_typeakses.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>