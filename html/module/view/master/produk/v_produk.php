<?php
    $result = $db1->prepare("select r.*,p.NAMA_PERUSAHAAN from m_produk r, m_perusahaan p where r.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN"); 
	$result->execute();
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-briefcase fa-lg"></i> Master Product</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-briefcase fa-lg"></i> Product</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_produk.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Product</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Product List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Product Code</th>
                        <th>Company</th>
                        <th>Product Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td align="center"><a href="tambah_produk.php?KODE_PRODUK=<?php echo $row["KODE_PRODUK"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a><a href="hapus_produk.php?KODE_PRODUK=<?php echo $row["KODE_PRODUK"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                            <td align="center"><?php echo $row["KODE_PRODUK"]; ?></span></td>
                            <td align="left"><?php echo $row["NAMA_PERUSAHAAN"]; ?></span></td>
                            <td align="left"><?php echo $row["NAMA_PRODUK"]; ?></span></td>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>