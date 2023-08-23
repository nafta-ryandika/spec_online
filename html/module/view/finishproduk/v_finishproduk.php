<?php
$NOMOR           = $_SESSION["LOGINNOM_SPEC_BB"];
$KODE_USER       = $_SESSION["LOGINIDUS_SPEC_BB"];
$KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"] ;

$resultau = $db1->prepare("select MODE_AUDIT from p_audit"); 
$resultau->execute();
while ($rowau = $resultau->fetch(PDO::FETCH_ASSOC)) 
{
    $MODE_AUDIT = $rowau["MODE_AUDIT"];
    $where      = "";
    $group      = "group by e.KODE_SPEC";

    if ($rowau["MODE_AUDIT"] == "Aktif")
    {
        $where = "e.JENIS_SPEC = 'Eksternal' and";
        $group = "";
    }

    $result = $db1->prepare(
                "select e.*,
                        DATE_FORMAT(s.TANGGAL_HISTORY, '%d %M %Y') as TANGGAL,
                        DATE_FORMAT(s.TANGGAL_HISTORY, '%H:%i:%s') as JAM,
                        DATE_FORMAT(e.TANGGAL_IM, '%d %M %Y') as TANGGALIM,
                        DATE_FORMAT(e.TANGGAL_IM, '%H:%i:%s') as JAMIM,
                        p.NAMA_PERUSAHAAN,
                        b.NAMA_BUYER,
                        t.NAMA_PRODUK,
                        d.NAMA_BRAND,
                        i.NAMA_PACKING,
                        u.NAMA_ENDUSER,
                        c.NAMA_COUNTRY,
                        m.NAMA_MERK,
                        n.NAMA_USER,
                        (SELECT GROUP_CONCAT(pr_attachment) FROM t_packaging_requirement WHERE pr_spec_id = e.SPEC_CODE) AS pr_attachment 
                   from t_spec e
                        join m_perusahaan p ON e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN
                        join m_buyer b ON e.KODE_BUYER           = b.KODE_BUYER        
                        join m_produk t ON e.KODE_PRODUK         = t.KODE_PRODUK
                        join m_brand d ON e.KODE_BRAND           = d.KODE_BRAND
                        join m_packing i ON e.KODE_PACKING       = i.KODE_PACKING 
                        join m_enduser u ON e.KODE_ENDUSER       = u.KODE_ENDUSER
                        join m_country c ON e.KODE_COUNTRY       = c.KODE_COUNTRY
                        join m_merk m ON e.KODE_MERK             = m.KODE_MERK
                        join d_spec s ON e.KODE_SPEC             = s.KODE_SPEC
                        join m_typeakses a ON e.KODE_MERK        = a.KODE_MERK
                        left join m_user n ON e.USER_INPUT       = n.KODE_USER
                  where a.KODE_USER         = '$KODE_USER' and
                        $where
                        e.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN' and
                        s.STATUS = '0'
                        $group        
                order by s.TANGGAL_HISTORY DESC"); 
        $result->execute();
};
?>
<script type="text/javascript">
    function getDATA(val) 
    {
      $.ajax({
      type: "POST",
      url: "cek_data.php",
      data:'KODE_SPEC='+val,
      success: function(data){
        $("#DATA").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-free-code-camp fa-lg"></i> Finish Product Spec</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-free-code-camp fa-lg"></i> Finish Product Spec</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3">
                <a href="tambah_finishproduk.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Finish Product Spec</a>
            </div>                       
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Finish Product Spec List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <!-- <th style="white-space:nowrap">Internal Memo Date</th> -->
                        <th style="white-space:nowrap">Doc. Number</th>
                        <th style="white-space:nowrap">Doc. Spec Date</th>
                        <th style="white-space:nowrap">Item Code</th>
                        <th style="white-space:nowrap">Product Name</th>
                        <th style="white-space:nowrap">Packing Style</th>
                        <th style="white-space:nowrap">Doc. Spec Full</th>
                        <th style="white-space:nowrap">Doc. Spec Product</th>
                        <th style="white-space:nowrap">Doc. Spec Packaging</th>
                        <th style="white-space:nowrap">Internal Memo Spec</th>
                        <th style="white-space:nowrap">Packaging Requirement</th>
                        <th style="white-space:nowrap">Revised&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="white-space:nowrap">Buyer</th>
                        <th style="white-space:nowrap">Brand</th>
                        <th style="white-space:nowrap">Product Type</th>
                        <th style="white-space:nowrap">End User</th>
                        <th style="white-space:nowrap">Country of Origin</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Created By</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Doc. Number"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Doc. Spec Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Item Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Packing Style"></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revised"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Buyer"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Brand"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product Type"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="End User"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Country Of Origin"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Created By"></th>
                       
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $SPEC_CODE = $row["SPEC_CODE"];
                        $result2   = $db1->prepare("select COUNT(SPEC_CODE) as COUNT,SPEC_CODE,TANGGAL from m_general where SPEC_CODE like '%$SPEC_CODE%'");
                        $result2->execute();

                        $result3   = $db1->prepare("select COUNT(SPEC_CODE) as COUNT,
                                                           SPEC_CODE,
                                                           DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGALIM,
                                                           DATE_FORMAT(TANGGAL, '%H:%i:%s') as JAMIM 
                                                      from m_general 
                                                      where SPEC_CODE like '%$SPEC_CODE%'");
                        $result3->execute();
                        ?>
                        <tr>
                            <!-- OPSI -->
                            <td align="center">
                                <a href="tambah_finishproduk.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&KODE_BUYER=<?php echo $row["KODE_BUYER"]; ?>&KODE_PRODUK=<?php echo $row["KODE_PRODUK"]; ?>" class="btn btn-rounded btn-teal mb5"><i class="fa fa-edit fa-lg"></i></a>

                                <a href="hapus_finishproduk.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&KODE_BUYER=<?php echo $row["KODE_BUYER"]; ?>&KODE_PRODUK=<?php echo $row["KODE_PRODUK"]; ?>" class="btn btn-rounded btn-danger mb5" onclick="return confirm('Hapus request ini ?')"><i class="fa fa-trash fa-lg"></i></a>
                            </td>

                            <!-- IM DATE -->
                            <!-- <?php
                            while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row["TANGGALIM"]; ?> </td>
                                <?php
                            }
                            ?> -->

                            <!-- DOC NUMBER -->
                            <?php
                            if ($MODE_AUDIT == "Aktif") 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row["SPEC_CODE"]; ?></td>
                                <?php
                            } 
                            else 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row["SPEC_CODE"] . "<br>" . $row["JENIS_SPEC"]; ?></td>
                                <?php
                            }
                            ?>

                            <!-- DOC SPEC DATE -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["TANGGAL"]; ?> <br> <?php echo $row["JAM"]; ?></td>

                            <!-- ITEM CODE -->
                            <td align="center"><?php echo $row["ITEM_CODE"]; ?></td>

                            <!-- PRDODUCT NAME -->
                            <td align="left" style="white-space:nowrap"><?php echo $row["NAMA_PRODUK"]; ?></td>
                            
                            <!-- PACKING STYLE -->
                            <td align="left" style="white-space:nowrap"><?php echo $row["NAMA_PACKING"]; ?></td>

                            <!-- DOC SPEC -->
                            <!-- FULL -->
                            <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>

                            <!-- PRODUCT -->
                            <?php if(isset($row["FILEPROD"]))
                            {?>
                                <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILEPROD"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Product</a></td>
                            <?php
                            }
                            else
                            {?>
                                <td align="center" style="white-space:nowrap">Belum ada file</td>
                            <?php
                            }
                            ?>

                            <!-- PACKAGING -->
                            <?php if(isset($row["FILEPROD"]))
                            {?>
                                <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILEPACK"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Packaging</a></td>
                            <?php
                            }
                            else
                            {?>
                                <td align="center" style="white-space:nowrap">Belum ada file</td>
                            <?php
                            }
                            ?>

                            <!-- INTERNAL MEMO SPEC -->
                            <?php
                            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) 
                            {
                                if ($row2["COUNT"] != 0) 
                                {
                                    ?>
                                    <td align="center" style="white-space:nowrap"><a href="view_imgeneral.php?SPEC_CODE=<?php echo $row["SPEC_CODE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Internal Memo</a></td>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <td align="center" style="white-space:nowrap"> - </td>
                                    <?php
                                }
                            }
                            ?>


                            <!-- PACKAGING REQUIREMENT -->
                            <?php
                                if (trim($row["pr_attachment"]) != ""){
                                    $datax = explode(",", $row["pr_attachment"]);

                                    $sqlX = "SELECT * FROM m_email WHERE e_user_id ='".$_SESSION["LOGINIDUS_SPEC_BB"]."'";
                                    $resX = $db1->prepare($sqlX);
                                    $resX->execute();
                                    $rowX = $resX->rowCount(); 

                                    if (count($datax) > 0) {
                                        echo '<td align="center" style="white-space:nowrap">';
                                            foreach ($datax as $pr_attachment) {
                                                // if ($rowX > 0) {
                                                //     echo '<a href="'.$pr_attachment.'" target="_blank"><i class="fa fa-file-pdf-o"></i> Packaging Requirement</a><br/>';
                                                // }
                                                // else {
                                                    echo '<a href="print_packagingRequirement.php?pr_attachment='.$pr_attachment.'" target="_blank" ><i class="fa fa-file-pdf-o"></i> Packaging Requirement</a>';
                                                // }
                                            }
                                        echo '</td>';
                                    }
                                    else {
                                        echo '<td align="center" style="white-space:nowrap"> - </td>';
                                    }
                                }
                                else {
                                    echo '<td align="center" style="white-space:nowrap"> - </td>';
                                }
                            ?>

                            <!-- REVISED -->
                            <td > <?php echo $row["KETERANGAN"]; ?></td>

                            <!-- BUYER -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_BUYER"]; ?></td>

                            <!-- BRAND -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_BRAND"]; ?></td>

                            <!-- PRODUCT TYPE -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_MERK"]; ?></td>

                            <!-- END USER -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_ENDUSER"]; ?></td>

                            <!-- COUNTRY OF ORIGIN -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_COUNTRY"]; ?></td>

                            <!-- COMPANY -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_PERUSAHAAN"]; ?></td>

                            <!-- CREATED BY -->
                            <td align="center" style="white-space:nowrap"><?php echo $row["USER_INPUT"]."<br>".$row["NAMA_USER"]; ?></td>

                            
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>