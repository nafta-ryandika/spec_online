<?php
require_once ("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_SPEC_BB"]))
{
    ?><script>alert('You must login first');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}
?>
<!DOCTYPE html>
<html class="backend">
    <!-- START Head -->
    <head>
        <?php include "module/model/head/head.php"; ?>
    </head>
    <!--/ END Head -->

    <!-- START Body -->
    <body>
        <!-- START Template Header -->
        <header id="header" class="navbar">
            <!-- START navbar header -->
            <?php include "module/model/header/header.php"; ?>
            <!--/ END Toolbar -->
        </header>
        <!--/ END Template Header -->

        <!-- START Template Sidebar (Left) -->
        <?php include "module/model/sidebar/sidebar.php"; ?>
        <!--/ END Template Sidebar (Left) -->
        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <?php include "module/view/main/main.php"; ?>
            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main -->
        <?php include "module/model/footer/footer.php"; ?>

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- Application and vendor script : mandatory -->
        <script type="text/javascript" src="../javascript/vendor.js"></script>
        <script type="text/javascript" src="../javascript/core.js"></script>
        <script type="text/javascript" src="../javascript/backend/app.js"></script>
        <!--/ Application and vendor script : mandatory -->

        <!-- Plugins and page level script : optional -->
        <script type="text/javascript" src="../javascript/pace.min.js"></script>
        <script type="text/javascript" src="../plugins/selectize/js/selectize.js"></script>
        <script type="text/javascript" src="../plugins/flot/js/jquery.flot.js"></script>
        <script type="text/javascript" src="../plugins/flot/js/jquery.flot.resize.js"></script>
        <script type="text/javascript" src="../plugins/flot/js/jquery.flot.categories.js"></script>
        <script type="text/javascript" src="../plugins/flot/js/jquery.flot.time.js"></script>
        <script type="text/javascript" src="../plugins/flot/js/jquery.flot.tooltip.js"></script>
        <script type="text/javascript" src="../plugins/flot/js/jquery.flot.spline.js"></script>
        <script type="text/javascript" src="../javascript/backend/pages/dashboard-v1.js"></script>

        <script type="text/javascript" src="../plugins/datatables/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../plugins/datatables/tabletools/js/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="../plugins/datatables/js/datatables-bs3.js"></script>
        <script type="text/javascript" src="../javascript/backend/tables/datatable.js"></script>
        <!--/ Plugins and page level script : optional -->
        <!--/ END JAVASCRIPT SECTION -->
    </body>
    <!--/ END Body -->
</html>