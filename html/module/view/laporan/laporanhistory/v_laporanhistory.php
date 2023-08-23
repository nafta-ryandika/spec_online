<?php
    include "table/tableadmin.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file-pdf-o fa-lg"></i> History Document Spec</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file-pdf-o fa-lg"></i> History Document Spec</li>
            </ol>
        </div>
        <!--/ Toolbar -->
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
                        <th style="white-space:nowrap">Doc. Spec Full</th>
                        <th style="white-space:nowrap">Doc. Spec Product</th>    
                        <th style="white-space:nowrap">Doc. Spec Packaging</th>
                        <th style="white-space:nowrap">Date</th>
                        <th style="white-space:nowrap">Versi</th>
                        <th style="white-space:nowrap">Revised</th>
                        <th style="white-space:nowrap">Doc. Number</th>
                    <?php
                    if ($MODE_AUDIT == "Tidak Aktif") 
                    {
                    ?>
                        <th style="white-space:nowrap">Doc. Type</th>
                    <?php
                    }
                    ?>
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
                        ?>
                        <tr>
                            <!-- FULL -->
                            <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILE"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Full</a></td>

                            <!-- PRODUCT -->
                            <?php if(isset($rpw["FILEPROD"]))
                            {?>
                                <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILEPROD"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Product</a></td>
                            <?php
                            }
                            else
                            {?>
                                <td align="center" style="white-space:nowrap">-</td>
                            <?php
                            }
                            ?>

                            <!-- PACKAGING -->
                            <?php if(isset($rpw["FILEPROD"]))
                            {?>
                                <td align="center" style="white-space:nowrap"><a href="<?php echo $row["FILEPACK"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Doc. Packaging</a></td>
                            <?php
                            }
                            else
                            {?>
                                <td align="center" style="white-space:nowrap">-</td>
                            <?php
                            }
                            ?>

                            <td align="center" style="white-space:nowrap"><?php echo $row["TANGGAL"]."<br>".$row["JAM"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["VERSI"]; ?></td>
                            <td align="center"><?php echo $row["REVISED"]; ?></td>
                            <td align="center" style="white-space:nowrap"><?php echo $row["SPEC_CODE"]; ?></td>
                            <?php
                            if ($MODE_AUDIT == "Tidak Aktif") {
                                ?>
                                <td align="center"><?php echo $row["JENIS_SPEC"]; ?></td>
                                <?php
                            }
                            ?>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Date"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Code"></th>
                        <?php
                        if ($MODE_AUDIT == "Tidak Aktif") {
                            ?>
                            <th><input type="search" class="form-control" name="search_engine" placeholder="Doc Type"></th>
                            <?php
                        }
                        ?>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Buyer"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Type"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Brand"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Packing"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="End User"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Country"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Revised"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Versi"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>