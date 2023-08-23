<?php
$KODE_SPEC = $_GET["KODE_SPEC"];

$result = $db1->prepare("select s.SPEC_CODE,
                                p.NAMA_PERUSAHAAN 
                           from t_spec s, 
                                m_perusahaan p 
                          where s.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and 
                                s.KODE_SPEC = '$KODE_SPEC'"); 
$result->execute();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
    $SPEC_CODE       = $row["SPEC_CODE"];
    $NAMA_PERUSAHAAN = $row["NAMA_PERUSAHAAN"];
}
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-free-code-camp fa-lg"></i> Finish Product Spec</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-free-code-camp fa-lg"></i> View Finish Product Spec</li>
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
                <h3 class="panel-title">View Finish Product Spec List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Doc. Number</th>
                        <th>Doc. Name</th>
                        <th>User Name</th>
                        <th>Department</th>
                        <th>Doc. Spec</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result2 = $db1->prepare("select s.*,u.JOIN_NAMA,u.NAMA_USER,u.DEPARTEMEN from d_spec s, m_user u where s.NOMOR = u.NOMOR and s.KODE_SPEC = '$KODE_SPEC' and s.STATUS = 0 order by s.NOMOR"); 
                    $result2->execute();
                    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) 
                    {
                        ?>
                        <tr>
                            <td align="center"><a href="hapus_detailfinishproduk.php?KODE_SPEC=<?php echo $row2["KODE_SPEC"]; ?>&NOMOR=<?php echo $row2["NOMOR"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus request ini ?')"><i class="fa fa-trash fa-lg"></i></a></td>
                            <td align="center"><?php echo $row2["NOMOR"]; ?></td>
                            <td align="center"><?php echo $row2["JOIN_NAMA"]; ?></td>
                            <td align="center"><?php echo $row2["NAMA_USER"]; ?></td>
                            <td align="center"><?php echo $row2["DEPARTEMEN"]; ?></td>
                            <td align="center"><a href="<?php echo $row2["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg"></i> Document</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>