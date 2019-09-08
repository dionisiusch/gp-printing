<?php
	include('../config/linken.php');

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
	$queryInsertObat = "INSERT INTO obat (nama_obat,kilo,harga_jual,harga_beli) values ('$namaObat',$kilo,$hargaJual,$hargaBeli)";
	$resultInsertObat = mysqli_query($link,$queryInsertObat) or die(mysqli_error($link));
	$lastIdInsertObat = mysqli_insert_id($link);	
	if(!$resultInsertObat){
			echo "<script>alert('Error Insert Obat!');
				window.location.replace('../../view/obat.php');
			";
		}
		

	header('Location: ../../view/obat.php');
	
?>