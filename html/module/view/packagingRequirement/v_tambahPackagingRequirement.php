<?php
include "module/controller/packagingRequirement/tt_packagingRequirement.php";
$KODPER = $_SESSION["LOGINPER_SPEC_BB"];
$curdate = date('Y-m-d');
$curdate = date("d-m-Y", strtotime($curdate));

$pr_codex = "~ AUTO ~";
$mode = "";

if (isset($_GET["inPr_id"])) {
    $pr_codex = $pr_code;
    $mode = "edit";
    $array = explode("/",$pr_attachment);
    $pr_attachmentx = $array[2];

}
else {
    $pr_id = "";
    $pr_code = "";
    $pr_spec_id = "";
    $company_name = "";
    $product_name = "";
    $type_name = "";
    $packing_name = "";
    $pr_revised_no = "";
    $pr_revised_date = "";
    $pr_revised = "";
    $pr_attachmentx = "";
}
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-plus2"></i> Add Packaging Requirement</li></h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="t_packagingRequirement.php"><i class="fa fa-file fa-lg"></i> Packaging Requirement</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Packaging Requirement</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" id="form" action="" method="post" enctype="multipart/form-data" data-parsley-validate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="packagingRequirementCode">Packaging Requirement Code <span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" id="inSpecMode" name="inSpecMode" readonly="" value="<?=$spec_mode?>">
                        <input type="hidden" class="form-control" id="inPr_id" name="inPr_id" readonly="" value="<?=$pr_id?>" style="text-align: center;">
                        <input type="text" class="form-control" id="inPr_code" name="inPr_code" readonly="" value="<?=$pr_codex?>" style="text-align: center;">
                        <div id="VALID"></div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <label for="docSpecCode" style="font-size: 15px;">Doc. Spec Code<span style="color: red"> *</span></label><br>
                        <input type="text" class="form-control" autocomplete="off" id="inPr_spec_id" name="inPr_spec_id" readonly="" value="<?=$pr_spec_id?>">
                        <span class="input-group-btn" style="vertical-align: bottom;">
                            <!-- Trigger button -->
                            <button type="button" class="btn btn-primary" id="btnModalDocSpecCode" data-toggle="modal" data-target="#modalDocSpecCode">
                            <i class="fa fa-search"></i>
                            </button>
                        </span>
                        <span class="input-group-btn" style="vertical-align: bottom; margin-left:5px;">
                            <!-- Trigger button -->
                            <button type="button" class="btn btn-success" id="btnModalManualDocSpecCode" data-toggle="modal" data-target="#modalManualDocSpecCode">
                            <i class="fa fa-plus"></i>
                            </button>
                        </span>
                        <div id="modalDocSpecCode" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ffae00;color:white">
                                        <center>
                                            <h3 class="modal-title">Choose Doc. Spec Code</h3>
                                        </center>
                                    </div>
                                        <div class="modal-body">
                                            <table width="100%" class="table table-hover" id="tableDocSpecCode">
                                                <thead>
                                                    <tr>
                                                        <th>Doc. Spec Code</th>
                                                        <th>Product Name</th>
                                                        <th>Packing Style</th>
                                                        <th>Company</th>
                                                        <th>Product Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $stmj = GetQuery("SELECT 
                                                                        dt.* ,
                                                                        (SELECT NAMA_PERUSAHAAN FROM m_perusahaan WHERE KODE_PERUSAHAAN = dt.KODE_PERUSAHAAN) AS company_name,
                                                                        (SELECT NAMA_PRODUK FROM m_produk WHERE KODE_PRODUK = dt.KODE_PRODUK AND KODE_PERUSAHAAN = dt.KODE_PERUSAHAAN) AS product_name,
                                                                        (SELECT NAMA_MERK FROM m_merk WHERE KODE_MERK = dt.KODE_MERK) AS type_name,
                                                                        (SELECT NAMA_PACKING FROM m_packing WHERE KODE_PACKING = dt.KODE_PACKING) AS packing_name
                                                                    FROM (
                                                                            SELECT 
                                                                            KODE_SPEC, SPEC_CODE, GENERAL_CODE, ITEM_CODE, KODE_PERUSAHAAN, KODE_BUYER, 
                                                                            KODE_PRODUK, KODE_MERK, KODE_BRAND, KODE_PACKING, KODE_ENDUSER, KODE_COUNTRY, 
                                                                            TANGGAL, TANGGAL_IM, JENIS_SPEC, FILEPROD, FILEPACK, `FILE`, INTERNAL_MEMO, 
                                                                            KETERANGAN, STS_AKTF, USER_INPUT, IP_ADDRESS
                                                                            FROM t_spec
                                                                        )dt
                                                                    ORDER BY dt.TANGGAL DESC");
                                                    while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                    ?>
                                                    <tr id="docSpecCode" 
                                                        data-spec_code="<?php echo $rowz["SPEC_CODE"]; ?>" 
                                                        data-product_name="<?php echo $rowz["product_name"]; ?>" 
                                                        data-packing_name="<?php echo $rowz["packing_name"]; ?>" 
                                                        data-company_name="<?php echo $rowz["company_name"]; ?>" 
                                                        data-type_name="<?php echo $rowz["type_name"]; ?>" 
                                                    >
                                                        <td><?php echo $rowz["SPEC_CODE"]; ?></td>
                                                        <td><?php echo $rowz["product_name"]; ?></td>
                                                        <td><?php echo $rowz["packing_name"]; ?></td>
                                                        <td><?php echo $rowz["company_name"]; ?></td>
                                                        <td><?php echo $rowz["type_name"]; ?></td>
                                                    </tr>
                                                    <?php 
                                                    } 

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div> 
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div id="modalManualDocSpecCode" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ffae00;color:white">
                                        <center>
                                            <h3 class="modal-title">Manual Doc. Spec Code</h3>
                                        </center>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="docSpecCode" style="font-size: 15px;">Doc. Spec Code<span style="color: red"> *</span></label><br>
                                                        <input type="text" class="form-control" autocomplete="off" id="inPrSpecIdManual" name="inPrSpecIdManual">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="REVISI">Product Name</label>
                                                        <input type="text" class="form-control" id="inProductNameManual" name="inProductNameManual">
                                                    </div>                           
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="REVISI">Packing Style</label>
                                                        <input type="text" class="form-control" id="inPackingStyleManual" name="inPackingStyleManual">
                                                    </div>                           
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="REVISI">Company</label>
                                                        <input type="text" class="form-control" id="inCompanyManual" name="inCompanyManual">
                                                    </div>                           
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="REVISI">Product Type</span></label>
                                                        <input type="text" class="form-control" id="inProductTypeManual" name="inProductTypeManual">
                                                    </div>                           
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="setManualSpec()">Add</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal -->
                    </div>                         
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="REVISI">Product Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inProductName" name="inProductName" readonly="" value="<?=$product_name?>">
                    </div>                           
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="REVISI">Packing Style<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inPackingStyle" name="inPackingStyle" readonly="" value="<?=$packing_name?>">
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="REVISI">Company<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inCompany" name="inCompany" readonly="" value="<?=$company_name?>">
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="REVISI">Product Type<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inProductType" name="inProductType" readonly="" value="<?=$type_name?>">
                    </div>                           
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-4" id="UPLOAD">
                    <div class="form-group">
                        <label for="FILE">Upload Doc. Packaging Requirement (.PDF)</label><br>
                        <input type="file" id="inPr_attachment" name="FILE[]" accept="application/pdf" style="margin-bottom: 5px;" />
                        <?php 
                        if ($mode == "edit"){ 
                        ?>
                        <a href="<?=$pr_attachment?>" target="_blank"><span style="color: green;"><i><?=$pr_attachmentx?></i></span></a><br/>
                        <?php
                        }
                        ?>
                        <span><i style="font-size: 10px;color: red;"><strong>NOTE : MAX SIZE 2MB</strong></i></span><br/>
                    </div>
                </div>
            </div>

            <?php
                // if ($mode == 'edit') {
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TANGGAL">Revised Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="inPr_revised_date" id="inPr_revised_date" value="<?=$pr_revised_date?>"/>
                    </div>                           
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="REVISI">Revised Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inPr_revised_no" name="inPr_revised_no" value="<?=$pr_revised_no?>">
                    </div>                           
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="NOTE">Revised <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="5" id="inPr_revised" name="inPr_revised"><?=$pr_revised?></textarea>
                    </div>                           
                </div>
            </div>
            <?php
                // }
            ?>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp;&nbsp;&nbsp;
                    <a href="t_packagingRequirement.php" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tableDocSpecCode').DataTable({
            "ordering": false,
            columnDefs: []
        });
    
        $(document).on('click', '#docSpecCode', function (e) {
            $('#inPr_spec_id').val($(this).attr('data-spec_code'));
            $('#inProductName').val($(this).attr('data-product_name'));
            $('#inPackingStyle').val($(this).attr('data-packing_name'));
            $('#inCompany').val($(this).attr('data-company_name'));
            $('#inProductType').val($(this).attr('data-type_name'));
            $('#inSpecMode').val('');

            $('#modalDocSpecCode').modal('hide');
        });
    });

    function setManualSpec() {
        var inPrSpecIdManual = $('#inPrSpecIdManual').val();
        var inProductNameManual = $('#inProductNameManual').val();
        var inPackingStyleManual = $('#inPackingStyleManual').val();
        var inCompanyManual = $('#inCompanyManual').val();
        var inProductTypeManual = $('#inProductTypeManual').val();

        $('#inPr_spec_id').val(inPrSpecIdManual);
        $('#inProductName').val(inProductNameManual);
        $('#inPackingStyle').val(inPackingStyleManual);
        $('#inCompany').val(inCompanyManual);
        $('#inProductType').val(inProductTypeManual);

        $("#modalManualDocSpecCode").on("hidden.bs.modal", function () {
            $('#inPrSpecIdManual').val('');
            $('#inProductNameManual').val('');
            $('#inPackingStyleManual').val('');
            $('#inCompanyManual').val('');
            $('#inProductTypeManual').val('');
            $('#inSpecMode').val('MANUAL');
        });
    }
</script>