<?php
include "module/controller/master/buyer/t_buyer.php"; 
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Buyer</li></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_buyer.php"><i class="fa fa-user-o fa-lg"></i> Master Buyer</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Buyer</li>
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
                        <label for="KODE_PERUSAHAAN">Company Name <span class="text-danger">*</span></label>
                        <select name="KODE_PERUSAHAAN" id="KODE_PERUSAHAAN" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Company</option>
                            <?php
                            $result = $db1->prepare("select * from m_perusahaan"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?php echo $row["KODE_PERUSAHAAN"]; ?>"<?php if($KODE_PERUSAHAAN == $row["KODE_PERUSAHAAN"]) { echo "selected"; } ?>><?php echo $row["NAMA_PERUSAHAAN"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                           
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NAMA_BUYER">Buyer Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="NAMA_BUYER" name="NAMA_BUYER" value="<?php echo $NAMA_BUYER; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp&nbsp&nbsp
                    <a href="m_buyer.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>