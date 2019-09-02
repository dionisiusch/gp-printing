<?php
include('../config/linken.php');

$id = $_POST["id"];
$qtyAkhir = $_POST["qtyAkhir"];
$keterangan = $_POST["keterangan"];
echo "<script>alert($tenpersen);<script>";
$idSample = 0;
$selectQtyAwal = "SELECT qty_awal from pengerjaan WHERE id='$id' LIMIT 1";
$resultQtyAwal = mysqli_query($link,$selectQtyAwal) or die(mysqli_error($link));
while ($rowQty = $resultQtyAwal->fetch_assoc()) {
    $qtyAwal = $row["qty_awal"];
}
$tenpersen = ceil($qtyAwal*0.1);
echo "<script>alert('$tenpersen');<script>";
//update db pengerjaan
$queryUpdatePengerjaan = "UPDATE pengerjaan set status=1,qty_akhir=$qtyAkhir,keterangan='$keterangan' where id='$id'";
$resultUpdatePengerjaan = mysqli_query($link,$queryUpdatePengerjaan) or die(mysqli_error($link));
if(!$resultUpdatePengerjaan){
        echo "<script>alert('Error Update Pengerjaan!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
if($qtyAkhir<$tenpersen){
    $queryrevisi = "INSERT INTO revisi(id_sample,id_pengerjaan,tipe,qty_awal) SELECT id_sample,id,tipe,qty_awal FROM pengerjaan where id='$id'";
    $resultrevisi= mysqli_query($link,$queryrevisi) or die(mysqli_error($link));   
}
//update status pengerjaan to done
$query = $link->query("SELECT id_sample from pengerjaan where id='$id'");
while ($row = $query->fetch_assoc()) {
    $idSample = $row["id_sample"];
}
$queryUpdateStatusSample = "UPDATE sample set status=2 where id = '$idSample'";
$resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));
    header("Location: ../../view/pengerjaan.php");
?>