<?php
include('../config/linken.php');
$data = array();

$queryGetPengerjaan = $link->query("SELECT nomor_po from pengerjaan");
while ($row = $queryGetPengerjaan->fetch_assoc()) {
    array_push($data,$row["nomor_po"]);
}

echo json_encode($data);
?>      