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
//    $idPengerjaan = $row['id_pengerjaan'];
//    
//    $queryGetStatusPengerjaan = "SELECT id from pengerjaan WHERE id=$idPengerjaan AND status=1";
//    $resultGetStatusPengerjaan= mysqli_query($link,$queryGetStatusPengerjaan) or die(mysqli_error($link));
//    $countStatusPengerjaan =  mysqli_num_rows($resultGetStatusPengerjaan);
//    
//    $queryGetStatusRevisi = "SELECT id_pengerjaan from revisi WHERE id_pengerjaan=$idPengerjaan AND status=2";
//    $resultGetStatusRevisi= mysqli_query($link,$queryGetStatusRevisi) or die(mysqli_error($link));
//    $countStatusRevisi =  mysqli_num_rows($resultGetStatusRevisi);
//    echo $countStatusPengerjaan;
//    echo $countStatusRevisi;  
//    if($countStatusPengerjaan!=0 && $countStatusRevisi==null){
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
//    }else{
//                echo "<script>alert('STATUS pengerjaan atau revisi harus Done!');
//            </script>";
//    }
}
?>