<?php
	include('../config/linken.php');

	
    $nomorPo=$_POST["InputRevisi"];
    $qtyRevisi=$_POST["qtyRevisi"];
	$tglrevisiRevisi = $_POST["tglrevisiRevisi"];
    $tglDeadline = $_POST["tglDeadlineRevisi"];
    
	
	//insert db sample
	$queryInsertRevisi = "INSERT INTO revisi (id_sample,id_pengerjaan,nomor_po,tipe,tgl_mulai,tgl_deadline,status,qty_awal) 
    SELECT id_sample,id_pengerjaan,nomor_po,tipe,'$tglrevisiRevisi','$tglDeadline',1,$qtyRevisi FROM revisi where nomor_po='$nomorPo' ";
	$resultInsertRevisi = mysqli_query($link,$queryInsertRevisi) or die(mysqli_error($link));

	if(!$resultInsertRevisi){
			echo "<script>alert('Error Insert Perbaikan!');
				window.location.replace('../../view/revisi.php');
			";
		}
//    $query = $link->query("SELECT tipe from pengerjaan where nomor_po='$nomorPo'");
//    while ($row = $query->fetch_assoc()) {
//        $tipe = $row["tipe"];
//       
//    }
//    if($tipe==0){
//	$queryUpdateQtyPengerjaan= "UPDATE pengerjaan set qty_akhir_sendiri=(qty_akhir_sendiri+$qtyRevisi) where nomor_po = '$nomorPo'";
//    $resultUpdateQtyPengerjaan= mysqli_query($link,$queryUpdateQtyPengerjaan) or die(mysqli_error($link));	
//	}else if($tipe=1){
//	$queryUpdateQtyPengerjaan= "UPDATE pengerjaan set qty_akhir_makloon=(qty_akhir_makloon+$qtyRevisi) where nomor_po = '$nomorPo'";
//    $resultUpdateQtyPengerjaan= mysqli_query($link,$queryUpdateQtyPengerjaan) or die(mysqli_error($link));	
//	}else if($tipe=2){
//	$queryUpdateQtyPengerjaan= "UPDATE pengerjaan set qty_akhir_sendiri=(qty_akhir_sendiri+$qtyRevisi) where nomor_po = '$nomorPo'";
//    $resultUpdateQtyPengerjaan= mysqli_query($link,$queryUpdateQtyPengerjaan) or die(mysqli_error($link));	
//	}
	header('Location: ../../view/revisi.php');
	
	
?>