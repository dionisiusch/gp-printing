<?php
include('../config/linken.php');
$data = array();

$queryGetObat = $link->query("SELECT nama_obat from obat");
while ($row = $queryGetObat->fetch_assoc()) {
    array_push($data,$row["nama_obat"]);
}

echo json_encode($data);
?>      