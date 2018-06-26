<?php
include "dbConnectAdmin.php";
var_dump($_POST);
$sql = "insert into ingredient (idIngredient, nameIngredient, categoryIngredient, stockIngredient, priceIngredient, unitIngredient)
        values (" .$_POST["newIngredienteId"].",
         '".$_POST["newIngredienteName"]."',
          '".$_POST["newIngredienteCategory"]."',
           ".$_POST["newIngredienteStocActual"].",
           ".$_POST["newIngredientePretUnitar"].",
            '".$_POST["newIngredienteUnitateMasura"]."')";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . $sql;
}
?>