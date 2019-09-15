<?php
include('../config/linken.php');

$id = $_GET['id'];

$queryDeleteObat = "DELETE FROM obat where id=$id";
$resultDeleteObat = mysqli_query($link,$queryDeleteObat) or die(mysqli_error($link));
if($resultDeleteObat){
  echo "<script type='text/javascript'>
window.location.replace('../../view/Obat.php')</script>";
}


 ?>
