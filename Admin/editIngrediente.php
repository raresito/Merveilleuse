<?php
include "../dbconnect.php";

$sql = "update ingrediente
        set denumire = '".$_POST["editDenumire"]."',
          categorie = '".$_POST["editCategorie"]."',
          stocActual = ".$_POST["editStocActual"].",
          pret = ".$_POST["editPretUnitar"]."
        where id = '".$_POST["editID"]."'";
$result = mysqli_query($conn,$sql);

if($result){
    echo "Success";
} else {
    echo "Fail " . var_dump($_POST);
}
?>