<?php
include('../config/linken.php');

$idSample = $_POST["idSample"];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
$nomorPO = $_POST["nomorPO"];
$tglMulai = date('Y-m-d');
$tglNaikBahan = formatTgl($_POST["tglNaikBahan"]);
$qtyAkhirObatArray = $_POST["qtyAkhirObat"];
$idObatArray = $_POST["idObat"];

function formatTgl($tgl){
	if($tgl!=0||$tgl!=null){
	$tglArray = explode("-",$tgl);
	return $tglArray[2]."-".$tglArray[1]."-".$tglArray[0]; 
	}
	return null;
}

function ReverseRupiah($biaya){
	$biaya = str_replace("Rp. ", "", $biaya);
	$biaya = str_replace(".", "", $biaya);
	$biaya = (int)$biaya;
	return $biaya;
	}

if($jenisPengerjaan==0){
    $tglSelesaiSendiri = formatTgl($_POST["tglSelesaiSendiri"]);
    $qtySendiri = $_POST["qtySendiri"];
    $tglSelesaiMakloon = null;
    $qtyMakloon = 0;  
    $jumlahOrang = $_POST["jumlahOrang"];  
    $jamKerja = $_POST["jamKerja"];
    $meja = $_POST["meja"];
    $biayaMakloon = 0;
    $queryInsertPengerjaan = "INSERT INTO pengerjaan (id_sample,tipe,tgl_mulai,tgl_selesai_sendiri,qty_sendiri,qty_makloon,qty_awal,status,jumlah_orang,jam_kerja,meja,biaya_makloon,nomor_po,tgl_naik_barang) values($idSample,$jenisPengerjaan,'$tglMulai','$tglSelesaiSendiri',$qtySendiri,$qtyMakloon,($qtyMakloon+$qtySendiri),0,$jumlahOrang,$jamKerja,$meja,$biayaMakloon,'$nomorPO','$tglNaikBahan')";
}
if($jenisPengerjaan==1){
    $tglSelesaiSendiri = NULL;
    $qtySendiri = 0;
    $tglSelesaiMakloon = formatTgl($_POST["tglSelesaiMakloon"]);
    $qtyMakloon = $_POST["qtyMakloon"];
    $biayaMakloon = ReverseRupiah($_POST["biayaMakloon"]);
    $jumlahOrang = 0;  
    $jamKerja = 0;
    $meja = 0;
    $queryInsertPengerjaan = "INSERT INTO pengerjaan (id_sample,tipe,tgl_mulai,qty_sendiri,tgl_selesai_makloon,qty_makloon,qty_awal,status,jumlah_orang,jam_kerja,meja,biaya_makloon,nomor_po,tgl_naik_barang) values($idSample,$jenisPengerjaan,'$tglMulai',$qtySendiri,'$tglSelesaiMakloon',$qtyMakloon,($qtyMakloon+$qtySendiri),0,$jumlahOrang,$jamKerja,$meja,$biayaMakloon,'$nomorPO','$tglNaikBahan')";
}
if($jenisPengerjaan==2){
    $tglSelesaiSendiri = formatTgl($_POST["tglSelesaiSendiri"]);
    $qtySendiri = $_POST["qtySendiri"];
    $tglSelesaiMakloon = formatTgl($_POST["tglSelesaiMakloon"]);
    $qtyMakloon = $_POST["qtyMakloon"];
    $jumlahOrang = $_POST["jumlahOrang"];  
    $jamKerja = $_POST["jamKerja"];
    $meja = $_POST["meja"];
    $biayaMakloon = ReverseRupiah($_POST["biayaMakloon"]);
    $queryInsertPengerjaan = "INSERT INTO pengerjaan (id_sample,tipe,tgl_mulai,tgl_selesai_sendiri,qty_sendiri,tgl_selesai_makloon,qty_makloon,qty_awal,status,jumlah_orang,jam_kerja,meja,biaya_makloon,nomor_po,tgl_naik_barang) values($idSample,$jenisPengerjaan,'$tglMulai','$tglSelesaiSendiri',$qtySendiri,'$tglSelesaiMakloon',$qtyMakloon,($qtyMakloon+$qtySendiri),0,$jumlahOrang,$jamKerja,$meja,$biayaMakloon,'$nomorPO','$tglNaikBahan')";


}

//cek qty obat
$k =1;
$error = false;
$obatErr ='';
$multiquery ='';
foreach($idObatArray as $idObat){
    $queryGetDetailObat = "SELECT * from obat where id = '$idObat'";	
    $resultGetDetailObat = $link->query($queryGetDetailObat);
    while ($row = $resultGetDetailObat->fetch_assoc()) {
        if(($row["kilo"]*1000)<$qtyAkhirObatArray[$k]){
            $error = true;
            $obatErr .= $row['nama_obat'].",";
            echo $gram = $qtyAkhirObatArray[$k]/1000;
        }else{
           echo $gram = $qtyAkhirObatArray[$k]/1000;
            $multiquery.= "UPDATE obat set kilo=kilo-$gram where id=$idObat";
        }
        $k++;
    }
}
if($error==true){
    echo '<script> if (confirm("Stock '.$obatErr.' ,tidak Cukup!") == true) {
        window.location.replace("../../view/sample.php");
    } else {
        window.location.replace("../../view/sample.php");
    }</script>';    
}else{
    $query = $link->query("UPDATE sample set status=1,tgl_naik_bahan = '$tglNaikBahan' where id='$idSample'");
    mysqli_multi_query($link,$multiquery);

//insert db pengerjaan
$resultInsertPengerjaan = mysqli_query($link,$queryInsertPengerjaan) or die(mysqli_error($link));
if(!$resultInsertPengerjaan){
        echo "<script>alert('Error Insert Pengerjaan!');
            window.location.replace('../../view/sample.php');
        ";
    }

// update status sample to production
$query = $link->query("UPDATE sample set status='3' where id='$idSample'");


    header("Location: ../../view/pengerjaan.php");
}
?>