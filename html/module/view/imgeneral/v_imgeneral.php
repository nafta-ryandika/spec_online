<?php
$KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"];
$KODE_USER       = $_SESSION["LOGINIDUS_SPEC_BB"];
$resultAudit     = GetQuery("select MODE_AUDIT from p_audit");
while ($rowAudit = $resultAudit->fetch(PDO::FETCH_ASSOC)) 
{
    extract($rowAudit);
}

    if ($MODE_AUDIT == "Aktif") 
    {
        $result = $db1->prepare(
            "select g.*,
                    DATE_FORMAT(g.TANGGAL, '%d %M %Y') as TANGGAL,
                    DATE_FORMAT(g.TANGGAL, '%H:%i:%s') as JAM,
                    p.NAMA_PERUSAHAAN,
                    m.NAMA_MERK,
                    n.NAMA_USER 
               from m_general g, 
                    m_perusahaan p, 
                    m_merk m,
                    m_typeakses t,
                    m_user n
              where g.KODE_PERUSAHAAN   = p.KODE_PERUSAHAAN and 
                    g.KODE_MERK         = m.KODE_MERK and
                    g.INPUTOR           = n.KODE_USER and 
                    g.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN' and 
                    g.JENIS             = 'Eksternal' and 
                    g.KODE_MERK         = t.KODE_MERK and 
                    t.KODE_USER         = '$KODE_USER'
           GROUP BY g.GENERAL_CODE        
           order by g.TANGGAL desc");
    } 
    else 
    {
        $result = $db1->prepare(
            "select g.*,
                    DATE_FORMAT(g.TANGGAL, '%d %M %Y') as TANGGAL,
                    DATE_FORMAT(g.TANGGAL, '%H:%i:%s') as JAM,
                    p.NAMA_PERUSAHAAN,
                    m.NAMA_MERK,
                    n.NAMA_USER 
               from m_general g, 
                    m_perusahaan p, 
                    m_merk m,
                    m_typeakses t,
                    m_user n
              where g.KODE_PERUSAHAAN   = p.KODE_PERUSAHAAN and 
                    g.KODE_MERK         = m.KODE_MERK and
                    g.INPUTOR           = n.KODE_USER and 
                    g.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN' and
                    g.KODE_MERK         = t.KODE_MERK and 
                    t.KODE_USER         = '$KODE_USER'
           GROUP BY g.GENERAL_CODE
           order by g.TANGGAL desc");
    }

$result->execute();

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
                <li class="active"><i class="fa fa-file fa-lg"></i> Internal Memo General</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<?php
if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
{
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    <a href="tambah_imgeneral.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Internal Memo General</a>
                </div>                
            </div>
            <br/>
        </div>
    </div>
    <?php
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Internal Memo General</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Opsi</th>
                        <th style="white-space:nowrap">Int. Memo Code</th>
                        <th style="white-space:nowrap">Attachment</th>
                        <th style="white-space:nowrap">Subject &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="white-space:nowrap">Date</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Product Type</th>
                        <th style="white-space:nowrap">Revised Number</th>
                        <th style="white-space:nowrap">Revised &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="white-space:nowrap">Doc. Spec Code</th>
                        <th style="white-space:nowrap">Created By</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Code"></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Subject"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revisi"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Note"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created By"></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        ?>
                        <tr>
                            <?php
                            if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                            {
                                ?>
                                <td align="center"><a href="tambah_imgeneral.php?KODE_GENERAL=<?php echo $row["KODE_GENERAL"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a><br><a href="hapus_imgeneral.php?KODE_GENERAL=<?php echo $row["KODE_GENERAL"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus request ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td></td>
                                <?php
                            }
                            ?>
                            <?php
                            if ($MODE_AUDIT == "Aktif") 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row["GENERAL_CODE"]; ?></td>
                                <?php
                            } 
                            else 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row["GENERAL_CODE"] . "<br>" . $row["JENIS"]; ?></td>
                                <?php
                            }

                        //BISA PRINT
                            if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo_</a></td>
                                <?php
                            }
                        //VIEW ONLY
                            else
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><a href="print_imgeneral.php?KODE_GENERAL=<?php echo $row["KODE_GENERAL"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td>
                                <?php
                            }
                                ?>
                            <td ><?php echo $row["PERIHAL"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["TANGGAL"]; ?> <br> <?php echo $row["JAM"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_PERUSAHAAN"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_MERK"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["REVISI"]; ?></td>
                            <td><?php echo $row["NOTE"]; ?></td>
                            <td align="center"><?php echo $row["SPEC_CODE"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["INPUTOR"]."<br>".$row["NAMA_USER"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>