<?php
$AKSES 			 = $_SESSION["LOGINAUTH_SPEC_BB"];
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
					DATE_FORMAT(e.TANGGAL, '%d %M %Y') as TANGGALL,
					DATE_FORMAT(e.TANGGAL, '%H:%i:%s') as JAM,
					p.NAMA_PERUSAHAAN,
					b.NAMA_BUYER,
					t.NAMA_PRODUK,
					d.NAMA_BRAND,
					i.NAMA_PACKING,
					u.NAMA_ENDUSER,
					c.NAMA_COUNTRY,
					m.NAMA_MERK,
					s.*,
					a.KODE_MERK 
			   from t_spec e, 
			   		m_perusahaan p, 
			   		m_buyer b, 
			   		m_produk t, 
			   		m_brand d, 
			   		m_packing i, 
			   		m_enduser u, 
			   		m_country c, 
			   		m_merk m, 
			   		d_spec s,
			   		m_typeakses a 
			  where e.KODE_PERUSAHAAN 	= p.KODE_PERUSAHAAN and 
			  		e.KODE_BUYER 		= b.KODE_BUYER and 
			  		e.KODE_PRODUK 		= t.KODE_PRODUK and 
			  		e.KODE_BRAND 		= d.KODE_BRAND and 
			  		e.KODE_PACKING 		= i.KODE_PACKING and 
			  		e.KODE_ENDUSER 		= u.KODE_ENDUSER and 
			  		e.KODE_COUNTRY 		= c.KODE_COUNTRY and 
			  		e.KODE_MERK 		= m.KODE_MERK and 
			  		e.KODE_SPEC 		= s.KODE_SPEC and 
			  		e.JENIS_SPEC 		= 'Eksternal' and
			  		e.KODE_MERK         = a.KODE_MERK and
			  		e.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN' and
			  		a.KODE_USER     	= '$KODE_USER' and
                	s.STATUS 			= '0'
           group by e.KODE_SPEC 
		   order by e.TANGGAL desc"); 
		$result->execute();
    }
    // JIKA MODE AUDIT TIDAK AKTIF
    else
    {
		$result = $db1->prepare(
			"select e.*,
					DATE_FORMAT(e.TANGGAL, '%d %M %Y') as TANGGALL,
					DATE_FORMAT(e.TANGGAL, '%H:%i:%s') as JAM,
					p.NAMA_PERUSAHAAN,
					b.NAMA_BUYER,
					t.NAMA_PRODUK,
					d.NAMA_BRAND,
					i.NAMA_PACKING,
					u.NAMA_ENDUSER,
					c.NAMA_COUNTRY,
					m.NAMA_MERK,
					s.*,
					a.KODE_MERK,
					(SELECT GROUP_CONCAT(pr_attachment) FROM t_packaging_requirement WHERE pr_spec_id = e.SPEC_CODE) AS pr_attachment 
			   from t_spec e, 
			   		m_perusahaan p, 
			   		m_buyer b, 
			   		m_produk t, 
			   		m_brand d, 
			   		m_packing i, 
			   		m_enduser u, 
			   		m_country c, 
			   		m_merk m, 
			   		d_spec s,
			   		m_typeakses a 
			  where e.KODE_PERUSAHAAN 	= p.KODE_PERUSAHAAN and 
			  		e.KODE_BUYER 		= b.KODE_BUYER and 
			  		e.KODE_PRODUK 		= t.KODE_PRODUK and 
			  		e.KODE_BRAND 		= d.KODE_BRAND and 
			  		e.KODE_PACKING 		= i.KODE_PACKING and 
			  		e.KODE_ENDUSER 		= u.KODE_ENDUSER and 
			  		e.KODE_COUNTRY 		= c.KODE_COUNTRY and 
			  		e.KODE_MERK 		= m.KODE_MERK and 
			  		e.KODE_SPEC 		= s.KODE_SPEC and
			  		e.KODE_MERK         = a.KODE_MERK and
			  		e.KODE_PERUSAHAAN   = '$KODE_PERUSAHAAN' and
			  		a.KODE_USER     	= '$KODE_USER' and
                	s.STATUS 			= '0' 
           group by e.KODE_SPEC
		   order by e.TANGGAL desc"); 
		$result->execute();
    	
    }
}
?>