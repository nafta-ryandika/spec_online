<aside class="sidebar sidebar-left sidebar-menu">
    <!-- START Sidebar Content -->
    <section class="content slimscroll">
        <!-- START Template Navigation/Menu -->
        <ul class="topmenu topmenu-responsive" data-toggle="menu">
            <li>
                <a href="menuutama.php" data-target="#dashboard" data-parent=".topmenu">
                    <span class="figure"><i class="fa fa-home fa-lg"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li >
                <a href="t_imgeneral.php">
                    <span class="figure"><i class="fa fa-file"></i></span>
                    <span class="text">Internal Memo General</span>
                </a>
            </li>
            <?php
                $sqlX = "SELECT * FROM m_email WHERE e_user_id ='".$_SESSION["LOGINIDUS_SPEC_BB"]."'";
                $resX = $db1->prepare($sqlX);
                $resX->execute();
                $rowX = $resX->rowCount();

                if ($rowX > 0) {
            ?>
                <li>
                    <a href="t_packagingRequirement.php">
                        <span class="figure"><i class="fa fa-dropbox"></i></span>
                        <span class="text">Packaging Requirement</span>
                    </a>
                </li>
            <?php
                }
            ?>
            <li >
                <a href="javascript:void(0);" data-target="#laporan" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="fa fa-paste"></i></span>
                    <span class="text">Report</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="laporan" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Laporan</li>
                    <li >
                        <a href="l_laporanfinishproduk.php">
                            <span class="text">Finish Product Spec</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
        </ul>
        <!--/ END Template Navigation/Menu -->
    </section>
    <!--/ END Sidebar Container -->
</aside>