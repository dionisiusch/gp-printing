<?php
	include('../config/linken.php');

	
	$uploadPath = "../../assets/uploads/";
    $biaya=$_POST["perkiraanBiaya"];
	$tglSample = $_POST["tglSample"];
	$artikel = $_POST["artikel"];
	$nomorPO = $_POST["nomorPO"];
	$obatArray = $_POST["obat"];
	$qtyObatArray = $_POST["qtyObat"];
	$posisiArray = $_POST["posisi"];
	$i = 1;
	$j = 1;
 
	//insert db sample
	$queryInsertSample = "INSERT INTO sample (artikel,tgl,biaya,nomor_po) values('$artikel','$tglSample',$biaya,'$nomorPO')";
	$resultInsertSample = mysqli_query($link,$queryInsertSample) or die(mysqli_error($link));
	$lastIdInsertSample = mysqli_insert_id($link);	
	if(!$resultInsertSample){
			echo "<script>alert('Error Insert Sample!');
				window.location.replace('../../view/sample.php');
			";
		}
		
	//upload ke ../assets/uploads
    foreach ($posisiArray as $file)
            {

                    $file_name = $_FILES['sample']['name'][$i];
                    $file_size =$_FILES['sample']['size'][$i];
                    $file_tmp =$_FILES['sample']['tmp_name'][$i];


                    $file = $uploadPath.$file_name;  
                                        
					if(move_uploaded_file($file_tmp,$file)){
						InsertDetailSample($posisiArray[$i],$file_name);
					}else{
						echo 'fail upload!';
					};     

                   
               $i++;
            }
	
	
	//insert db detail sample
	function InsertDetailSample($paramPosisi,$paramSample){
		global $link, $lastIdInsertSample;
		$queryInsertDetailSample = "INSERT INTO detail_sample (id_sample,posisi,desain) values('$lastIdInsertSample','$paramPosisi','$paramSample')";
		$resultInsertDetailSample = mysqli_query($link,$queryInsertDetailSample) or die(mysqli_error($link));
		if(!$resultInsertDetailSample){
			echo "<script>alert('Error Insert Detail Sample!');
				window.location.replace('../../view/sample.php');
			";
		}
		
	}

	//find id obat
	foreach($obatArray as $obat){
		$queryGetIdObat = "SELECT id from obat where nama_obat = '$obat'";	
		$resultGetIdObat = $link->query($queryGetIdObat);
		while ($row = $resultGetIdObat->fetch_assoc()) {
	//insert to sample_obat
		$qtyObat = $qtyObatArray[$j];	
		$queryInsertSampleObat = "INSERT INTO sample_obat (id_obat,id_sample,qty) values (".$row['id'].",'$lastIdInsertSample',$qtyObat)";
		$resultInsertSampleObat = mysqli_query($link,$queryInsertSampleObat) or die(mysqli_error($link));			
		}
		$j++;
	}
	
	header('Location: ../../view/sample.php');
	
	
?>