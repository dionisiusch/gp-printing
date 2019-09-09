<?php
include('../config/linken.php');

$id = $_POST["id"];
$tgl = $_POST["tgl"];
$tgl = date("Y-m-d",strtotime($tgl));
$keterangan = $_POST["keterangan"];

$queryGetGudang = "SELECT qty_total,qty_sementara from gudang WHERE id=$id";
$resultGetGudang= mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));

while ($row = $resultGetGudang->fetch_assoc()) {
    if($row['qty_total']>$row['qty_sementara']){
         echo "<script>alert('Qty Total harus mencukupi untuk diambil!');
                window.location.replace('../../view/gudang.php');
            ";
    }else{
        $queryUpdateGudang = "UPDATE gudang set status=1,tgl_pengambilan='$tgl',keterangan='$keterangan' where id='$id'";
        $resultUpdateGudang = mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
        header("Location: ../../view/gudang.php"); 
    }
}
?>