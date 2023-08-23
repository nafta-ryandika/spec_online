<?php
$resultau = $db1->prepare("select MODE_AUDIT from p_audit"); 
$resultau->execute();
while ($rowau = $resultau->fetch(PDO::FETCH_ASSOC)) {
    if ($rowau["MODE_AUDIT"] == "Aktif") {
        $KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"];
        $result = $db1->prepare("select e.*,DATE_FORMAT(e.TANGGAL, '%d %M %Y') as TANGGAL,DATE_FORMAT(e.TANGGAL, '%H:%i:%s') as JAM,p.NAMA_PERUSAHAAN,b.NAMA_BUYER,t.NAMA_PRODUK,d.NAMA_BRAND,i.NAMA_PACKING,u.NAMA_ENDUSER,c.NAMA_COUNTRY,m.NAMA_MERK from t_spec e, m_perusahaan p, m_buyer b, m_produk t, m_brand d, m_packing i, m_enduser u, m_country c, m_merk m where e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and e.KODE_BUYER = b.KODE_BUYER and e.KODE_PRODUK = t.KODE_PRODUK and e.KODE_BRAND = d.KODE_BRAND and e.KODE_PACKING = i.KODE_PACKING and e.KODE_ENDUSER = u.KODE_ENDUSER and e.KODE_COUNTRY = c.KODE_COUNTRY and e.KODE_MERK = m.KODE_MERK and (e.KODE_MERK = '2' or e.KODE_MERK = '8') and e.JENIS_SPEC = 'Eksternal'"); 
        $result->execute();
    }
    else{
        $KODE_PERUSAHAAN = $_SESSION["LOGINPER_SPEC_BB"];
        $result = $db1->prepare("select e.*,DATE_FORMAT(e.TANGGAL, '%d %M %Y') as TANGGAL,DATE_FORMAT(e.TANGGAL, '%H:%i:%s') as JAM,p.NAMA_PERUSAHAAN,b.NAMA_BUYER,t.NAMA_PRODUK,d.NAMA_BRAND,i.NAMA_PACKING,u.NAMA_ENDUSER,c.NAMA_COUNTRY,m.NAMA_MERK from t_spec e, m_perusahaan p, m_buyer b, m_produk t, m_brand d, m_packing i, m_enduser u, m_country c, m_merk m where e.KODE_PERUSAHAAN = p.KODE_PERUSAHAAN and e.KODE_BUYER = b.KODE_BUYER and e.KODE_PRODUK = t.KODE_PRODUK and e.KODE_BRAND = d.KODE_BRAND and e.KODE_PACKING = i.KODE_PACKING and e.KODE_ENDUSER = u.KODE_ENDUSER and e.KODE_COUNTRY = c.KODE_COUNTRY and e.KODE_MERK = m.KODE_MERK and (e.KODE_MERK = '2' or e.KODE_MERK = '8')"); 
        $result->execute();
    }
}
?>