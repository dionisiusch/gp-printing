<?php
include('../config/linken.php');

$id = $_POST["id"];
$qtyAkhir = $_POST["qtyAkhir"];
$forceDone = $_POST["forceDone"];
$keterangan = $_POST["keterangan"];
$currentDateTime = date('Y-m-d');
$query = $link->query("SELECT id_pengerjaan,id_sample,qty_awal from revisi where id='$id'");
while ($row1 = $query->fetch_assoc()) {
    $idPengerjaan = $row1["id_pengerjaan"];
    $idSample = $row1["id_sample"];
    $qtyAwal = $row1["qty_awal"];
}
$queryGetQtyAwal = "SELECT qty_awal from pengerjaan WHERE id='$idPengerjaan' LIMIT 1";
$resultGetQtyAwal = mysqli_query($link,$queryGetQtyAwal) or die(mysqli_error($link));
while ($row = $resultGetQtyAwal->fetch_assoc()) {
    $qtyAwalPengerjaan = $row["qty_awal"];
}
$tenpersen = ceil($qtyAwal*0.1);

$qtySisa=$qtyAwal-$qtyAkhir;
if($qtyAwalPengerjaan<=$qtyAkhir){
    $queryGetGudang = "SELECT id_pengerjaan from gudang WHERE id='$id' LIMIT 1";
    $resultGetGudang = mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));
    $countrow =  mysqli_num_rows($resultGetGudang);

    $queryInsertToGudang = "INSERT INTO revisi_to_gudang(id_revisi,qty_naik,tgl_naik) SELECT id_pengerjaan,$qtyAkhir,'$currentDateTime' FROM revisi where id='$id'";
    $resulInsertToGudang= mysqli_query($link,$queryInsertToGudang) or die(mysqli_error($link));
    if($countrow>0){
        $queryUpdateGudang = "UPDATE gudang SET qty_sementara=qty_sementara+$qtyAkhir where id_pengerjaan=$idPengerjaan";
        $resulUpdateGudang= mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
    }else{
        $queryInsertGudang = "INSERT INTO gudang(id_pengerjaan,nomor_po,qty_total,qty_sementara) SELECT id_pengerjaan,nomor_po,$qtyAwalPengerjaan,$qtyAkhir FROM revisi where id='$id'";
        $resulInsertGudang= mysqli_query($link,$queryInsertGudang) or die(mysqli_error($link));    
    } 
    //update db revisi
    $queryUpdateRevisi = "UPDATE revisi set status=2,qty_akhir=$qtyAkhir where id='$id'";
    $resultUpdateRevisi = mysqli_query($link,$queryUpdateRevisi) or die(mysqli_error($link));
    if(!$resultUpdateRevisi){
            echo "<script>alert('Error Update Revisi!');
                window.location.replace('../../view/sample.php');
            </script>";
        }

    //update status Pengerjaan to done

    $queryUpdateStatusSample = "UPDATE pengerjaan set status=1 where id = '$idPengerjaan'";
    $resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));

    //update all revisi db status   
    $queryAllUpdateRevisi = "UPDATE revisi set status=1 where id_sample=$idSample && id_pengerjaan=$idPengerjaan";
    $resultAllUpdateRevisi = mysqli_query($link,$queryAllUpdateRevisi) or die(mysqli_error($link));
    
        header("Location: ../../view/revisi.php");
}else if($forceDone=="1"){
    $queryGetGudang = "SELECT id_pengerjaan from gudang WHERE id='$id' LIMIT 1";
    $resultGetGudang = mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));
    $countrow =  mysqli_num_rows($resultGetGudang);

    $queryInsertToGudang = "INSERT INTO revisi_to_gudang(id_revisi,qty_naik,tgl_naik) SELECT id_pengerjaan,$qtyAkhir,'$currentDateTime' FROM revisi where id='$id'";
    $resulInsertToGudang= mysqli_query($link,$queryInsertToGudang) or die(mysqli_error($link));
    if($countrow>0){
        $queryUpdateGudang = "UPDATE gudang SET qty_sementara=qty_sementara+$qtyAkhir where id_pengerjaan=$idPengerjaan";
        $resulUpdateGudang= mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
    }else{
        $queryInsertGudang = "INSERT INTO gudang(id_pengerjaan,nomor_po,qty_total,qty_sementara) SELECT id_pengerjaan,nomor_po,$qtyAwalPengerjaan,$qtyAkhir FROM revisi where id='$id'";
        $resulInsertGudang= mysqli_query($link,$queryInsertGudang) or die(mysqli_error($link));    
    } 
    //update db revisi
    $queryUpdateRevisi = "UPDATE revisi set status=2,qty_akhir=$qtyAkhir,keterangan='$keterangan' where id='$id'";
    $resultUpdateRevisi = mysqli_query($link,$queryUpdateRevisi) or die(mysqli_error($link));
    if(!$resultUpdateRevisi){
            echo "<script>alert('Error Update Revisi!');
                window.location.replace('../../view/sample.php');
            </script>";
        }

    //update status Pengerjaan to done

    $queryUpdateStatusSample = "UPDATE pengerjaan set status=1 where id = '$idPengerjaan'";
    $resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));

    //update all revisi db status   
    $queryAllUpdateRevisi = "UPDATE revisi set status=1 where id_sample=$idSample && id_pengerjaan=$idPengerjaan";
    $resultAllUpdateRevisi = mysqli_query($link,$queryAllUpdateRevisi) or die(mysqli_error($link));
    
        header("Location: ../../view/revisi.php");
}else{
  
$queryInsertToGudang = "INSERT INTO revisi_to_gudang(id_revisi,qty_naik,tgl_naik) SELECT id_pengerjaan,$qtyAkhir,'$currentDateTime' FROM revisi where id='$id'";
$resulInsertToGudang= mysqli_query($link,$queryInsertToGudang) or die(mysqli_error($link));
$queryGetGudang = "SELECT * from gudang WHERE id_pengerjaan='$idPengerjaan'";    
$resultGetGudang = mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));
$countrow =  mysqli_num_rows($resultGetGudang);
 echo ($countrow);   
if($countrow>0){
    $queryUpdateGudang = "UPDATE gudang SET qty_sementara=qty_sementara+$qtyAkhir where id_pengerjaan=$idPengerjaan";
    $resulUpdateGudang= mysqli_query($link,$queryUpdateGudang) or die(mysqli_error($link));
}else{
    $queryInsertGudang = "INSERT INTO gudang(id_pengerjaan,qty_total,qty_sementara) SELECT id_pengerjaan,$qtyAwalPengerjaan,$qtyAkhir FROM revisi where id='$id'";
    $resulInsertGudang= mysqli_query($link,$queryInsertGudang) or die(mysqli_error($link));    
}       
 
//update db revisi
$queryUpdateRevisi = "UPDATE revisi set status=1,qty_akhir=$qtyAkhir,keterangan='$keterangan' where id='$id'";
$resultUpdateRevisi = mysqli_query($link,$queryUpdateRevisi) or die(mysqli_error($link));
if(!$resultUpdateRevisi){
        echo "<script>alert('Error Update Revisi!');
            window.location.replace('../../view/sample.php');
        </script>";
    }
    
//update status Pengerjaan to done

$queryUpdateStatusSample = "UPDATE pengerjaan set status=0 where id = '$idPengerjaan'";
$resultUpdateStatusSample = mysqli_query($link,$queryUpdateStatusSample) or die(mysqli_error($link));
    
    header("Location: ../../view/revisi.php");
}
?>