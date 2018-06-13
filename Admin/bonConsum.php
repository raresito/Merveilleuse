<?php

require_once ("../vendor/autoload.php");
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

$source = "../bdcpdf.pdf";
$numarDocument = 1214;
$dataZiua = 9;
$dataLuna = 6;
$dataAnul = 2018;
$predator = "Tudor Cristea";
$primitor = "Rares Cristea";
$codProdus = "241441";
$denumireMaterial = "Faina";
$cantitateMaterial = 10;
$codMaterial = "2114";
$unitateMasuraProdus = "grame";
$cantitateEliberata = 10;
$pretulUnitar = 0.01;
$valoarea = 0.1;
$sefCompartiment = "Tudor Cristea";
$gestionar = "Tudor Cristea";
$primitor2 = "Rares Cristea";

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile($source);
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('L');
$pdf->useImportedPage($pageId, 10, 8);
$pdf->SetFont('Arial', '', 10);

$pdf->SetXY(29, 49);
$pdf->Write(0, $numarDocument);

$pdf->SetXY(49, 49);
$pdf->Write(0, $dataZiua);

$pdf->SetXY(68, 49);
$pdf->Write(0, $dataLuna);

$pdf->SetXY(85, 49);
$pdf->Write(0, $dataAnul);

$pdf->SetXY(107, 49);
$pdf->Write(0, $predator);

$pdf->SetXY(140, 49);
$pdf->Write(0, $primitor);

$pdf->SetXY(180, 49);
$pdf->Write(0, $codProdus);

$pdf->SetXY(35, 62);
$pdf->Write(0, $denumireMaterial);

$pdf->SetXY(138, 62);
$pdf->Write(0, $cantitateMaterial);

$pdf->SetXY(180, 62);
$pdf->Write(0, $codMaterial);

$pdf->SetXY(205, 62);
$pdf->Write(0, $unitateMasuraProdus);

$pdf->SetXY(225, 62);
$pdf->Write(0, $cantitateEliberata);

$pdf->SetXY(245, 62);
$pdf->Write(0, $pretulUnitar);

$pdf->SetXY(270, 62);
$pdf->Write(0, $valoarea);

$pdf->SetXY(120, 189);
$pdf->Write(0, $sefCompartiment);

$pdf->SetXY(180, 189);
$pdf->Write(0, $gestionar);

$pdf->SetXY(240, 189);
$pdf->Write(0, $primitor2);

$pdf->Output();

?>