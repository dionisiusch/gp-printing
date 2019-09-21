<?php
include('../config/linken.php');

$id = $_GET['id'];

$queryDeletePosisi = "DELETE FROM posisi where id=$id";
$resultDeletePosisi = mysqli_query($link,$queryDeletePosisi) or die(mysqli_error($link));
if($resultDeletePosisi){
  echo "<script type='text/javascript'>
window.location.replace('../../view/posisi.php')</script>";
}


 ?>
