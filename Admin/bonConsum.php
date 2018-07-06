<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ("../vendor/autoload.php");
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once 'requests/dbConnectAdmin.php';

setlocale(LC_CTYPE, 'en_US');


$source = "../bdcpdf.pdf";
$numarDocument = 1214;
$dataZiua = 28;
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


if(isset($_POST["dataBon"])){
    $dataAnul = substr($_POST["dataBon"],0,4);
    $dataLuna = substr($_POST["dataBon"],5,2);
    $dataZiua = substr($_POST["dataBon"],8,2);

    $sql = "select po.idOrder, po.idProduct, po.quantity, pi.quantity, pt.nameProduct, pi.idIngredient, ing.nameIngredient, ing.priceIngredient, po.quantity * pi.quantity as ingredientpecomanda, ing.unitIngredient as unitati, ROUND(ing.priceIngredient * po.quantity * pi.quantity,3) as pretingcom
        from `product-order` po join product_ingredient pi
        on po.idProduct = pi.idProduct
        join product pt
        on pi.idProduct = pt.idProduct
        join ingredient ing
        on pi.idIngredient = ing.idIngredient
        where po.idOrder in (select idOrder
                           from `order`
                           where deliveryStatus = 1
                                 and deliveryDate = '" .$_POST["dataBon"]."');";
    $result = mysqli_query($conn, $sql);
} else {

    $sql = "select po.idOrder, po.idProduct, po.quantity, pi.quantity, pt.nameProduct, pi.idIngredient, ing.nameIngredient, ing.priceIngredient, po.quantity * pi.quantity as ingredientpecomanda, ing.unitIngredient as unitati, ROUND(ing.priceIngredient * po.quantity * pi.quantity,3) as pretingcom
        from `product-order` po join product_ingredient pi
        on po.idProduct = pi.idProduct
        join product pt
        on pi.idProduct = pt.idProduct
        join ingredient ing
        on pi.idIngredient = ing.idIngredient
        where po.idOrder in (select idOrder
                           from `order`
                           where deliveryStatus = 1
                                 and deliveryDate = '2018-06-28');";
    $result = mysqli_query($conn, $sql);
    echo mysqli_error($conn);
}

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
    $pdf->Write(0, $row["idOrder"]);

    $pdf->SetXY(35, 62 + $i );
    $pdf->Write(0, em($row["nameIngredient"]));

    $pdf->SetXY(138, 62 +$i );
    $pdf->Write(0, $row["ingredientpecomanda"]);

    $pdf->SetXY(170, 62 +$i );
    $pdf->Write(0, $row["idIngredient"]);

    $pdf->SetXY(205, 62 +$i );
    $pdf->Write(0, $row["unitati"]);

    $pdf->SetXY(225, 62 +$i );
    $pdf->Write(0, $row["ingredientpecomanda"]);

    $pdf->SetXY(245, 62 +$i );
    $pdf->Write(0, $row["priceIngredient"]);

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

?>



