<?php
$KODE_GENERAL = $_GET["KODE_GENERAL"];
$result       = GetQuery(
                "select i.*,
                        p.NAMA_PERUSAHAAN,
                        m.NAMA_MERK,
                        DATE_FORMAT(i.TANGGAL, '%d %M %Y') as TANGGAL,
                        DATE_FORMAT(i.TANGGAL, '%H:%i:%s') as JAM 
                   from d_internalmemo i, 
                        m_perusahaan p, 
                        m_merk m 
                  where i.KODE_PERUSAHAAN   = p.KODE_PERUSAHAAN and 
                        i.KODE_MERK         = m.KODE_MERK and 
                        i.KODE_GENERAL      = '$KODE_GENERAL' and 
                        i.STS_AKTIF         = 0
               order by i.TGL_UP desc");

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
                <li><a href="l_historyinternalmemo.php"><i class="fa fa-file fa-lg"></i> History Internal Memo</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> Detail History Internal Memo</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail History Internal Memo</h3>
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
                            <td align="center"><a href="hapus_detilinternalmemo.php?KODE_GENERAL=<?php echo $row["KODE_GENERAL"]; ?>&INTERNAL_MEMO=<?php echo $row["GENERAL_CODE"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>

                            <?php
                            //BISA PRINT
                            if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                            {
                                ?>
                                <td align="center"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo_</a></td>
                                <?php
                            }
                            //VIEW ONLY
                            else
                            {
                                ?>
                                <td align="center"><a href="print_imgeneral.php?KODE_GENERAL=<?php echo $row["KODE_GENERAL"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td>
                                <?php
                            }
                                ?>
                            <!-- <td align="center"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td> -->

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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revised"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revised Number"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>