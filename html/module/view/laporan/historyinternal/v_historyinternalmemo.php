<?php
$KODE_USER       = $_SESSION["LOGINIDUS_SPEC_BB"];
$KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"];

$result = GetQuery(
                    "select *,
                            DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL,
                            DATE_FORMAT(TANGGAL, '%H:%i:%s') as JAM,
                            p.NAMA_PERUSAHAAN,
                            m.NAMA_MERK,
                            a.KODE_MERK 
                       from m_general g, 
                            m_perusahaan p, 
                            m_merk m,
                            m_typeakses a 
                      where g.KODE_PERUSAHAAN   = p.KODE_PERUSAHAAN and 
                            g.KODE_MERK         = m.KODE_MERK and
                            g.KODE_MERK         = a.KODE_MERK and
                            a.KODE_USER         = '$KODE_USER' and
                            g.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN'
                   order by g.TANGGAL desc");

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file fa-lg"></i> History Internal Memo</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> History Internal Memo</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">History Internal Memo</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Attachment</th>
                        <th>Int. Memo Code</th>
                        <th>Company</th>
                        <th>Product Type</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Revised</th>
                        <th>Revised Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td align="center"><a href="l_detilinternalmemo.php?KODE_GENERAL=<?php echo $row["KODE_GENERAL"]; ?>" class="btn btn-rounded btn-inverse mb5"><i class="fa fa-list fa-lg"></i></a></td>
                            <td align="center"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td>
                            <td align="center"><?php echo $row["GENERAL_CODE"]; ?></td>
                            <td align="center"><?php echo $row["NAMA_PERUSAHAAN"]; ?></td>
                            <td align="center"><?php echo $row["NAMA_MERK"]; ?></td>
                            <td><?php echo $row["PERIHAL"]; ?></td>
                            <td align="center"><?php echo $row["TANGGAL"]; ?> <br> <?php echo $row["JAM"]; ?></td>
                            <td><?php echo $row["NOTE"]; ?></td>
                            <td align="center"><?php echo $row["REVISI"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Subject"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Note"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revisi"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>