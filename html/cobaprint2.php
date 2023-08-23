<?php
require_once ("module/model/koneksi/koneksi.php");

$KODE_SPEC = $_GET["KODE_SPEC"];
$result = $db1->prepare("select INTERNAL_MEMO from t_spec where KODE_SPEC = '$KODE_SPEC'"); 
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$INTERNAL_MEMO = $row["INTERNAL_MEMO"];
}

function pdfEncrypt ($origFile, $password, $destFile){
//include the FPDI protection http://www.setasign.de/products/pdf-php-solutions/fpdi-protection-128/
require_once('fpdi/FPDI_Protection.php');

$pdf =& new FPDI_Protection();

//calculate the number of pages from the original document
$pagecount = $pdf->setSourceFile($origFile);

// copy all pages from the old unprotected pdf in the new one
for ($loop = 1; $loop <= $pagecount; $loop++) {
    $tplidx = $pdf->importPage($loop);
    $pdf->addPage();
    $pdf->useTemplate($tplidx);
}

// protect the new pdf file, and allow no printing, copy etc and leave only reading allowed
$pdf->SetProtection(array(),$password);
$pdf->Output($destFile, 'I');

return $destFile;
}

//password for the pdf file
$password = '';

//name of the original file (unprotected)
$origFile = $INTERNAL_MEMO;

//name of the destination file (password protected and printing rights removed)
$destFile = $INTERNAL_MEMO . "_protected.pdf";

//encrypt the book and create the protected file
pdfEncrypt($origFile, $password, $destFile );
?>