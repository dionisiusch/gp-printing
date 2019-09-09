<?php
include('../config/linken.php');

$id = $_GET['id'];

$queryDeleteGudang = "DELETE FROM gudang where id=$id";
$resultDeleteGudang = mysqli_query($link,$queryDeleteGudang) or die(mysqli_error($link));
if($resultDeleteGudang){
  echo "<script type='text/javascript'>
window.location.replace('../../view/gudang.php')</script>";
}


 ?>
