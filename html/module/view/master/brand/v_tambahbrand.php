<?php
include "module/controller/master/brand/t_brand.php"; 
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Brand</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_brand.php"><i class="fa fa-cube fa-lg"></i> Master Brand</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Brand</li>
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
                        <label for="NAMA_BRAND">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="NAMA_BRAND" name="NAMA_BRAND" value="<?php echo $NAMA_BRAND; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp&nbsp&nbsp
                    <a href="m_brand.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>