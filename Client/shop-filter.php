<?php

include '../dbconnect.php';

$sql = "SELECT * FROM producttable" ;

if(!array_key_exists("selection", $_POST) || $_POST["selection"] !== '' ) {
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

$arr = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        echo $row["nameProduct"];
        echo $row["category"];
        echo $row["description"];
        echo $row["flavour"];
        $arr[] = $row;
    }

    echo json_encode($arr);
}
?>