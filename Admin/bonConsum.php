<?php

require_once ("../vendor/autoload.php");
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require 'requests/dbConnectAdmin.php';

$sql = "select po.order_id, po.product_id, po.quantity, pi.cantitate, pt.nameProduct, pi.id_ingredient, ing.denumire, ing.pret, po.quantity * pi.cantitate as ingredientpecomanda, ing.`U/M` as unitati, ROUND(ing.pret * po.quantity * pi.cantitate,3) as pretingcom
        from products_orders po join produs_ingredient pi
        on po.product_id = pi.id_product
        join producttable pt
        on pi.id_product = pt.idProduct
        join ingrediente ing
        on pi.id_ingredient = ing.id
        where po.order_id in (select orderID
                           from orders
                           where deliveryStatus = 1
                                 and deliveryDate = '2018-06-15');";
$result = mysqli_query($conn, $sql);

setlocale(LC_CTYPE, 'en_US');

if(isset($_POST["dataBon"])){
    $dataZiua = substr($_POST["dataBon"],0,4);
    $dataAnul = substr($_POST["dataBon"],5,2);
    $dataLuna = substr($_POST["dataBon"],8,2);
    echo 'ceva';
}

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

if(!$result){
    die("Query failed");
}

$i = 0;

while($row = $result -> fetch_assoc()){

    $pdf->SetXY(180, 49);
    $pdf->Write(0, $row["order_id"]);

    $pdf->SetXY(35, 62 + $i );
    $pdf->Write(0, em($row["denumire"]));

    $pdf->SetXY(138, 62 +$i );
    $pdf->Write(0, $row["ingredientpecomanda"]);

    $pdf->SetXY(170, 62 +$i );
    $pdf->Write(0, $row["id_ingredient"]);

    $pdf->SetXY(205, 62 +$i );
    $pdf->Write(0, $row["unitati"]);

    $pdf->SetXY(225, 62 +$i );
    $pdf->Write(0, $row["ingredientpecomanda"]);

    $pdf->SetXY(245, 62 +$i );
    $pdf->Write(0, $row["pret"]);

    $pdf->SetXY(270, 62 +$i );
    $pdf->Write(0, $row["pretingcom"]);

    $i = $i + 4.5;
}

$pdf->SetXY(120, 189);
$pdf->Write(0, $sefCompartiment);

$pdf->SetXY(180, 189);
$pdf->Write(0, $gestionar);

$pdf->SetXY(240, 189);
$pdf->Write(0, $primitor2);

$pdf->Output();

function em($word) {
    $word = iconv('UTF-8', 'ISO-8859-2', $word);
    return $word;
}

