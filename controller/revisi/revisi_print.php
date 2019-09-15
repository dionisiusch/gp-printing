<?php
	include('../config/linken.php');
	include('../config/asset.php');
    $tanggalAwal = $_POST["tglAwal"];
    $tanggalAkhir = $_POST["tglAkhir"];
    $queryGetAllRevisi = "SELECT revisi.id,revisi.tgl_mulai,revisi.tgl_deadline,revisi.tgl_selesai,sample.artikel,revisi.status,sample.nomor_po,revisi.qty_awal,revisi.qty_akhir,revisi.keterangan FROM revisi join sample on revisi.id_sample = sample.id Where tgl_mulai BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ORDER BY tgl_mulai ASC";
	$resultGetAllRevisi = mysqli_query($link,$queryGetAllRevisi) or die(mysqli_error($link));

    function kilo($angka){
	
	$hasil_Kg = number_format($angka,2,',','.') ."Kg ";
	return $hasil_Kg;
 
    }
    function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
    }
	if(!$resultGetAllRevisi){
			echo "<script>alert('Error Insert Obat!');
				window.location.replace('../../view/obat.php');
			";
		}
    ?>
    <h1>DAFTAR DATA PERBAIKAN PER TANGGAL</h1>
<?php
//    $queryGetDate = "SELECT * FROM obat Where tgl = ";
//	$resultGetDate = mysqli_query($link,$queryDate) or die(mysqli_error($link));
//    while($row =$resultGetAllSample->fetch_assoc()){
?>
    <table border="1" width="100%" align="center">
 
    <?php
    $i=0;
    $currentDate = false;    
    while($row =$resultGetAllRevisi->fetch_assoc()){
        $i++;
        if ($row['tgl_mulai'] != $currentDate){
        ?>
        
        <table border="1" width="100%" align="center">
            <tr>
        <th align="center">ID</th><th>Nomor PO</th><th>Nama</th><th>Tgl Mulai</th><th>Tanggal Selesai</th><th>Qty Awal</th><th>Qty Akhir</th><th>Keterangan</th>
        </tr>    
    
        Tanggal : <?php echo $row['tgl_mulai']?></td>    
   
      <?php $currentDate = $row['tgl_mulai'];
            }
        ?>
    <tr>
        <td align="center" width="2%"><?php echo $i?></td>
        <td align="center" width="10%"><?php echo $row['nomor_po']?></td>
                <td align="center" width="20%"><?php echo $row['artikel']?></td>   
                <td align="center"  width="15%"><?php echo $row['tgl_mulai']?></td>
                <?php 
                if($row['tgl_selesai']=='0000-00-00'){
                    $row['tgl_selesai']="-";
                }
                ?>
                <td align="center"  width="15%"><?php echo $row['tgl_selesai']?></td>
                <td align="center"  width="10%"><?php echo $row['qty_awal']?></td>   
                <td align="center"  width="10%"><?php echo $row['qty_akhir']?></td>
                <td align="left"  width="20%"><?php echo $row['keterangan']?></td> 
        
    </tr>
    <?php    
    }
        
?>
</table><script>window.print();</script>
