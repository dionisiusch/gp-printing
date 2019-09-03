<?php
include('../config/linken.php');

$id = $_POST["id"];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
if($jenisPengerjaan==0){
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = 0;
}
if($jenisPengerjaan==1){
    $qtyAkhirSendiri = 0;
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
}
if($jenisPengerjaan==2){
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
}
$keterangan = $_POST["keterangan"];
$idSample = 0;

$queryGetQtyAwal = "SELECT qty_awal from pengerjaan WHERE id='$id' LIMIT 1";
$resultGetQtyAwal = mysqli_query($link,$queryGetQtyAwal) or die(mysqli_error($link));

while ($rowQty = $resultGetQtyAwal->fetch_assoc()) {
    $qtyAwal = $rowQty["qty_awal"];
}
$qtyAkhir= $qtyAkhirSendiri+$qtyAkhirMakloon; 
$tenpersen = floor($qtyAwal*0.1);
$ninepersen = $qtyAwal -$tenpersen;
$qtySisa=$qtyAwal-$qtyAkhir;

if($qtyAkhir<=$ninepersen){
    //insert db to revisi
    $queryInsertRevisi = "INSERT INTO revisi(id_sample,id_pengerjaan,tipe,qty_awal) SELECT id_sample,id,tipe,$qtySisa FROM pengerjaan where id='$id'";
    $resulInsertRevisi= mysqli_query($link,$queryInsertRevisi) or die(mysqli_error($link));
    //update db ke revisi
    $queryUpdatePengerjaanRevisi = "UPDATE pengerjaan set status=2,qty_akhir_sendiri=$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon,keterangan='$keterangan' where id='$id'";
    $resultUpdatePengerjaanRevisi = mysqli_query($link,$queryUpdatePengerjaanRevisi) or die(mysqli_error($link));
    if(!$resultUpdatePengerjaanRevisi){
        echo "<script>alert('Error Update Pengerjaan!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
        header("Location: ../../view/revisi.php"); 
    
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