<?php

$KODE_USER      = "";
$NAMA_USER      = "";
$NAMA_MERK      = "";

if(isset($_POST["cari"]))
{
    $KODE_MERK = $_POST["AKSES"];
    $result    = $db1->prepare(
                         "select a.*,
                                 b.NAMA_MERK 
                            from m_user a,
                                 m_merk b,  
                                 m_typeakses c
                           where b.KODE_MERK = c.KODE_MERK and 
                                 a.KODE_USER = c.KODE_USER and
                                 a.KODE_PERUSAHAAN = c.KODE_PERUSAHAAN and
                                 b.KODE_MERK='$KODE_MERK'");
    
}
?>