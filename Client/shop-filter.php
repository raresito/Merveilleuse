<?php

include 'requests/dbConnectClient.php';

$sql = "SELECT * FROM producttable" ;

if(!array_key_exists("selection", $_POST) || $_POST["selection"] !== '' ) {
    $wherePlaced = 0;

    if (isset($_POST["selection"]["type"])) {
        $wherePlaced = 1;
        $sql = $sql . " where (";
        foreach ($_POST["selection"]["type"] as $value) {
            $sql = $sql . " category = '" . $value . "' OR ";
        }
        $sql = substr($sql, 0, -4);
        $sql = $sql . ")";
    }

    if (isset($_POST["selection"]["type"]) && isset($_POST["selection"]["flavour"])){
        $sql = $sql . " AND ";
    }

    //TODO Implement aditional 1 filter
    if(isset($_POST["selection"]["flavour"])){
        if($wherePlaced == 0) {
            $sql = $sql . " where (";
            $wherePlaced = 1;
        } else { $sql = $sql . "("; }
        foreach ($_POST["selection"]["flavour"] as $value){
            $sql = $sql . " flavour = '" . $value . "' OR ";
        }
        $sql = substr($sql, 0, -4);
        $sql = $sql . ")";
    }
}

/*echo $sql;*/
$result = mysqli_query($conn,$sql);

$response='';

$arr = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        $arr[] = $row;
    }

    echo json_encode($arr);
} else { echo "{}"; }
?>