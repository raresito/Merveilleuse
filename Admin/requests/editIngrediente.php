<?php
include "dbConnectAdmin.php";

$sql = "update ingredient
        set nameIngredient = '" .$_POST["editDenumire"]."',
          categoryIngredient = '".$_POST["editCategorie"]."',
          stockIngredient = ".$_POST["editStocActual"].",
          priceIngredient = ".$_POST["editPretUnitar"]."
        where idIngredient = '".$_POST["editID"]."'";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . var_dump($_POST);
}
?>