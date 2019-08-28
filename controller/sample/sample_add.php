<?php
	include('../config/linken.php');

	$currentDir = getcwd();
    $uploadDirectory = ".../assets/uploads/";
	$path = $currentDir.$uploadDirectory;
	
	$tglSample = $_POST['tglSample'];
	$lokasiArray = $_POST['lokasi'];
	$sampleArray = $_POST['sample'];
	
		
	foreach($lokasiArray as $lokasi){
		echo $lokasi."--";
	}
	foreach($sampleArray as $sample){
		echo $path.$sample."--";
		$fileName = $_FILES['sample']['name'];
		echo $fileName;
		move_uploaded_file($sample, $path);
		}
	
?>