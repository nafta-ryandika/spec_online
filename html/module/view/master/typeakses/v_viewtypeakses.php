<?php
$KODE_MERK = $_GET["KODE_MERK"];
$result    = $db1->prepare(
                     "select a.*,
                             b.NAMA_MERK,
                             d.NAMA_PERUSAHAAN 
                        from m_user a,
                             m_merk b,  
                             m_typeakses c,
                             m_perusahaan d
                       where b.KODE_MERK        = c.KODE_MERK and 
                             a.KODE_USER        = c.KODE_USER and
                             a.KODE_PERUSAHAAN  = c.KODE_PERUSAHAAN and
                             a.KODE_PERUSAHAAN  = d.KODE_PERUSAHAAN and
                             b.KODE_MERK        = '$KODE_MERK'"); 
$result->execute();

$res = $db1->prepare("select NAMA_MERK from m_merk where KODE_MERK='$KODE_MERK'");
$res->execute();
while ($roww = $res->fetch(PDO::FETCH_ASSOC)) 
{
    $NAMA_MERK = $roww["NAMA_MERK"];
}
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
                <li><a href="m_user.php"><i class="ico-group"></i> Master User</a></li>
                <li class="active"><i class="ico-tags"></i> View Akses</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo $NAMA_MERK; ?></h2>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Nama User</th>
                        <th>Departement</th>
                        <th>Perusahaan</th>
                        <th>Authority</th>
                        <th>Akses User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        ?>
                        <tr>
                            <td align=""><?php echo $row["KODE_USER"]; ?></td>
                            <td align=""><?php echo $row["NAMA_USER"]; ?></td>
                            <td align=""><?php echo $row["DEPARTEMEN"]; ?></td>
                            <td align=""><?php echo $row["NAMA_PERUSAHAAN"]; ?></td>
                            <td align=""><?php echo $row["AKSES"]; ?></td>
                            <td align=""><?php echo $row["NAMA_MERK"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="ID"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Nama"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Departemen"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Perusahaan"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Authority"></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" align="center">
        <a href="m_typeakses.php" type="button" class="btn btn-primary"><i class="ico-ok"></i> Selesai</a>
    </div>                    
</div>
<br><br>
   