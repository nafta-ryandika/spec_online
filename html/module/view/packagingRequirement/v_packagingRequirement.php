<?php
$KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"];
$KODE_USER       = $_SESSION["LOGINIDUS_SPEC_BB"];

$sql = "SELECT 
        dt1.*,
        dt2.*,
        IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_company, (SELECT NAMA_PERUSAHAAN FROM m_perusahaan WHERE KODE_PERUSAHAAN = dt2.KODE_PERUSAHAAN)) AS company_name,
        IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_product_name, (SELECT NAMA_PRODUK FROM m_produk WHERE KODE_PRODUK = dt2.KODE_PRODUK AND KODE_PERUSAHAAN = dt2.KODE_PERUSAHAAN)) AS product_name,
        IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_product_type, (SELECT NAMA_MERK FROM m_merk WHERE KODE_MERK = dt2.KODE_MERK)) AS type_name,
        IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_packing_style, (SELECT NAMA_PACKING FROM m_packing WHERE KODE_PACKING = dt2.KODE_PACKING)) AS packing_name,
        IF(dt1.pr_code = dt1.pr_spec_id, dt3.sm_spec_id, dt1.pr_spec_id) AS pr_spec_id,
        IF(dt1.pr_revised_no = 0, '', dt1.pr_revised_no) as pr_revised_no,
        IF(dt1.pr_code = dt1.pr_spec_id, 'MANUAL', '') AS spec_mode,
        DATE_FORMAT(dt1.pr_date, '%d-%m-%Y') AS pr_date,
        IF(dt1.pr_revised_date = '0000-00-00', '', DATE_FORMAT(dt1.pr_revised_date, '%d-%m-%Y')) AS pr_revised_date,
        (SELECT CONCAT(dt1.pr_user, '-', NAMA_USER) FROM m_user WHERE KODE_USER = dt1.pr_user) AS created_by
        FROM 
        (
            SELECT 
                pr_id, pr_code, pr_spec_id, pr_date, pr_attachment, pr_revised_no, 
                pr_revised, pr_revised_date, pr_user, pr_user_date, pr_user_address
            FROM t_packaging_requirement
        )dt1
        LEFT JOIN 
        (
            SELECT 
                KODE_SPEC, SPEC_CODE, GENERAL_CODE, ITEM_CODE, KODE_PERUSAHAAN, KODE_BUYER, 
                KODE_PRODUK, KODE_MERK, KODE_BRAND, KODE_PACKING, KODE_ENDUSER, KODE_COUNTRY, 
                TANGGAL, TANGGAL_IM, JENIS_SPEC, FILEPROD, FILEPACK, `FILE`, INTERNAL_MEMO, 
                KETERANGAN, STS_AKTF, USER_INPUT, IP_ADDRESS
            FROM t_spec
        )dt2
        ON dt1.pr_spec_id = dt2.SPEC_CODE 
        LEFT JOIN 
        (
            SELECT 
                sm_id, sm_pr_code, sm_spec_id, sm_product_name, sm_packing_style, sm_company, 
                sm_product_type, sm_user, sm_user_date, sm_user_address
            FROM t_spec_manual
        )dt3 
        ON dt1.pr_code = dt3.sm_pr_code 
        ORDER BY dt1.pr_revised_date DESC, dt1.pr_date DESC, dt1.pr_user_date DESC";

$res = $db1->prepare($sql);
$res->execute();

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file fa-lg"></i> Packaging Requirement</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> Packaging Requirement</li>
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
                    <a href="tambah_packagingRequirement.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add </a>
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
                <h3 class="panel-title">Packaging Requirement</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Action</th>
                        <!-- <th style="">Packaging Requirement Code</th> -->
                        <th style="white-space:nowrap">Doc. Spec Code</th>
                        <th style="white-space:nowrap">Product Name</th>
                        <!-- <th style="white-space:nowrap">Date</th> -->
                        <th style="white-space:nowrap">Attachment</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Product Type</th>
                        <th style="white-space:nowrap">Packing Style</th>
                        <th style="white-space:nowrap">Revised Date</th>
                        <th>Revised Number</th>
                        <th style="white-space:nowrap">Revised</th>
                        <th style="white-space:nowrap">Created By</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <!-- <th><input type="search" class="form-control" name="search_engine" placeholder="Packaging requirement Code"></th> -->
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Doc. Spec Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product Name"></th>
                        <!-- <th><input type="search" class="form-control" name="search_engine" placeholder="Date"></th> -->
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product Type"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Packing style"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revisid Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revised Number"></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created By"></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    while ($data = $res->fetch(PDO::FETCH_ASSOC)) 
                    {
                        ?>
                        <tr>
                            <?php
                            if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                            {
                                ?>
                                    <td align="center" style="white-space:nowrap;">
                                        <a href="tambah_packagingRequirement.php?inPr_id=<?php echo $data["pr_id"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg" style="width: 15px;"></i></a>
                                        <a href="hapus_packagingRequirement.php?inPr_id=<?php echo $data["pr_id"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus Data ?')"><i class="fa fa-trash fa-lg" style="width: 15px;"></i></a>
                                    </td>
                                <?php
                            }
                            else {
                                echo ("<td></td>");
                            }
                            ?>

                            <!-- <td style="white-space:nowrap;"><?=$data["pr_code"]?></td> -->
                            <td style="white-space:nowrap;"><?=$data["pr_spec_id"]?></td>
                            <td><?=$data["product_name"]?></td>
                            <!-- <td style="white-space:nowrap; text-align: center;"><?=$data["pr_date"]?></td> -->
                            <td style="text-align: center;">
                                <?php
                                    if ($data["pr_attachment"] != "") {
                                        if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") {
                                        ?>
                                            <a href="<?=$data["pr_attachment"]?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                        <?php
                                        }
                                        else {
                                            echo '<a href="print_packagingRequirement.php?pr_attachment='.$data["pr_attachment"].'" target="_blank" ><i class="fa fa-file-pdf-o"></i></a>';
                                        }
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td><?=$data["company_name"]?></td>
                            <td style="white-space:nowrap; text-align: center;"><?=$data["type_name"]?></td>
                            <td><?=$data["packing_name"]?></td>
                            <td style="white-space:nowrap; text-align: center;"><?=$data["pr_revised_date"]?></td>
                            <td style="white-space:nowrap; text-align: center;"><?=sprintf("%02d", $data["pr_revised_no"])?></td>
                            <?php
                                $datax = explode("<br />",nl2br($data["pr_revised"]));
                                $numx = "";
                                $txt = "";

                                foreach ($datax as $rowx) {
                                    $numx = strlen($rowx);
                                    
                                    if($numx > 65){
                                        $txt .= wordwrap($rowx, 65, "<br />\n")."<br/>";
                                    }
                                    else {
                                        $txt .= $rowx."<br />";
                                    }
                                }
                            ?>
                            <td style="white-space:nowrap;"><?=$txt?></td>
                            <td style="text-align: center;"><?=$data["created_by"]?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>