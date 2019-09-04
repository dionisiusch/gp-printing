<?php
include('../config/linken.php');

$id = $_GET['id'];

$queryDeleteRevisi = "DELETE FROM revisi where id=$id";
$resultDeleteRevisi = mysqli_query($link,$queryDeleteRevisi) or die(mysqli_error($link));
if($resultDeleteRevisi){
  echo "<script type='text/javascript'>
window.location.replace('../../view/Revisi.php')</script>";
}


 ?>
