<?php
$SPEC_CODE = $_GET["SPEC_CODE"];
$result    = $db1->prepare("select s.SPEC_CODE,
                                   p.NAMA_PERUSAHAAN 
                              from t_spec s, 
                                   m_perusahaan p 
                             where s.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and 
                                   s.SPEC_CODE = '$SPEC_CODE'"); 
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
    $SPEC_CODE       = $row["SPEC_CODE"];
    $NAMA_PERUSAHAAN = $row["NAMA_PERUSAHAAN"];
}
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file fa-lg"></i> Internal Memo General</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> View Internal Memo General</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3><?php echo $NAMA_PERUSAHAAN . " / " . $SPEC_CODE; ?></h3>
        <br>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">View Internal Memo General List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Internal Memo General</th>
                        <th>Int. Memo Code</th>
                        <th>Doc. Spec Code</th>
                        <th>Company</th>
                        <th>Product Type</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Revised</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result2 = $db1->prepare(
                                "select *,
                                        DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL,
                                        DATE_FORMAT(TANGGAL, '%H:%i:%s') as JAM,
                                        p.NAMA_PERUSAHAAN,
                                        m.NAMA_MERK 
                                   from m_general g, 
                                        m_perusahaan p, 
                                        m_merk m 
                                  where g.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and 
                                        g.KODE_MERK = m.KODE_MERK and 
                                        g.SPEC_CODE like '%$SPEC_CODE%'
                               order by g.TANGGAL desc");
                    $result2->execute();
                    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) 
                    {
                        ?>
                        <tr>
                        <?php
                            if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                            {
                                ?>
                                <td align="center">
                                    <a href="tambah_imgeneral.php?KODE_GENERAL=<?php echo $row2["KODE_GENERAL"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a><br>
                                    <a href="hapus_imgeneral.php?KODE_GENERAL=<?php echo $row2["KODE_GENERAL"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus request ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td></td>
                                <?php
                            }
                            // JIKA AKSES USER == VIEW
                            if($_SESSION["LOGINAKS_SPEC_BB"] == "View")
                            {
                            ?>
                                <td align="center" style="white-space:nowrap"><a href="print_imgeneral.php?KODE_GENERAL=<?php echo $row2["KODE_GENERAL"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td>
                            <?php 
                            }
                            // JIKA AKSES USER != VIEW
                            else
                            { 
                            ?>
                                <td align="center" style="white-space:nowrap"><a href="<?php echo $row2["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td>
                            <?php
                            }
                            ?>

                            
                            <td align="center"><?php echo $row2["GENERAL_CODE"]; ?></td>
                            <td align="center"><?php echo $row2["SPEC_CODE"]; ?></td>
                            <td align="center"><?php echo $row2["NAMA_PERUSAHAAN"]; ?></td>
                            <td align="center"><?php echo $row2["NAMA_MERK"]; ?></td>
                            <td><?php echo $row2["PERIHAL"]; ?></td>
                            <td align="center"><?php echo $row2["TANGGAL"]; ?></td>
                            <td align="center"><?php echo $row2["REVISI"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>