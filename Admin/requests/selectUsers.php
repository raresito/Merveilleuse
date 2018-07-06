<?php

include "dbConnectAdmin.php";

$stmt = $conn->prepare("select * from user");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) exit('No rows');
while($row = $result->fetch_assoc()) {
    $arr[] = $row;
}
$stmt->close();

echo json_encode($arr);
?>