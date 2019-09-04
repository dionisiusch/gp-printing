<?php
	include('../config/linken.php');

	
	$uploadPath = "../../assets/uploads/";
    $biaya=$_POST['perkiraanBiaya'];
	$tglSample = $_POST['tglSample'];
	$idPelanggan = substr($_POST['pelanggan'], 0, strpos($_POST['pelanggan'], '|')-1);
    $idPelanggan = intval($idPelanggan);
	$lokasiArray = $_POST['lokasi'];
	$i = 1; 
	//insert db sample
	$queryInsertSample = "INSERT INTO sample (id_pelanggan,tgl,biaya) values($idPelanggan,'$tglSample',$biaya)";
	$resultInsertSample = mysqli_query($link,$queryInsertSample) or die(mysqli_error($link));
	$lastIdInsertSample = mysqli_insert_id($link);	
	if(!$resultInsertSample){
			echo "<script>alert('Error Insert Sample!');
				window.location.replace('../../view/sample.php');
			";
		}
		
	//upload ke ../assets/uploads
    foreach ($lokasiArray as $file)
            {

                    $file_name = $_FILES['sample']['name'][$i];
                    $file_size =$_FILES['sample']['size'][$i];
                    $file_tmp =$_FILES['sample']['tmp_name'][$i];


                    $file = $uploadPath.$file_name;  
                                        
					if(move_uploaded_file($file_tmp,$file)){
						InsertDetailSample($lokasiArray[$i],$file_name);
					}else{
						echo 'fail upload!';
					};     

                   
               $i++;
            }
	
	
	//insert db detail sample
	function InsertDetailSample($paramLokasi,$paramSample){
		global $link, $lastIdInsertSample;
		$queryInsertDetailSample = "INSERT INTO detail_sample (id_sample,lokasi,desain) values('$lastIdInsertSample','$paramLokasi','$paramSample')";
		$resultInsertDetailSample = mysqli_query($link,$queryInsertDetailSample) or die(mysqli_error($link));
		if(!$resultInsertDetailSample){
			echo "<script>alert('Error Insert Detail Sample!');
				window.location.replace('../../view/sample.php');
			";
		}
		
	}
	
	header('Location: ../../view/sample.php');
	
	
?>