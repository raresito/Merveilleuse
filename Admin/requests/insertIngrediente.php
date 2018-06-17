<?php
include "../../dbconnect.php";
var_dump($_POST);
$sql = "insert into ingrediente (id, denumire, categorie, stocActual, pret)
        values (".$_POST["newIngredienteId"].", '".$_POST["newIngredienteName"]."', '".$_POST["newIngredienteCategory"]."', ".$_POST["newIngredienteStocActual"].",".$_POST["newIngredientePretUnitar"].")";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . $sql;
}
?>