<?php
include('../config/linken.php');

$id = $_POST["id"];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
$keterangan = $_POST["keterangan"];
$idSample = 0;

if($jenisPengerjaan==0){
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = 0;
}
else if($jenisPengerjaan==1){
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
    $qtyAkhirSendiri = 0;
}else{
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
}

$qtyAkhir = $qtyAkhirMakloon + $qtyAkhirSendiri;
$queryGetQtyAwal = "SELECT qty_awal from pengerjaan WHERE id='$id' LIMIT 1";
$resultGetQtyAwal = mysqli_query($link,$queryGetQtyAwal) or die(mysqli_error($link));

while ($row = $resultGetQtyAwal->fetch_assoc()) {
    $qtyAwal = $row["qty_awal"];
}
$tenpersen = ceil($qtyAwal*0.1);
$qtySisa = $qtyAwal-$qtyAkhir;
$thresholdRevisi = $qtyAwal-$tenpersen;
 
if($qtyAkhir<$thresholdRevisi){
    //insert db to revisi
    $queryInsertRevisi = "INSERT INTO revisi(id_sample,id_pengerjaan,tipe,qty_awal) SELECT id_sample,id,tipe,$qtySisa FROM pengerjaan where id='$id'";
    $resulInsertRevisi= mysqli_query($link,$queryInsertRevisi) or die(mysqli_error($link));
    //update db ke revisi
    $queryUpdateRevisi = "UPDATE revisi set status=2,qty_akhir=$qtyAkhir,keterangan='$keterangan' where id='$id'";
    $resultUpdatePengerjaanRevisi = mysqli_query($link,$queryUpdateRevisi) or die(mysqli_error($link));
    if(!$resultUpdatePengerjaanRevisi){
        echo "<script>alert('Error Update Pengerjaan!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
    header("Location: ../../view/pengerjaan.php");
    
}else{
//update db pengerjaan
$queryUpdatePengerjaan = "UPDATE pengerjaan set status=1,qty_akhir_sendiri=$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon,keterangan='$keterangan' where id='$id'";
$resultUpdatePengerjaan = mysqli_query($link,$queryUpdatePengerjaan) or die(mysqli_error($link));

if(!$resultUpdatePengerjaan){
        echo "<script>alert('Error Update Pengerjaan!');
            window.location.replace('../../view/sample.php');
        </script>";
    }

//update status pengerjaan to done
$query = $link->query("SELECT id_sample from pengerjaan where id='$id'");
while ($row = $query->fetch_assoc()) {
    $idSample = $row["id_sample"];
}
$queryUpdateStatusSample = "UPDATE sample set status=2 where id = '$idSample'";
$resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));
    header("Location: ../../view/pengerjaan.php"); 
}
?>