<?php
include('../config/linken.php');

//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $link->query("SELECT * FROM revisi WHERE id LIKE '%".$searchTerm."%' ORDER BY id ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['id']." | ".$row['nama'];
}
//return json data
echo json_encode($data);
?>