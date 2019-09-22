<?php
include('../config/linken.php');

$id = $_POST["id"];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
$keterangan = $_POST["keterangan"];
$idSample = 0;
$forceDone = $_POST["forceDone"];

if($jenisPengerjaan==0){
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = 0;
    $queryUpdatePengerjaan = "UPDATE pengerjaan set qty_akhir_sendiri=qty_akhir_sendiri+$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon where id='$id'";
}
else if($jenisPengerjaan==1){
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
    $qtyAkhirSendiri = 0;
    $queryUpdatePengerjaan = "UPDATE pengerjaan set qty_akhir_sendiri=$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon where id='$id'";
}else{
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
    $queryUpdatePengerjaan = "UPDATE pengerjaan set qty_akhir_sendiri=$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon where id='$id'";
}

$qtyAkhir = $qtyAkhirMakloon + $qtyAkhirSendiri;
$queryGetQtyAwal = "SELECT qty_awal,nomor_po from pengerjaan WHERE id='$id' LIMIT 1";
$resultGetQtyAwal = mysqli_query($link,$queryGetQtyAwal) or die(mysqli_error($link));

while ($row = $resultGetQtyAwal->fetch_assoc()) {
    $qtyAwal = $row["qty_awal"];
    $nomorPo = $row["nomor_po"];
}

//proses check barang diterima
if($qtyAwal>$qtyAkhir){
    if($forceDone=="1"){
        //update keterangan 
        $queryUpdateKeterangan = "UPDATE pengerjaan set keterangan = '$keterangan',status=1 WHERE id='$id'";
        $resultUpdateKeterangan = mysqli_query($link,$queryUpdateKeterangan) or die(mysqli_error($link));
        
//update status sample to Done production
$query = $link->query("SELECT id_sample from pengerjaan where id='$id'");
while ($row = $query->fetch_assoc()) {
    $idSample = $row["id_sample"];
}
$queryUpdateStatusSample = "UPDATE sample set status=4 where id = '$idSample'";
$resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));


    }   
}else{
    $queryUpdateKeterangan = "UPDATE pengerjaan set status=1 WHERE id='$id'";
    $resultUpdateKeterangan = mysqli_query($link,$queryUpdateKeterangan) or die(mysqli_error($link));
    //update status sample to Done production
    $query = $link->query("SELECT id_sample from pengerjaan where id='$id'");
    while ($row = $query->fetch_assoc()) {
    $idSample = $row["id_sample"];
}
$queryUpdateStatusSample = "UPDATE sample set status=4 where id = '$idSample'";
$resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));

}
//masukin ke gudang
$querySelectGudang =  "SELECT * from gudang where id_pengerjaan = '$id'";
$resultSelectGudang = mysqli_query($link,$querySelectGudang) or die(mysqli_error($link));
$num_row_gudang = mysqli_num_rows($resultSelectGudang);
if($num_row_gudang==0){
    $queryInsertToGudang = "INSERT into gudang (id_pengerjaan,qty_total,qty_sementara,qty_kurang,status) values('$id',$qtyAwal,($qtyAkhirSendiri+$qtyAkhirMakloon),($qtyAkhirSendiri+$qtyAkhirMakloon),0)";
    $resultInsertToGudang = mysqli_query($link,$queryInsertToGudang) or die(mysqli_error($link));
}else{
    $queryUpdateGudang = "UPDATE gudang set qty_sementara = qty_sementara+($qtyAkhirSendiri+$qtyAkhirMakloon),qty_kurang = qty_kurang+($qtyAkhirSendiri+$qtyAkhirMakloon) WHERE id_pengerjaan='$id'";
     $resultUpdateGudang = mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
} 

//masukin ke pengerjaan_gudang
$queryInsertPengerjaanGudang = "INSERT into pengerjaan_gudang (id_pengerjaan,tgl,qty_sendiri,qty_makloon) values('$id',now(),$qtyAkhirSendiri,$qtyAkhirMakloon)";
$resultInsertPengerjaanGudang = mysqli_query($link,$queryInsertPengerjaanGudang) or die(mysqli_error($link));

//update db pengerjaan
$resultUpdatePengerjaan = mysqli_query($link,$queryUpdatePengerjaan) or die(mysqli_error($link));

if(!$resultUpdatePengerjaan){
        echo "<script>alert('Error Update Pengerjaan!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
    header("Location: ../../view/pengerjaan.php"); 
?>