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
    $queryUpdatePengerjaan = "UPDATE pengerjaan set status=1,qty_akhir_sendiri=$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon where id='$id'";
}else{
    $qtyAkhirSendiri = $_POST["qtyAkhirSendiri"];
    $qtyAkhirMakloon = $_POST["qtyAkhirMakloon"];
    $queryUpdatePengerjaan = "UPDATE pengerjaan set status=1,qty_akhir_sendiri=$qtyAkhirSendiri,qty_akhir_makloon=$qtyAkhirMakloon where id='$id'";
}

$qtyAkhir = $qtyAkhirMakloon + $qtyAkhirSendiri;
$queryGetQtyAwal = "SELECT qty_awal from pengerjaan WHERE id='$id' LIMIT 1";
$resultGetQtyAwal = mysqli_query($link,$queryGetQtyAwal) or die(mysqli_error($link));

while ($row = $resultGetQtyAwal->fetch_assoc()) {
    $qtyAwal = $row["qty_awal"];
}
// $tenpersen = ceil($qtyAwal*0.1);
//proses check barang diterima
if($qtyAwal>$qtyAkhir){
    if($forceDone=="1"){
        //forcedone
    }else{
       //masukin ke gudang
    }
}else{
    //done
    //masukin ke gudang
}
 
//update db pengerjaan
// $resultUpdatePengerjaan = mysqli_query($link,$queryUpdatePengerjaan) or die(mysqli_error($link));

// if(!$resultUpdatePengerjaan){
//         echo "<script>alert('Error Update Pengerjaan!');
//             window.location.replace('../../view/sample.php');
//         </script>";
//     }

//update status pengerjaan to done
// $query = $link->query("SELECT id_sample from pengerjaan where id='$id'");
// while ($row = $query->fetch_assoc()) {
//     $idSample = $row["id_sample"];
// }
// $queryUpdateStatusSample = "UPDATE sample set status=2 where id = '$idSample'";
// $resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));
//     header("Location: ../../view/pengerjaan.php"); 

?>