<?php
    $COL = '#ffae00';
?>
<div class="navbar-toolbar clearfix" style="background-color: <?php echo $COL; ?> ;">
    <!-- START Left nav -->
    <ul class="nav navbar-nav navbar-left">
        <!-- Sidebar shrink -->
        <li class="hidden-xs hidden-sm">
            <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar" style="background-color: <?php echo $COL; ?> ;">
                <span class="meta">
                    <span class="icon"></span>
                </span>
            </a>
        </li>
        <!--/ Sidebar shrink -->

        <!-- Offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
        <li class="navbar-main hidden-lg hidden-md hidden-sm">
            <a href="javascript:void(0);" data-toggle="sidebar" data-direction="ltr" rel="tooltip" title="Menu sidebar">
                <span class="meta">
                    <span class="icon"><i class="ico-paragraph-justify3"></i></span>
                </span>
            </a>
        </li>
        <li>
            <br>
            <span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
                if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                {
                    $KODE_USER  = $_SESSION["LOGINIDUS_SPEC_BB"];
                    $resultmail = GetQuery("select STS_MAIL as MODE_EMAIL from m_user where KODE_USER = '$KODE_USER'");
                    while ($rowMail = $resultmail->fetch(PDO::FETCH_ASSOC)) 
                    {
                        extract($rowMail);
                    }
                    if ($MODE_EMAIL == "Tidak Aktif") 
                    {
                        ?>
                        <span class="icon" style="color:red;"><i class="fa fa-warning fa-lg"></i> &nbsp;&nbsp;<b>Status Email saat ini sedang tidak aktif !</b></span>
                        <?php
                    }
                }
                ?>
            </span>
        </li>
        <!--/ Offcanvas left -->
		
    </ul>
    <!--/ END Left nav -->

    <!-- START navbar form -->
    <div class="navbar-form navbar-left dropdown" id="dropdown-form">
        <form action="" role="search">
            <div class="has-icon">
                <input type="text" class="form-control" placeholder="Search application...">
                <i class="ico-search form-control-icon"></i>
            </div>
        </form>
    </div>
    <!-- START navbar form -->

    <!-- START Right nav -->
    <ul class="nav navbar-nav navbar-right">
		<!-- Notification dropdown -->
        <!--/ Notification dropdown -->
		
        <!-- Profile dropdown -->
        <li class="dropdown profile">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="background-color: <?php echo $COL; ?> ;">
                <span class="meta">
                    <span class="text hidden-xs hidden-sm pl5"><?php echo $_SESSION["LOGINNAMAUS_SPEC_BB"]." / ".$_SESSION["LOGINAKS_SPEC_BB"]." / ".$_SESSION["LOGINAKSDOC_SPEC_BB"]; ?></span>
                </span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <!-- <li><a href="edit_profile.php"><span class="icon"><i class="ico-cog4"></i></span> Profile Setting</a></li> -->
                <?php

                if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator" or $_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") 
                {
                    ?>
                    <li><a href="panduan/Buku Panduan User Spec - auhg9a8r32r.pdf" target="_blank"><span class="icon"><i class="fa fa-book fa-lg"></i></span> Manual Book</a></li>
                    <li><a href="parameter.php"><span class="icon"><i class="fa fa-share-alt fa-lg"></i></span> Parameter</a></li>
                    <li><a href="reemail.php"><span class="icon"><i class="fa fa-envelope-alt fa-lg"></i></span> Email Manual</a></li>
                    <?php
                }
                else
                {
                    ?>
                    <li><a href="panduan/Buku Panduan User - awe54ga421q2.pdf" target="_blank"><span class="icon"><i class="fa fa-book fa-lg"></i></span> Manual Book</a></li>
                    <?php
                }
                ?>
                <li class="divider"></li>
                <li><a href="logout.php"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
            </ul>
        </li>
        <!-- Profile dropdown -->
      
    </ul>
    <!--/ END Right nav -->
</div>
<!--/ END Toolbar -->