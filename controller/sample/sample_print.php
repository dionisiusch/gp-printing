<?php
	include('../config/linken.php');
	include('../config/asset.php');
    $tanggalAwal = $_POST["tglAwal"];
    $tanggalAkhir = $_POST["tglAkhir"];
    $queryGetAllSample = "SELECT * FROM sample Where tgl BETWEEN '$tanggalAwal' AND '$tanggalAkhir'";
	$resultGetAllSample = mysqli_query($link,$queryGetAllSample) or die(mysqli_error($link));

    function kilo($angka){
	
	$hasil_Kg = number_format($angka,2,',','.') ."Kg ";
	return $hasil_Kg;
 
    }
    function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
    }
	if(!$resultGetAllSample){
			echo "<script>alert('Error Insert Obat!');
				window.location.replace('../../view/obat.php');
			";
		}
    ?>
    <h1>DAFTAR DATA SAMPLE PER TANGGAL</h1>
<?php
//    $queryGetDate = "SELECT * FROM obat Where tgl = ";
//	$resultGetDate = mysqli_query($link,$queryDate) or die(mysqli_error($link));
//    while($row =$resultGetAllSample->fetch_assoc()){
?>
    <table border="1" width="100%" align="center">
 
    <?php
    $i=0;
    $currentDate = false;    
    while($row =$resultGetAllSample->fetch_assoc()){
        $i++;
        if ($row['tgl'] != $currentDate){
        ?>
        
        <table border="1" width="100%" align="center">
            <tr>
        <th align="center">ID</th><th>Nomor PO</th><th>Nama</th><th>Tgl Mulai</th><th>Tanggal Selesai</th><th>Biaya</th>
        </tr>    
    
        Tanggal : <?php echo $row['tgl']?></td>    
   
      <?php $currentDate = $row['tgl'];
            }
        ?>
    <tr>
        <td align="center" width="2%"><?php echo $i?></td>
        <td align="center" width="10%"><?php echo $row['nomor_po']?></td>
                <td align="center" width="20%"><?php echo $row['artikel']?></td>   
                <td align="center"  width="20%"><?php echo $row['tgl']?></td>   
                <td align="center"  width="20%"><?php echo $row['tgl_selesai']?></td>
                <td align="left"  width="20%"><?php echo rupiah($row['biaya'])?></td> 
        
    </tr>
    <?php    
    }
        
?>
</table><script>window.print();</script>
