<?php
include "module/controller/parameter/t_reemail.php"; 
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-envelope-alt fa-lg"></i> Email Manual</li></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-envelope-alt fa-lg"></i> Email Manual</a></li>
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
                        <label for="">No Dokumen Spec</label>
                        <input type="text" autocomplete="off" class="form-control" id="SPEC_CODE" name="SPEC_CODE">
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">No Internal Memo</label>
                        <input type="text" autocomplete="off" class="form-control" id="GENERAL_CODE" name="GENERAL_CODE">
                    </div>                           
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp&nbsp&nbsp
                    <a href="menuutama.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>