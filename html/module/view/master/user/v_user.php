<?php
$KODPER = $_SESSION["LOGINPER_SPEC_BB"];

if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator") {
    $result = $db1->prepare("select * from m_user"); 
	$result->execute();
}
else
{
    $result = $db1->prepare("select * from m_user where AKSES != 'Administrator'"); 
	$result->execute();
}
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-group"></i> Master User</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama.php"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="ico-group"></i> User</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_user.php" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add User</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">User List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th style="white-space:nowrap">ID User</th>
                        <th style="white-space:nowrap">Nama</th>
                        <th style="white-space:nowrap">Departemen</th>
                        <th style="white-space:nowrap">Perusahaan</th>
                        <th style="white-space:nowrap">Authority</th>
                        <th style="white-space:nowrap">Email</th>
                        <th style="white-space:nowrap">Akses</th>
                        <th style="white-space:nowrap">Akses Document</th>
                        <th style="white-space:nowrap">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $KP        = $row["KODE_PERUSAHAAN"];
                        $KODE_USER = $row["KODE_USER"];
                        if($KP == 1)
                        {
                            $NP = "PT. Mega Marine Pride";
                        }
                        else
                        {
                            $NP = "PT. Baramuda Bahari";
                        }
                        ?>
                        <tr>
                            <td align="center">
                                <div class="btn-group" style="margin-bottom:5px;">
                                    <button type="button" class="btn btn-primary btn-rounded mb5 dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                    <?php 
                                        if($_SESSION["LOGINAUTH_SPEC_BB"] != "Administrator")
                                        { 
                                        ?>
                                            <li><a href="edit_akses.php?KODE_USER=<?php echo $row["KODE_USER"];?>&&KP=<?php echo $row["KODE_PERUSAHAAN"]?>" style="color:black;"><i class="fa fa-universal-access fa-lg"></i>  Edit akses</a></li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <li><a href="tambah_user.php?KODE_USER=<?php echo $row["KODE_USER"];?>&&KP=<?php echo $row["KODE_PERUSAHAAN"]?>" style="color:black;"><i class="fa fa-edit fa-lg"></i> Edit user</a></li>
                                            <li class="divider"></li>
                                            <li><a href="edit_akses.php?KODE_USER=<?php echo $row["KODE_USER"];?>&&KP=<?php echo $row["KODE_PERUSAHAAN"]?>" style="color:black;"><i class="fa fa-universal-access fa-lg"></i>  Edit akses</a></li>
                                        <?php
                                        }

                                    ?> 
                                       
                                    </ul>
                                </div>
                            </td>
                            <td align=""><?php echo $KODE_USER; ?></span></td>
                            <td align=""><?php echo $row["NAMA_USER"]; ?></span></td>
                            <td align=""><?php echo $row["DEPARTEMEN"]; ?></td>
                            <td align=""><?php echo $NP; ?></td>
                            <td align=""><?php echo $row["AKSES"]; ?></td>
                            <td align=""><?php echo $row["EMAIL"]; ?></td>
                            <td align="">
                                <select>
                                    <option value="">--------- Tipe Akses ---------</option>
                                    <?php
                                    $resulta = $db1->prepare("
                                      select u.*,
                                             m.NAMA_MERK 
                                        from m_user u,
                                             m_typeakses ta,
                                             m_merk m  
                                       where m.KODE_MERK = ta.KODE_MERK and 
                                             u.KODE_USER = ta.KODE_USER and
                                             u.KODE_PERUSAHAAN = '$KP' and
                                             ta.KODE_PERUSAHAAN = '$KP' and
                                             u.KODE_USER='$KODE_USER'"); 
                                    $resulta->execute();
                                    while ($rowa = $resulta->fetch(PDO::FETCH_ASSOC)) 
                                    {
                                        ?>
                                        <option disabled value=""><?php echo $rowa["NAMA_MERK"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td align=""><?php echo $row["AKSES_DOC"]; ?></td>
                            <td align=""><?php echo $row["STATUS"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="ID"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Nama"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Departemen"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Perusahaan"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Authority"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Akses"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>