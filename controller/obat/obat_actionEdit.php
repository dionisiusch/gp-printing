<?php
	include('../config/linken.php');
    $id = $_POST['idObat'];
    $namaObat =strtoupper($_POST['namaObat']);
    $kilo=$_POST['kilo'];
    $kilo=str_replace(",",".",$kilo);
    $kilo =floatval(str_replace(" Kg","",$kilo));
    $hargaJual =$_POST['hargaJual'];
    $hargaJual =str_replace(".","",$hargaJual);
    $hargaJual =str_replace("Rp ","", $hargaJual);
    $hargaBeli =$_POST['hargaBeli'];
    $hargaBeli =str_replace(".","", $hargaBeli);
    $hargaBeli =str_replace("Rp ","", $hargaBeli);

	//insert db obat
	$queryUpdateObat = "UPDATE obat SET nama_obat='$namaObat',kilo=$kilo,harga_jual=$hargaJual,harga_beli=$hargaBeli WHERE id = $id ";
	$resultUpdateObat = mysqli_query($link,$queryUpdateObat) or die(mysqli_error($link));
	$lastIdUpdateObat = mysqli_insert_id($link);	
	if(!$resultUpdateObat){
			echo "<script>alert('Error Update Obat!');
				window.location.replace('../../view/obat.php');
			";
		}
		

	header('Location: ../../view/obat.php');
	
?>