<?php

include '../dbconnect.php';

//echo $_POST["selection"]["type"][0];

$sql = "SELECT * FROM producttable" ;

if($_POST["selection"] !== '' || !isset($_POST["selection"])) {


    $wherePlaced = 0;

    if (isset($_POST["selection"]["type"])) {
        $wherePlaced = 1;
        $sql = $sql . " where ";
        foreach ($_POST["selection"]["type"] as $value) {
            $sql = $sql . " category = '" . $value . "' OR ";
        }
        $sql = substr($sql, 0, -4);
    }


    /*if(isset($_POST["selection"]["pret"])){
        if($wherePlaced == 0){
            $sql = $sql . "where ";
            foreach ($_POST["selection"]["pret"] as $value){
                $sql = $sql . ""
            }
        }
    }*/
}
$result = mysqli_query($conn,$sql);

$response='';

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $response = $response . '<div class="col-xs-6 col-sm-6 col-md-3 product-item d-flex flex-column">
                                    <div class="product-container d-flex flex-column">
                                        <div class="row" style="flex-grow: 1">
                                            <div class="col-md-12"><a href="#" class="product-image"><img src="../resources/img/foto/' . $row["image"] . '"></a></div>
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
echo $sql;
echo $response;
?>