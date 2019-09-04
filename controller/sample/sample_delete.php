<?php
include('../config/linken.php');

$id = $_GET['id'];

$queryDeleteSample = "DELETE FROM sample where id=$id";
$resultDeleteSample = mysqli_query($link,$queryDeleteSample) or die(mysqli_error($link));
if($resultDeleteSample){
  echo "<script type='text/javascript'>
window.location.replace('../../view/Sample.php')</script>";
}


 ?>
