<?php
include "module/controller/master/nomor/t_nomor.php"; 
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Doc. Number and User</li></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_nomor.php"><i class="fa fa-copy fa-lg"></i> Master Doc. Number and User</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Doc. Number and User</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NOMOR">Document Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="NOMOR" name="NOMOR" value="<?php echo $NOMOR; ?>" data-parsley-required>
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="JOIN_NAMA">Document Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="JOIN_NAMA" name="JOIN_NAMA" value="<?php echo $JOIN_NAMA; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp;&nbsp;&nbsp;
                    <a href="m_buyer.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>