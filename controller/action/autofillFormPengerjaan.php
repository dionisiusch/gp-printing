<?php
include('../config/linken.php');
// empty will do isset too, so you get two for the price of one!
if (!empty($_POST['InputPengerjaan'])) {


    $safe_pengerjaan = mysql_real_escape_string(trim($_POST['InputPengerjaan']));

    $query = mysql_query("
        SELECT qty_sendiri
        FROM pengerjaan
        WHERE  nomor_po = '". $safe_pengerjaan ."'
        LIMIT 1
    ");

    if (mysql_num_rows($query) > 0) {
        $row = mysql_fetch_assoc($query);
        json($row);
    } else {
        json(null);
    }
}

function json ($array) {
    header("Content-Type: application/json");
    echo json_encode($array);
}

?>