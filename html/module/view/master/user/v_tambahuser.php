<?php
include "module/controller/master/user/t_user.php"; 

// $result2 = GetQuery("
//     select P.*,
//          m.NAMA_MERK ,
//          u.STATUS
//     from m_user u,
//          m_typeakses p,
//          m_merk m  
//    where m.KODE_MERK = p.KODE_MERK and 
//          u.KODE_USER = p.KODE_USER and
//          u.KODE_USER='$KODE_USER'");  

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add User</h4>
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
                        <input type="text" class="form-control" required="" autocomplete="off" id="KODE_USER" name="KODE_USER" value="<?php echo $KODE_USER; ?>" data-parsley-required>
                    </div>                           
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NAMA_USER">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="NAMA_USER" name="NAMA_USER" value="<?php echo $NAMA_USER; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="PASSWORD">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" required="" id="PASSWORD" name="PASSWORD" value="<?php echo $PASSWORD; ?>" data-parsley-required>
                    </div>                           
                </div>

                <!-- JIKA EDIT USER -->
                <?php
                    if (isset($_GET["KODE_USER"])) 
                    {
                ?>
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
                <!-- JIKA TAMBAH USER BARU -->
                <?php 
                    }
                    else
                    { 
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="KODE_PERUSAHAAN">Company <span class="text-danger">*</span></label>
                        <select name="KODE_PERUSAHAAN" id="KODE_PERUSAHAAN" required="" class="form-control" data-parsley-required>
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
                <?php 
                    } 
                ?>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="DEPARTEMEN">Department <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="DEPARTEMEN" name="DEPARTEMEN" value="<?php echo $DEPARTEMEN; ?>" data-parsley-required>
                    </div>                           
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="EMAIL">Email</label>
                        <input type="text" class="form-control"autocomplete="off" id="EMAIL" name="EMAIL" value="<?php echo $EMAIL; ?>" data-parsley-required>
                    </div>                           
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NOMOR">Document Number</label>
                        <input type="text" class="form-control" autocomplete="off" id="NOMOR" name="NOMOR" value="<?php echo $NOMOR; ?>">
                    </div>                           
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="JOIN_NAMA">Document Name</label>
                        <input type="text" class="form-control" autocomplete="off" id="JOIN_NAMA" name="JOIN_NAMA" value="<?php echo $JOIN_NAMA; ?>">
                    </div>                           
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="AUTH">Authority <span class="text-danger">*</span></label>
                        <select name="AUTH" id="AUTH" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Authority</option>
                            <?php
                            if($_SESSION["LOGINAUTH_SPEC_BB"] != "Administrator")
                            {
                                $result = $db1->prepare("select * from param where AUTH != 'Administrator'"); 
                            }
                            else
                            {
                                $result = $db1->prepare("select * from param where AUTH != ''");
                            }
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $row["AUTH"]; ?>" <?php if($AUTH == $row["AUTH"]) { echo "selected"; } ?>><?php echo $row["AUTH"]; ?></option>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="STATUS">Status <span class="text-danger">*</span></label>
                            <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                                <option value="">Choose Status</option>
                                <?php
                                $result = $db1->prepare("select MODE_AUDIT from param where MODE_AUDIT != ''"); 
                                $result->execute();
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <option value="<?php echo $row["MODE_AUDIT"]; ?>"<?php if($STATUS == $row["MODE_AUDIT"]) { echo "selected"; } ?>><?php echo $row["MODE_AUDIT"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>                           
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="AKSES_DOC">Akses Document <span class="text-danger">*</span></label>
                        <select name="AKSES_DOC" id="AKSES_DOC" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Akses Doc</option>
                            <?php
                            
                            $result = $db1->prepare("select * from param where AKSES_DOC != ''");
                            
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $row["AKSES_DOC"]; ?>" <?php if($AKSES_DOC == $row["AKSES_DOC"]) { echo "selected"; } ?>> <?php echo $row["AKSES_DOC"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                           
                </div>
            </div>
            <br><br>
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