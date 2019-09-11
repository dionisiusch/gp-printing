<?php
include('../config/linken.php');
$data = array();

$queryGetPosisi = $link->query("SELECT posisi from posisi");
while ($row = $queryGetPosisi->fetch_assoc()) {
    array_push($data,$row["posisi"]);
}

echo json_encode($data);
?>      