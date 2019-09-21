<?php
	include('../config/linken.php');
    $id = $_POST['idPosisi'];
    $posisi = $_POST['posisi'];

	//update posisi
	$queryUpdatePosisi = "UPDATE posisi SET posisi='$posisi' WHERE id = $id ";
	$resultUpdatePosisi = mysqli_query($link,$queryUpdatePosisi) or die(mysqli_error($link));
	if(!$resultUpdateObat){
			echo "<script>alert('Error Update Posisi!');
				window.location.replace('../../view/posisi.php');
			";
		}
	header('Location: ../../view/posisi.php');
	
?>