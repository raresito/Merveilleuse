<?php

include '../dbconnect.php';


function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

$rawCategory = $_REQUEST['category'];
$rawCategory = substr(substr($rawCategory,1), 0, -1);
$categoryFinal = explode(",",$rawCategory);

$rawPrice = $_REQUEST['price'];
//echo $rawPrice;
$rawPrice = substr(substr($rawPrice,1), 0, -1);
$priceFinal = explode(",",$rawPrice);

$sql = "SELECT * FROM producttable where " ;

if(sizeof($categoryFinal) > 0){
    $sql = $sql . "(";
}
for($i = 0; $i < sizeof($categoryFinal); $i++){
    if($i == sizeof($categoryFinal) - 1){
        $sql = $sql . "category = " . $categoryFinal[$i] . "";
    }
    else {
        $sql = $sql . "category = " . $categoryFinal[$i] . " OR ";
    }
}
if(sizeof($categoryFinal) > 0){
    $sql = $sql . ")";
}
console_log($sql);
$result = mysqli_query($conn,$sql);

$response='';

if ($result->num_rows > 0) { // TODO CEVA PROBLEMS HERE
    while($row = $result->fetch_assoc()) {
        $response = $response . '<div class="col-xs-6 col-sm-6 col-md-3 product-item">
                                    <div class="product-container">
                                        <div class="row">
                                            <div class="col-md-12"><a href="#" class="product-image"><img src="../resources/res/foto/' . $row["image"] . '"></a></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <h2><a href="#">' .$row["nameProduct"]. '</a></h2>
                                            </div>
                                        </div>
                                        Categorie: '.$row["category"].'
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna. </p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-light fill" type="button" onclick="addToBasket('.$row["idProduct"].')">Cumpără!</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="product-price">' . $row["priceProduct"] . "RON /" . $row["unitProduct"] .' </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
    }
}

echo $response;
?>