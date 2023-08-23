<?php
    $result = $db1->prepare("select b.*,p.NAMA_PERUSAHAAN from m_buyer b, m_perusahaan p where b.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN"); 
	$result->execute();
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-user-o fa-lg"></i> Master Buyer</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-user-o fa-lg"></i> Buyer</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_buyer.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Buyer</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Buyer List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Buyer Code</th>
                        <th>Company</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td align="center"><a href="tambah_buyer.php?KODE_BUYER=<?php echo $row["KODE_BUYER"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;&nbsp;<a href="hapus_buyer.php?KODE_BUYER=<?php echo $row["KODE_BUYER"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                            <td align="center"><?php echo $row["KODE_BUYER"]; ?></span></td>
                            <td align="center"><?php echo $row["NAMA_PERUSAHAAN"]; ?></span></td>
                            <td align="center"><?php echo $row["NAMA_BUYER"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>