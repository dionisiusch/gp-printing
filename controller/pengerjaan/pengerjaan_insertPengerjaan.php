<?php
include('../config/linken.php');

$idSample = $_POST["idSample"];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
$tglMulai = date('Y-m-d');
$tglSelesai = $_POST["tglSelesai"];
$qty = $_POST["qty"];

//insert db pengerjaan
$queryInsertPengerjaan = "INSERT INTO pengerjaan (id_sample,tipe,tgl_mulai,tgl_selesai,qty_awal,status) values($idSample,$jenisPengerjaan,'$tglMulai','$tglSelesai',$qty,0)";
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