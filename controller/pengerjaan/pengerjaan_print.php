<?php
	include('../config/linken.php');
	include('../config/asset.php');
    $tanggalAwal = $_POST["tglAwal"];
    $tanggalAkhir = $_POST["tglAkhir"];
    $queryGetAllPengerjaanSendiri = "SELECT pengerjaan.id_sample,pengerjaan.id,pengerjaan.nomor_po,pengerjaan.tipe,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai_sendiri,pengerjaan.tgl_selesai_makloon,pengerjaan.status,sample.artikel,pengerjaan.qty_awal,pengerjaan.qty_akhir_sendiri,pengerjaan.keterangan,pengerjaan.jumlah_orang,pengerjaan.jam_kerja,pengerjaan.meja FROM pengerjaan join sample on pengerjaan.id_sample = sample.id Where tipe=0 AND pengerjaan.tgl_mulai BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ORDER BY tgl_mulai ASC";
	$resultGetAllPengerjaanSendiri = mysqli_query($link,$queryGetAllPengerjaanSendiri) or die(mysqli_error($link));

    $queryGetAllPengerjaanMakloon = "SELECT pengerjaan.id_sample,pengerjaan.id,pengerjaan.nomor_po,pengerjaan.tipe,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai_sendiri,pengerjaan.tgl_selesai_makloon,pengerjaan.status,sample.artikel,pengerjaan.qty_awal,pengerjaan.qty_akhir_sendiri,pengerjaan.keterangan,pengerjaan.jumlah_orang,pengerjaan.jam_kerja,pengerjaan.meja,pengerjaan.biaya_makloon FROM pengerjaan join sample on pengerjaan.id_sample = sample.id Where tipe=1 AND pengerjaan.tgl_mulai BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ORDER BY tgl_mulai ASC";
	$resultGetAllPengerjaanMakloon = mysqli_query($link,$queryGetAllPengerjaanMakloon) or die(mysqli_error($link));
    function kilo($angka){
	
	$hasil_Kg = number_format($angka,2,',','.') ."Kg ";
	return $hasil_Kg;
 
    }
    function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
    }
	if(!$resultGetAllPengerjaanSendiri){
			echo "<script>alert('Error Insert Obat!');
				window.location.replace('../../view/obat.php');
			";
		}
    ?>
    <h1>DAFTAR DATA PENGERJAAN PER TANGGAL</h1>
<?php
//    $queryGetDate = "SELECT * FROM obat Where tgl = ";
//	$resultGetDate = mysqli_query($link,$queryDate) or die(mysqli_error($link));
//    while($row =$resultGetAllSample->fetch_assoc()){
?>
    <h3>Sendiri</h3>
    <table border="1" width="100%" align="center">
 
    <?php
    $i=0;
    $currentDate = false;    
    while($row =$resultGetAllPengerjaanSendiri->fetch_assoc()){
        $i++;
        if ($row['tgl_mulai'] != $currentDate){
        ?>
        
        <table border="1" width="100%" align="center">
            <tr>
        <th align="center">ID</th><th>Nomor PO</th><th>Nama</th><th>Tgl Mulai</th><th>Tanggal Selesai</th><th>Qty Awal</th><th>Qty Akhir</th><th>Jumlah orang</th><th>Jam kerja</th><th>Meja</th><th>Keterangan</th>
        </tr>    
    
        Tanggal : <?php echo $row['tgl_mulai']?></td>    
   
      <?php $currentDate = $row['tgl_mulai'];
            }
        ?>
    <tr>
        <td align="center" width="2%"><?php echo $i?></td>
        <td align="center" width="10%"><?php echo $row['nomor_po']?></td>
                <td align="center" width="15%"><?php echo $row['artikel']?></td>   
                <td align="center"  width="13%"><?php echo $row['tgl_mulai']?></td>
                <?php 
                if($row['tgl_selesai_sendiri']=='0000-00-00'){
                    $row['tgl_selesai_sendiri']="-";
                }
                ?>
                <td align="center"  width="13%"><?php echo $row['tgl_selesai_sendiri']?></td>
                <td align="center"  width="10%"><?php echo $row['qty_awal']?></td>   
                <td align="center"  width="10%"><?php echo $row['qty_akhir_sendiri']?></td>
                <td align="center"  width="10%"><?php echo $row['jumlah_orang']?></td>
                <td align="center"  width="10%"><?php echo $row['jam_kerja']?></td>
                <td align="center"  width="10%"><?php echo $row['meja']?></td>
                <td align="left"  width="20%"><?php echo $row['keterangan']?></td> 
        
    </tr>
    <?php    
    }
        
?>
</table>

   <h3>Makloon</h3>
    <table border="1" width="100%" align="center">
 
    <?php
    $j=0;
    $currentDate2 = false;    
    while($row2 =$resultGetAllPengerjaanMakloon->fetch_assoc()){
        $j++;
        if ($row2['tgl_mulai'] != $currentDate2){
        ?>
        
        <table border="1" width="100%" align="center">
            <tr>
        <th align="center">ID</th><th>Nomor PO</th><th>Nama</th><th>Tgl Mulai</th><th>Tanggal Selesai</th><th>Qty Awal</th><th>Qty Akhir</th><th>Jumlah orang</th><th>Jam kerja</th><th>Meja</th><th>Biaya Makloon</th><th>Keterangan</th>
        </tr>    
    
        Tanggal : <?php echo $row2['tgl_mulai']?></td>    
   
      <?php $currentDate2 = $row2['tgl_mulai'];
            }
        ?>
    <tr>
        <td align="center" width="2%"><?php echo $j?></td>
        <td align="center" width="10%"><?php echo $row2['nomor_po']?></td>
                <td align="center" width="15%"><?php echo $row2['artikel']?></td>   
                <td align="center"  width="13%"><?php echo $row2['tgl_mulai']?></td>
                <?php 
                if($row2['tgl_selesai_sendiri']=='0000-00-00'){
                    $row2['tgl_selesai_sendiri']="-";
                }
                ?>
                <td align="center"  width="13%"><?php echo $row2['tgl_selesai_sendiri']?></td>
                <td align="center"  width="10%"><?php echo $row2['qty_awal']?></td>   
                <td align="center"  width="10%"><?php echo $row2['qty_akhir_sendiri']?></td>
                <td align="center"  width="10%"><?php echo $row2['jumlah_orang']?></td>
                <td align="center"  width="10%"><?php echo $row2['jam_kerja']?></td>
                <td align="center"  width="10%"><?php echo $row2['meja']?></td>
                <td align="center"  width="10%"><?php echo $row2['biaya_makloon']?></td>
                <td align="left"  width="20%"><?php echo $row2['keterangan']?></td> 
        
    </tr>
    <?php    
    }
        
?>
</table>

<script>window.print();</script>
