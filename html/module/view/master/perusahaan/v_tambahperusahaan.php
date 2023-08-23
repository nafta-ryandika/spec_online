<?php include "module/controller/master/perusahaan/t_perusahaan.php"; ?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-office"></i> Master Company</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_perusahaan.php"><i class="ico-office"></i> Company</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Company</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NAMA_PERUSAHAAN">Company Name</label>
                        <input type="text" class="form-control" required="" id="NAMA_PERUSAHAAN" name="NAMA_PERUSAHAAN" value="<?php echo $NAMA_PERUSAHAAN; ?>">
                    </div>                          
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ALAMAT_PERUSAHAAN">Company Address</label>
                        <input type="text" class="form-control" required="" id="ALAMAT_PERUSAHAAN" name="ALAMAT_PERUSAHAAN" value="<?php echo $ALAMAT_PERUSAHAAN; ?>">
                    </div>                          
                </div>                              
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NO_TELP">Phone Number</label>
                        <input type="text" class="form-control" required="" id="NO_TELP" name="NO_TELP" value="<?php echo $NO_TELP; ?>">
                    </div>                          
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="KODE_POS">Zip Code</label>
                        <input type="text" class="form-control" required="" id="KODE_POS" name="KODE_POS" value="<?php echo $KODE_POS; ?>">
                    </div>                          
                </div>                              
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp&nbsp&nbsp
                    <a href="m_perusahaan.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>