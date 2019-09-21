<?php
    include('../config/linken.php');
    
  $posisi = $_POST["posisi"];
    
	//insert db posisi
	$queryInsertPosisi = "INSERT INTO posisi (posisi) values ('$posisi')";
	$resultInsertPosisi = mysqli_query($link,$queryInsertPosisi) or die(mysqli_error($link));
	if(!$resultInsertPosisi){
			echo "<script>alert('Error Insert Posisi!');
				window.location.replace('../../view/posisi.php');
			";
		}
		

	header('Location: ../../view/posisi.php');
	
?>