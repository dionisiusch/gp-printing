<?php
include('../config/linken.php');
$tglNaikBahan = $_POST["tglNaikBahan"];
$id = $_POST["idSample"];
$multiquery = '';
//cek stock + kurangin
$queryGetDetailObat = "SELECT sample_obat.id_obat,sample_obat.qty,obat.kilo,obat.nama_obat from sample_obat join obat on sample_obat.id_obat = obat.id where sample_obat.id_sample = '$id'";	
$resultGetDetailObat = $link->query($queryGetDetailObat);
$error = false;
$obatErr ='';
while ($row = $resultGetDetailObat->fetch_assoc()) {
    if(($row["kilo"]*1000)<$row["qty"]){
        $error = true;
        $obatErr .= $row['nama_obat'].",";
    }else{
        $gram = $row['qty']/1000;
        $id_obat = $row['id_obat'];
        $multiquery.= "UPDATE obat set kilo=kilo-$gram where id=$id_obat";
    }
}
if($error==false){
    $query = $link->query("UPDATE sample set status=1,tgl_naik_bahan = '$tglNaikBahan' where id='$id'");
    mysqli_multi_query($link,$multiquery);
    header("Location: ../../view/sample.php"); 
}else{
    echo '<script> if (confirm("Stock '.$obatErr.' ,tidak Cukup!") == true) {
        window.location.replace("../../view/sample.php");
    } else {
        window.location.replace("../../view/sample.php");
    }</script>';    
}

?>