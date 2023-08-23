<?php
include "module/controller/parameter/t_parameter.php"; 
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-share-alt fa-lg"></i> Parameter</li></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-share-alt fa-lg"></i> Parameter</a></li>
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
                        <label for="MODE_AUDIT">Mode Audit <span class="text-danger">*</span></label>
                        <select name="MODE_AUDIT" id="MODE_AUDIT" required="" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Aktif : Menyembunyikan dokumen internal, Tidak Aktif : Menampilkan semuanya" data-parsley-required>
                            <option value="">Choose Mode</option>
                            <?php
                            $result = $db1->prepare("select MODE_AUDIT from param where MODE_AUDIT != ''"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                            {
                                ?>
                                <option value="<?php echo $row["MODE_AUDIT"]; ?>"<?php if($MODE_AUDIT == $row["MODE_AUDIT"]) { echo "selected"; } ?>><?php echo $row["MODE_AUDIT"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="MODE_EMAIL">Mode Email <span class="text-danger">*</span></label>
                        <select name="MODE_EMAIL" id="MODE_EMAIL" required="" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Aktif : Mengirimkan notifikasi by email" data-parsley-required>
                            <option value="">Choose Mode</option>
                            <?php
                            $result = $db1->prepare("select MODE_AUDIT from param where MODE_AUDIT != ''"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $row["MODE_AUDIT"]; ?>"<?php if($MODE_EMAIL == $row["MODE_AUDIT"]) { echo "selected"; } ?>><?php echo $row["MODE_AUDIT"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
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