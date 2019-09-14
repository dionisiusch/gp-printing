<?php
include('../config/linken.php');
$tglNaikBahan = $_POST["tglNaikBahan"];
$id = $_POST["idSample"];
$query = $link->query("UPDATE sample set status=1,tgl_naik_bahan = '$tglNaikBahan' where id='$id'");

header("Location: ../../view/sample.php"); 
?>