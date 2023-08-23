<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file fa-lg"></i> Finish Product Spec</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> Finish Product Spec</li>
            </ol>
        </div>
    </div>
</div>
<?php
    include "table/tableadmin.php";
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Finish Product Spec List </h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <?php 
                        if($_SESSION["LOGINAKSDOC_SPEC_BB"] == "FULL")
                        {?>
                            <th style="white-space:nowrap">Doc. Spec Full</th>
                        <?php
                        }
                        elseif($_SESSION["LOGINAKSDOC_SPEC_BB"] == "PRODUCT")
                        {?>
                            <th style="white-space:nowrap">Doc. Spec Full</th>
                            <th style="white-space:nowrap">Doc. Spec Product</th>    
                        <?php
                        }
                        elseif($_SESSION["LOGINAKSDOC_SPEC_BB"] == "PACKAGING")
                        {?>
                            <th style="white-space:nowrap">Doc. Spec Full</th>
                            <th style="white-space:nowrap">Doc. Spec Packaging</th>
                        <?php
                        }
                        ?> 
                        <th style="white-space:nowrap">Internal Memo Spec</th>
                        <?php
                            $sqlX = "SELECT * FROM m_email WHERE e_user_id ='".$_SESSION["LOGINIDUS_SPEC_BB"]."'";
                            $resX = $db1->prepare($sqlX);
                            $resX->execute();
                            $rowX = $resX->rowCount();
                        ?>
                        <th style="white-space:nowrap">Packaging Requirement</th>
                        <th style="white-space:nowrap">Doc. Number</th>
                        <th style="white-space:nowrap">Item Code</th>
                        <?php
                        if ($MODE_AUDIT == "Tidak Aktif") 
                        {
                            ?>
                            <th style="white-space:nowrap">Doc. Type</th>
                            <?php
                        }
                        ?>
                        <th style="white-space:nowrap">Spec Date</th>
                        <th style="white-space:nowrap">IM Date</th>
                        <th style="white-space:nowrap">Revised</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Buyer</th>
                        <th style="white-space:nowrap">Product Type</th>
                        <th style="white-space:nowrap">Product Name</th>
                        <th style="white-space:nowrap">Brand</th>
                        <th style="white-space:nowrap">Packing Style</th>
                        <th style="white-space:nowrap">End User</th>
                        <th style="white-space:nowrap">Country of Origin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $SPEC_CODE  = $row["SPEC_CODE"];
                        $result2    = $db1->prepare( "select COUNT(SPEC_CODE) as COUNT,
                                                             SPEC_CODE,
                                                             TANGGAL 
                                                        from m_general 
                                                       where SPEC_CODE like '%$SPEC_CODE%'");
                        $result2->execute();

                        $result3 = $db1->prepare("select COUNT(SPEC_CODE) as COUNT,
                                                         SPEC_CODE,
                                                         DATE_FORMAT(TANGGAL, '%d %M %Y') as TANGGAL 
                                                    from m_general 
                                                   where SPEC_CODE like '%$SPEC_CODE%'");
                        $result3->execute();
                        ?>
                        <tr>
                            <!-- JIKA AKSES DOCUMENT == FULL ----------------------------------------------------->
                            <?php 
                            if($_SESSION["LOGINAKSDOC_SPEC_BB"] == "FULL")
                            { 
                                // JIKA AKSES USER == VIEW
                                if($_SESSION["LOGINAKS_SPEC_BB"] == "View")
                                {
                                ?>
                                    <td align="center" style="white-space:nowrap"><a href="print_finishproduct.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&AKS=FULL" target="_blank" ><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>
                                <?php 
                                }
                                //JIKA AKSES USER != VIEW
                                else
                                { 
                                ?>
                                    <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>
                                <?php
                                }
                            }

                            // JIKA AKSES DOCUMENT == PRODUCT ------------------------------------------------------>
                            elseif($_SESSION["LOGINAKSDOC_SPEC_BB"] == "PRODUCT")
                            { 
                                //JIKA TANGGAL DOCUMENT SEBELUM 19 JULI 2021
                                if($row["TANGGAL"] < '2021-07-19') 
                                {
                                    // JIKA AKSES USER == VIEW
                                    if($_SESSION["LOGINAKS_SPEC_BB"] == "View")
                                    {
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="print_finishproduct.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&AKS=FULL" target="_blank" ><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>
                                    <?php 
                                    }
                                    // JIKA AKSES USER != VIEW
                                    else
                                    { 
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>
                                    <?php
                                    }
                                }
                                //JIKA TANGGAL DOCUMENT SETELAH 19 JULI 2021
                                else
                                    { ?>
                                    <td align="center" style="white-space:nowrap"> - </a></td>
                                <?php
                                } 

                                //JIKA FILE DOCUMENT PRODUCT ADA
                                if(isset($row["FILEPROD"]))
                                { 
                                    // JIKA AKSES USER == VIEW
                                    if($_SESSION["LOGINAKS_SPEC_BB"] == "View")
                                    {
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="print_finishproduct.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&AKS=PRODUCT" target="_blank" ><i class="fa fa-file-pdf-o"></i> Doc. Product</a></td>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILEPROD"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Product</a></td>>
                                    <?php
                                    }
                                }
                                //JIKA FILE DOCUMENT PRODUCT TIDAK ADA
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap"> - </a></td>
                                <?php
                                } 
                            }

                            // JIKA AKSES DOCUMENT == PACKAGING ---------------------------------------------------->
                            elseif($_SESSION["LOGINAKSDOC_SPEC_BB"] == "PACKAGING")
                            { 
                                //JIKA TANGGAL DOCUMENT SEBELUM 19 JULI 2021
                                if($row["TANGGAL"] < '2021-07-19') 
                                {
                                    // JIKA AKSES USER == VIEW
                                    if($_SESSION["LOGINAKS_SPEC_BB"] == "View")
                                    {
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="print_finishproduct.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&AKS=FULL" target="_blank" ><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>
                                    <?php 
                                    }
                                    // JIKA AKSES USER != VIEW
                                    else
                                    { 
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>
                                <?php
                                    }
                                }
                                //JIKA TANGGAL DOCUMENT SETELAH 19 JULI 2021
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap"> - </a></td>
                                <?php
                                }

                                //JIKA FILE DOCUMENT PACKING ADA
                                if(isset($row["FILEPACK"]))
                                { 
                                // JIKA AKSES USER == VIEW
                                    if($_SESSION["LOGINAKS_SPEC_BB"] == "View")
                                    {
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="print_finishproduct.php?KODE_SPEC=<?php echo $row["KODE_SPEC"]; ?>&AKS=PACKAGING" target="_blank" ><i class="fa fa-file-pdf-o"></i> Doc. Packaging a</a></td>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                        <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILEPACK"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Packaging</a></td>
                                    <?php
                                    }
                                }
                                //JIKA FILE DOCUMENT PACKING TIDAK ADA
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap"> - </a></td>
                                <?php
                                } 
                            }
                            
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

                                    // $sqlX = "SELECT * FROM m_email WHERE e_user_id ='".$_SESSION["LOGINIDUS_SPEC_BB"]."'";
                                    // $resX = $db1->prepare($sqlX);
                                    // $resX->execute();
                                    // $rowX = $resX->rowCount(); 

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
                            <td align="center" style="white-space:nowrap"><?php echo $row["SPEC_CODE"]; ?></td>
                            <td align="center"><?php echo $row["ITEM_CODE"]; ?></td>
                            <?php
                            if ($MODE_AUDIT == "Tidak Aktif") 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row["JENIS_SPEC"]; ?></td>
                                <?php
                            }
                            ?>
                            <td align="center" style="white-space:nowrap"><?php echo $row["TANGGALL"]; ?> <br> <?php echo $row["JAM"]; ?></td>
                            <?php
                            while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <td align="center" style="white-space:nowrap"><?php echo $row3["TANGGAL"]; ?></td>
                                <?php
                            }
                            ?>
                            <td><?php echo $row["KETERANGAN"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_PERUSAHAAN"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_BUYER"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_MERK"]; ?></td>
                            <td align="center"><?php echo $row["NAMA_PRODUK"]; ?></td>
                            <td align="center"><?php echo $row["NAMA_BRAND"]; ?></td>
                            <td align="center"><?php echo $row["NAMA_PACKING"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_ENDUSER"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["NAMA_COUNTRY"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Internal Memo Spec"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Doc Number"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Item Code"></th>
                        <?php
                        if ($MODE_AUDIT == "Tidak Aktif") 
                        {
                            ?>
                            <th><input type="search" class="form-control" name="search_engine" placeholder="Doc Type"></th>
                            <?php
                        }
                        ?>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Spec Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="IM Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revised"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Buyer"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Product Type"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Brand"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Packing Style"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="End User"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Country Of Origin"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>