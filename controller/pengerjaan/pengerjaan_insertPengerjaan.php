<?php
include('../config/linken.php');

$idSample = $_POST["idSample"];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
$tglMulai = date('Y-m-d');
if($_POST["tglSelesaiMakloon"]==NULL && $_POST["qtyMakloon"]==NULL){
    $tglSelesaiSendiri = $_POST["tglSelesaiSendiri"];
    $qtySendiri = $_POST["qtySendiri"];
    $tglSelesaiMakloon = null;
    $qtyMakloon = 0;    
}
if($_POST["tglSelesaiSendiri"]==NULL && $_POST["qtySendiri"]==NULL){
    $tglSelesaiSendiri = NULL;
    $qtySendiri = 0;
    $tglSelesaiMakloon = $_POST["tglSelesaiMakloon"];
    $qtyMakloon = $_POST["qtyMakloon"];
}
//insert db pengerjaan
$queryInsertPengerjaan = "INSERT INTO pengerjaan (id_sample,tipe,tgl_mulai,tgl_selesai_sendiri,qty_sendiri,tgl_selesai_makloon,qty_makloon,qty_awal,status) values($idSample,$jenisPengerjaan,'$tglMulai','$tglSelesaiSendiri',$qtySendiri,'$tglSelesaiMakloon',$qtyMakloon,20,0)";
$resultInsertPengerjaan = mysqli_query($link,$queryInsertPengerjaan) or die(mysqli_error($link));
if(!$resultInsertPengerjaan){
        echo "<script>alert('Error Insert Pengerjaan!');
            window.location.replace('../../view/sample.php');
        ";
    }

//update status sample to on-going

$query = $link->query("UPDATE sample set status='1' where id='$idSample'");


    header("Location: ../../view/pengerjaan.php");
?>