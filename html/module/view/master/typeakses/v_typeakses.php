<?php
$KODPER = $_SESSION["LOGINPER_SPEC_BB"];

    $result = $db1->prepare("select * from m_merk order by KODE_MERK asc"); 
	$result->execute();

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-group"></i> Master Type Akses</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="ico-group"></i> User</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <?php 
                    if($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec")
                    {
                    ?>
                        <a href="tambah_typeakses.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Type Akses</a>
                    <?php
                    }
                    ?>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Type Akses List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Kode Type Akses </th>
                        <th>Nama Type Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        ?>
                        <tr>
                            <?php 
                            if($_SESSION["LOGINAUTH_SPEC_BB"] != "Administrator")
                            {
                            ?>
                                <td align="center">
                                    <a href="view_akses.php?KODE_MERK=<?php echo $row["KODE_MERK"]; ?>" class="btn btn-rounded btn-success mb5"><i class="fa fa-eye fa-lg"></i></a>
                                </td>
                            <?php
                            }
                            else
                            {
                            ?>
                                <td align="center">
                                    <a href="tambah_typeakses.php?KODE_MERK=<?php echo $row["KODE_MERK"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="hapus_typeakses.php?KODE_MERK=<?php echo $row["KODE_MERK"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash fa-lg"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="view_akses.php?KODE_MERK=<?php echo $row["KODE_MERK"]; ?>" class="btn btn-rounded btn-success mb5"><i class="fa fa-eye fa-lg"></i></a>
                                </td>
                            <?php
                            }
                            ?>
                            
                            <td align="center"><?php echo $row["KODE_MERK"]; ?></span></td>
                            <td align=""><?php echo $row["NAMA_MERK"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Kode Akses"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Nama Akses"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>