<?php
$NOMOR           = $_SESSION["LOGINNOM_SPEC_BB"];
$AKSES           = $_SESSION["LOGINAUTH_SPEC_BB"];
$KODE_USER       = $_SESSION["LOGINIDUS_SPEC_BB"];
$KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"];

$resultau = $db1->prepare("select MODE_AUDIT from p_audit"); 
$resultau->execute();
while ($rowau = $resultau->fetch(PDO::FETCH_ASSOC)) 
{
    $MODE_AUDIT = $rowau["MODE_AUDIT"];
    //JIKA MODE AUDIT AKTIF
    if ($rowau["MODE_AUDIT"] == "Aktif") 
    {
        $result = $db1->prepare(
            "select e.*,
                    DATE_FORMAT(w.TANGGAL_HISTORY, '%d %M %Y') as TANGGAL,
                    DATE_FORMAT(w.TANGGAL_HISTORY, '%H:%i:%s') as JAM,
                    p.NAMA_PERUSAHAAN,
                    b.NAMA_BUYER,
                    t.NAMA_PRODUK,
                    d.NAMA_BRAND,
                    i.NAMA_PACKING,
                    u.NAMA_ENDUSER,
                    c.NAMA_COUNTRY,
                    m.NAMA_MERK, 
                    w.VERSI,
                    w.REVISED
               from t_spec e
               JOIN d_spec w ON e.KODE_SPEC = w.KODE_SPEC 
               JOIN m_perusahaan p ON e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN
               JOIN m_buyer b ON e.KODE_BUYER = b.KODE_BUYER
               JOIN m_produk t ON e.KODE_PRODUK = t.KODE_PRODUK
               JOIN m_brand d ON e.KODE_BRAND = d.KODE_BRAND
               JOIN m_packing i ON e.KODE_PACKING = i.KODE_PACKING
               JOIN m_enduser u ON e.KODE_ENDUSER = u.KODE_ENDUSER
               JOIN m_country c ON e.KODE_COUNTRY = c.KODE_COUNTRY
               JOIN m_merk m ON e.KODE_MERK = m.KODE_MERK
               JOIN m_typeakses a ON e.KODE_MERK = a.KODE_MERK
              where a.KODE_USER         = '$KODE_USER' and
                    e.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN' and
                    e.JENIS_SPEC        = 'Eksternal'
           order by w.TANGGAL_HISTORY desc");
        $result->execute();
        
    }
    // JIKA MODE AUDIT TIDAK AKTIF
    else
    {
        $result = $db1->prepare(
        "select e.*,
                DATE_FORMAT(w.TANGGAL_HISTORY, '%d %M %Y') as TANGGAL,
                DATE_FORMAT(w.TANGGAL_HISTORY, '%H:%i:%s') as JAM,
                p.NAMA_PERUSAHAAN,
                b.NAMA_BUYER,
                t.NAMA_PRODUK,
                d.NAMA_BRAND,
                i.NAMA_PACKING,
                u.NAMA_ENDUSER,
                c.NAMA_COUNTRY,
                m.NAMA_MERK, 
                w.VERSI,
                w.REVISED
           from t_spec e
           JOIN d_spec w ON e.KODE_SPEC = w.KODE_SPEC 
           JOIN m_perusahaan p ON e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN
           JOIN m_buyer b ON e.KODE_BUYER = b.KODE_BUYER
           JOIN m_produk t ON e.KODE_PRODUK = t.KODE_PRODUK
           JOIN m_brand d ON e.KODE_BRAND = d.KODE_BRAND
           JOIN m_packing i ON e.KODE_PACKING = i.KODE_PACKING
           JOIN m_enduser u ON e.KODE_ENDUSER = u.KODE_ENDUSER
           JOIN m_country c ON e.KODE_COUNTRY = c.KODE_COUNTRY
           JOIN m_merk m ON e.KODE_MERK = m.KODE_MERK
           JOIN m_typeakses a ON e.KODE_MERK = a.KODE_MERK
          where a.KODE_USER         = '$KODE_USER' and
                e.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN'
       order by w.TANGGAL_HISTORY desc");
        $result->execute();
    }
}
?>