<?php
	include('../config/linken.php');

	
	$uploadPath = "../../assets/uploads/";
    $biaya=ReverseRupiah($_POST["perkiraanBiaya"]);
	$tglSample = $_POST["tglSample"];
	$artikel = $_POST["artikel"];
	$nomorPO = $_POST["nomorPO"];
	$obatArray = $_POST["obat"];
	$qtyObatArray = $_POST["qtyObat"];
	$posisiArray = $_POST["posisi"];
	$i = 1;
	$j = 1;

	function ReverseRupiah($biaya){
	$biaya = str_replace("Rp. ", "", $biaya);
	$biaya = str_replace(".", "", $biaya);
	$biaya = (int)$biaya;
	return $biaya;
	}
 
	// //insert db sample
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

	$queryInsertSampleObat='';

	foreach($obatArray as $obat){
		$queryGetIdObat = "SELECT id,kilo from obat where nama_obat = '$obat'";	
		$resultGetIdObat = $link->query($queryGetIdObat);
		while ($row = $resultGetIdObat->fetch_assoc()) {
			$qtyObat = $qtyObatArray[$j];	
			$queryInsertSampleObat .= "INSERT INTO sample_obat (id_obat,id_sample,qty) values (".$row['id'].",'$lastIdInsertSample',$qtyObat);";
			
		}
		$j++;
	}
		mysqli_multi_query($link,$queryInsertSampleObat);
		header('Location: ../../view/sample.php');
	
	
	
?>