<?php
include('../config/linken.php');

$idRevisi = $_POST["idSample"];
$tglMulai = date('Y-m-d');
$tglSelesai = $_POST['tglSelesai'];
$qty = $_POST['qty'];

$queryInsertPengerjaan = "UPDATE revisi SET tgl_mulai='$tglMulai',tgl_selesai='$tglSelesai',qty_akhir=$qty,status=0 WHERE id=$idRevisi";
$resultInsertPengerjaan = mysqli_query($link,$queryInsertPengerjaan) or die(mysqli_error($link));
if(!$resultInsertPengerjaan){
        echo "<script>alert('Error Insert Pengerjaan!');
            window.location.replace('../../view/Pengerjaan.php');
        ";
    }

//update status sample to on-going

$query = $link->query("UPDATE revisi set status='1' where id='$idRevisi'");
$queryGetIdPengerjaan = "SELECT id_pengerjaan from revisi WHERE id='$idRevisi' LIMIT 1";
$resultGetIdPengerjaan = mysqli_query($link,$queryGetIdPengerjaan) or die(mysqli_error($link));
while ($row = $resultGetIdPengerjaan->fetch_assoc()) {
    $idPengerjaan = $row["id_pengerjaan"];
}    
$queryStatusPengerjaan = $link->query("UPDATE pengerjaan SET status='2' where id='$idPengerjaan'");

    header("Location: ../../view/revisi.php");
?>