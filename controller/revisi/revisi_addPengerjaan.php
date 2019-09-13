<?php
	include('../config/linken.php');

	
    $nomorPo=$_POST["InputPengerjaan"];
    $qtyRevisi=$_POST["qtyPengerjaan"];
	$tglrevisiPengerjaan = $_POST["tglrevisiPengerjaan"];
    $tglDeadline = $_POST["tglDeadline"];
    
	
	//insert db sample
	$queryInsertPengerjaanRevisi = "INSERT INTO revisi (id_sample,id_pengerjaan,nomor_po,tipe,tgl_mulai,tgl_deadline,status,qty_awal) 
    SELECT id_sample,id,nomor_po,tipe,'$tglrevisiPengerjaan','$tglDeadline',1,$qtyRevisi FROM pengerjaan where nomor_po='$nomorPo' ";
	$resultInsertPengerjaanRevisi = mysqli_query($link,$queryInsertPengerjaanRevisi) or die(mysqli_error($link));

	if(!$resultInsertPengerjaanRevisi){
			echo "<script>alert('Error Insert Sample!');
				window.location.replace('../../view/revisi.php');
			";
		}
    $query = $link->query("SELECT tipe from pengerjaan where nomor_po='$nomorPo'");
    while ($row = $query->fetch_assoc()) {
        $tipe = $row["tipe"];
       
    }
    if($tipe==0){
	$queryUpdateQtyPengerjaan= "UPDATE pengerjaan set qty_akhir_sendiri=(qty_akhir_sendiri+$qtyRevisi) where nomor_po = '$nomorPo'";
    $resultUpdateQtyPengerjaan= mysqli_query($link,$queryUpdateQtyPengerjaan) or die(mysqli_error($link));	
	}else if($tipe=1){
	$queryUpdateQtyPengerjaan= "UPDATE pengerjaan set qty_akhir_makloon=(qty_akhir_makloon+$qtyRevisi) where nomor_po = '$nomorPo'";
    $resultUpdateQtyPengerjaan= mysqli_query($link,$queryUpdateQtyPengerjaan) or die(mysqli_error($link));	
	}else if($tipe=2){
	$queryUpdateQtyPengerjaan= "UPDATE pengerjaan set qty_akhir_sendiri=(qty_akhir_sendiri+$qtyRevisi) where nomor_po = '$nomorPo'";
    $resultUpdateQtyPengerjaan= mysqli_query($link,$queryUpdateQtyPengerjaan) or die(mysqli_error($link));	
	}
	header('Location: ../../view/revisi.php');
	
	
?>