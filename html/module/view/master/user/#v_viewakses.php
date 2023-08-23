<?php
include "module/controller/master/user/t_viewakses.php"; 
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-tags"></i> View Akses</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_user.php"><i class="ico-group"></i> User</a></li>
                <li class="active"><i class="ico-tags"></i> View Akses</li>
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
                        <label for="AKSES">Akses <span class="text-danger">*</span></label>
                        <select name="AKSES" id="AKSES" required="" class="form-control" data-parsley-required>
                            <option value="">Pilih Akses</option>
                            <?php
                            $result = $db1->prepare("select * from m_merk where NAMA_MERK != ''"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $row["KODE_MERK"]; ?>"><?php echo $row["NAMA_MERK"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                           
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label style="color:transparent">.</label><br>
                        <button type="submit" name="cari" class="btn btn-success"><i class="ico-search"></i> Cari</button>
                    </div>                           
                </div>
            </div>

            <!-- HERE -->

            <div class="row">
                <div class="col-lg-12" align="center">
                    <a href="m_user.php" type="button" class="btn btn-primary"><i class="ico-save"></i> Selesai</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>