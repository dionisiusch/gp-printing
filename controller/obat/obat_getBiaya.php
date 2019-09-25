<?php
	include('../config/linken.php');

    $obatArray = $_POST["obat"];
    $qtyObatArray = $_POST["qtyObat"];
    $biaya = 0;
    $j=0;

    foreach($obatArray as $obat){
		$queryGetObat = "SELECT id,harga_jual from obat where nama_obat = '$obat'";	
		$resultGetObat = $link->query($queryGetObat);
		while ($row = $resultGetObat->fetch_assoc()) {
            $qtyObat = $qtyObatArray[$j];
            $biaya+=$row["harga_jual"]*$qtyObat;
        }
        $j++;
    }
    
    echo $biaya;

?>