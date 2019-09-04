<?php
include('../config/linken.php');

$id = $_GET['id'];

$queryDeletePengerjaan = "DELETE FROM pengerjaan where id=$id";
$resultDeletePengerjaan = mysqli_query($link,$queryDeletePengerjaan) or die(mysqli_error($link));
if($resultDeletePengerjaan){
  echo "<script type='text/javascript'>
window.location.replace('../../view/pengerjaan.php')</script>";
}


 ?>
