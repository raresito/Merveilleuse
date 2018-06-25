<?php
include "dbConnectClient.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = "select flavour
        from producttable
        where flavour is not null
        group by flavour";
$result = mysqli_query($conn, $sql);
$arr = array();
if ($result -> num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        $arr[] = $row;
    }
    echo json_encode($arr);
}
?>
