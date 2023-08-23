<?php
include "module/controller/master/user/t_user.php"; 

$result2 = GetQuery("
    select P.*,
         m.NAMA_MERK ,
         u.STATUS
    from m_user u,
         m_typeakses p,
         m_merk m  
   where m.KODE_MERK = p.KODE_MERK and 
         u.KODE_USER = p.KODE_USER and
         u.KODE_PERUSAHAAN = '$KP' and
         p.KODE_PERUSAHAAN = '$KP' and
         u.KODE_USER='$KODE_USER'");  

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-universal-access fa-lg"></i> Edit Akses User</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_user.php"><i class="ico-group"></i> Master User</a></li>
                <li class="active"><i class="ico-plus2"></i> Add User</li>
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
                        <label for="KODE_USER">User Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" disabled id="KODE_USER" name="KODE_USER" value="<?php echo $KODE_USER; ?>" data-parsley-required>
                    </div>                           
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NAMA_USER">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" disabled id="NAMA_USER" name="NAMA_USER" value="<?php echo $NAMA_USER; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="KODE_PERUSAHAAN">Company <span class="text-danger">*</span></label>
                        <select disabled name="KODE_PERUSAHAAN" id="KODE_PERUSAHAAN" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Company</option>
                            <?php
                            $result = $db1->prepare("select * from m_perusahaan"); 
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?php echo $row["KODE_PERUSAHAAN"]; ?>"<?php if($KODE_PERUSAHAAN == $row["KODE_PERUSAHAAN"]) { echo "selected"; } ?>> <?php echo $row["NAMA_PERUSAHAAN"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                           
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="DEPARTEMEN">Department <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" disabled id="DEPARTEMEN" name="DEPARTEMEN" value="<?php echo $DEPARTEMEN; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
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
                <?php
                if (isset($_GET["KODE_USER"])) 
                {
                    ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label style="color:transparent">.</label><br>
                        <button type="submit" name="simpan3" class="btn btn-success"><i class="ico-plus2"></i> Tambah</button>
                    </div>                           
                </div>
                    <?php
                }
                ?>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 center">
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab"><strong>Daftar Akses User</strong></a></li><!-- 
                        <li><a href="#tab2" data-toggle="tab">Daftar Kebutuhan Spare Part</a></li>
                        <li><a href="#tab3" data-toggle="tab">Detail Pengerjaan Perbaikan</a></li> -->
                    </ul>
                    <div class="tab-content panel">
                        <div class="tab-pane active" id="tab1">
                            <div class="panel panel-default">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Opsi</th>
                                            <th>Akses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td align="center"><a href="hapus_akses.php?KODE_USER=<?php echo $row["KODE_USER"]; ?>&&KODE_MERK=<?php echo $row["KODE_MERK"]; ?>&&KP=<?php echo $_GET["KP"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                                                <td align=""><?php echo $row["NAMA_MERK"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp;&nbsp;&nbsp;
                    <a href="m_user.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>