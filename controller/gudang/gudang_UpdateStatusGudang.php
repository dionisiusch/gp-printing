<?php
include('../config/linken.php');

$id = $_POST["id"];
$qty = $_POST["qtyAmbil"];
$tgl = $_POST["tgl"];
$tgl = date("Y-m-d",strtotime($tgl));
$hargaJual = $_POST["hargaJual"];
$keterangan = $_POST["keterangan"];

$queryGetGudang = "SELECT id_pengerjaan from gudang WHERE id=$id";
$resultGetGudang= mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));

while ($row = $resultGetGudang->fetch_assoc()) {
    $idPengerjaan = $row['id_pengerjaan'];
    
    $queryGetStatusPengerjaan = "SELECT id from pengerjaan WHERE id=$idPengerjaan AND status=1";
    $resultGetStatusPengerjaan= mysqli_query($link,$queryGetStatusPengerjaan) or die(mysqli_error($link));
    $countStatusPengerjaan =  mysqli_num_rows($resultGetStatusPengerjaan);
    
    $queryGetStatusRevisi = "SELECT id_pengerjaan from revisi WHERE id_pengerjaan=$idPengerjaan AND status=2";
    $resultGetStatusRevisi= mysqli_query($link,$queryGetStatusRevisi) or die(mysqli_error($link));
    $countStatusRevisi =  mysqli_num_rows($resultGetStatusRevisi);
    echo $countStatusPengerjaan;
    echo $countStatusRevisi;  
    if($countStatusPengerjaan!=0 && $countStatusRevisi==null){
        $queryInsertDetailGudang = "INSERT INTO (id_gudang,qty_pengambilan,tgl_pengambilan) VALUES ($id,$qty,'$tgl')";
        $resultInsertDetailGudang= mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));

        $queryUpdateGudang = "UPDATE gudang set status=1,tgl_pengambilan='$tgl',keterangan='$keterangan' where id='$id'";
        $resultUpdateGudang = mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
        header("Location: ../../view/gudang.php"); 
    }else{
                echo "<script>alert('STATUS pengerjaan atau revisi harus Done!');
            </script>";
    }
}
?>