<?php
include('../config/linken.php');

$id = $_POST["id"];
$qtyAkhir = $_POST["qtyAkhir"];
$keterangan = $_POST["keterangan"];
$idRevisi = 0;
$queryGetQtyAwal = "SELECT qty_awal from revisi WHERE id='$id' LIMIT 1";
$resultGetQtyAwal = mysqli_query($link,$queryGetQtyAwal) or die(mysqli_error($link));
while ($row = $resultGetQtyAwal->fetch_assoc()) {
    $qtyAwal = $row["qty_awal"];
}
$tenpersen = ceil($qtyAwal*0.1);
$qtySisa=$qtyAwal-$qtyAkhir;
if($qtySisa>$tenpersen){
    $queryInsertRevisi = "INSERT INTO revisi(id_sample,id_pengerjaan,tipe,qty_awal) SELECT id_sample,id,tipe,$qtySisa FROM revisi where id='$id'";
    $resulInsertRevisi= mysqli_query($link,$queryInsertRevisi) or die(mysqli_error($link));
    $queryUpdatePengerjaanRevisi = "UPDATE revisi set status=3,qty_akhir=$qtyAkhir,keterangan='$keterangan' where id='$id'";
    $resultUpdatePengerjaanRevisi = mysqli_query($link,$queryUpdatePengerjaanRevisi) or die(mysqli_error($link));
    if(!$resultUpdatePengerjaanRevisi){
        echo "<script>alert('Error Update Pengerjaan!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
        header("Location: ../../view/pengerjaan.php");
}else{

//update db revisi
$queryUpdateRevisi = "UPDATE revisi set status=2,qty_akhir=$qtyAkhir,keterangan='$keterangan' where id='$id'";
$resultUpdateRevisi = mysqli_query($link,$queryUpdateRevisi) or die(mysqli_error($link));
if(!$resultUpdateRevisi){
        echo "<script>alert('Error Update Revisi!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
    
//update status Pengerjaan to done
$query = $link->query("SELECT id_pengerjaan,id_sample from revisi where id='$id'");
while ($row1 = $query->fetch_assoc()) {
    $idPengerjaan = $row1["id_pengerjaan"];
    $idSample = $row1["id_sample"];
}
$queryUpdateStatusSample = "UPDATE pengerjaan set status=1 where id = '$idPengerjaan'";
$resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));
    
//update all revisi db status   
$queryAllUpdateRevisi = "UPDATE revisi set status=2 where id_sample=$idSample && id_pengerjaan=$idPengerjaan";
$resultAllUpdateRevisi = mysqli_query($link,$queryAllUpdateRevisi) or die(mysqli_error($link));
    header("Location: ../../view/pengerjaan.php");
}
?>