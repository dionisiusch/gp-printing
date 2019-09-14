<?php
include('../config/linken.php');
$data = array();

$queryGetRevisi = $link->query("SELECT nomor_po from revisi");
while ($row = $queryGetRevisi->fetch_assoc()) {
    array_push($data,$row["nomor_po"]);
}

echo json_encode($data);
?>      