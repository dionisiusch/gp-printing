<?php
include('../config/linken.php');

//get search term
//get matched data from skills table
$query = $link->query("SELECT pengerjaan.id,pelanggan.nama FROM pengerjaan join sample on pengerjaan.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id WHERE pengerjaan.id");

while ($row = $query->fetch_assoc()) {
    $data[] = $row['id']." | ".$row['nama'];
}
//return json data
echo json_encode($data);
?>