<?php
include('../config/linken.php');

$id = $_POST["id"];
$qty = $_POST["qtyAmbil"];
$tgl = $_POST["tgl"];
$tgl = date("Y-m-d",strtotime($tgl));
    $hargaJualSample =$_POST['hargaJual'];
    $hargaTotalJual = $_POST["hargaTotalJual"];
    $hargaTotalJual =str_replace(".","",$hargaTotalJual);
    $hargaTotalJual =str_replace("Rp ","", $hargaTotalJual);
    $hargaTotalJual = round($hargaTotalJual, 0);
$keterangan = $_POST["keterangan"];

$queryGetGudang = "SELECT id_pengerjaan,qty_kurang from gudang WHERE id=$id";
$resultGetGudang= mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));

while ($row = $resultGetGudang->fetch_assoc()) {
    if($row['qty_kurang']<$qty){
        echo "<script>alert('Stock gudang tidak mencukupi!');window.location.replace('../../view/gudang.php');</script>";
    }else{
        $queryInsertDetailGudang = "INSERT INTO  gudang_detail(id_gudang,qty_pengambilan,tgl_pengambilan,total_harga) VALUES ($id,$qty,'$tgl',$hargaTotalJual)";
        $resultInsertDetailGudang= mysqli_query($link,$queryInsertDetailGudang) or die(mysqli_error($link));
        if(($row['qty_kurang']-$qty)<=0){
        $queryUpdateGudang = "UPDATE gudang set status=1,tgl_pengambilan='$tgl',keterangan='$keterangan',qty_kurang=(qty_kurang-$qty) where id='$id'";
        $resultUpdateGudang = mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
            echo $row['qty_kurang'];
        }else{
        $queryUpdateGudang = "UPDATE gudang set status=0,tgl_pengambilan='$tgl',keterangan='$keterangan',qty_kurang=(qty_kurang-$qty) where id='$id'";
        $resultUpdateGudang = mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));            
        }
            header("Location: ../../view/gudang.php");
    }
   }
?>