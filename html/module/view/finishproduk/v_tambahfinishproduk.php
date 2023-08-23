<?php
include "module/controller/finishproduk/tt_finishproduk.php"; 
?>
<script type="text/javascript">
    function getKODE_PERUSAHAAN(val) {
      $.ajax({
      type: "POST",
      url: "cek_buyer.php",
      data:'KODE_PERUSAHAAN='+val,
      success: function(data){
        $("#KODE_BUYER").html(data);
      }
      });
    }
    function getKODE_BUYER(val) {
      $.ajax({
      type: "POST",
      url: "cek_produk.php",
      data:'KODE_PERUSAHAAN='+val,
      success: function(data){
        $("#KODE_PRODUK").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Finish Product Spec</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="t_finishproduk.php"><i class="fa fa-flag fa-lg"></i> Finish Product Spec</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Finish Product Spec</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" id="form" action="" method="post" enctype="multipart/form-data" data-parsley-validate>
            <div class="panel-body">
                <?php
                if (isset($_GET["KODE_SPEC"])) 
                {
                    include "konten/editspec.php";
                }
                else
                {
                    include "konten/tambahspec.php";
                }
                ?>
                <br><br>
                <div class="row">
                    <div class="col-lg-12" align="center">
                        <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp&nbsp&nbsp
                        <a href="t_finishproduk.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                    </div>                    
                </div>
            </div>
            <br><br>
        </form>
    </div>
</div>
<script type="text/javascript">
  $('form').preventDoubleSubmission();
</script>