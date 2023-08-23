<?php
    $result = $db1->prepare("select KODE_USER,NOMOR,JOIN_NAMA,NAMA_USER,DEPARTEMEN from m_user"); 
	$result->execute();
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-copy fa-lg"></i> Master Doc. Number and User</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-copy fa-lg"></i> Doc. Number and User</li>
            </ol>
        </div>
        <!--/ Toolbar -->
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
                        <th>Document Number</th>
                        <th>Document Name</th>
                        <th>User</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td align="center"><a href="tambah_nomor.php?KODE_USER=<?php echo $row["KODE_USER"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;&nbsp;<a href="hapus_nomor.php?KODE_USER=<?php echo $row["KODE_USER"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                            <td align="center"><?php echo $row["NOMOR"]; ?></span></td>
                            <td align="center"><?php echo $row["JOIN_NAMA"]; ?></span></td>
                            <td align="center"><?php echo $row["NAMA_USER"]; ?></td>
                            <td align="center"><?php echo $row["DEPARTEMEN"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Doc. Number"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Doc. Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Department"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>