<?php
	include('../config/linken.php');
	include('../config/asset.php');
    $queryGetAllObat = "SELECT * FROM obat";
	$resultGetAllObat = mysqli_query($link,$queryGetAllObat) or die(mysqli_error($link));

    function kilo($angka){
	
	$hasil_Kg = number_format($angka,2,',','.') ."Kg ";
	return $hasil_Kg;
 
    }
    function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,'','.');
	return $hasil_rupiah;
 
    }
	if(!$resultGetAllObat){
			echo "<script>alert('Error Insert Obat!');
				window.location.replace('../../view/obat.php');
			";
		}
    ?>
    <h1>DAFTAR DATA OBAT</h1>
    <table border="1" width="100%">
    <tr>
        <th>ID</th><th>Nama Obat</th><th>Qty(Kilo)</th><th>Harga Beli</th><th>Harga Jual</th>
    </tr>    
    <?php
    while($row =$resultGetAllObat->fetch_assoc()){
    ?>    
    <tr>
        <td align="center"><?php echo $row['id']?></td>
        <td align="center"><?php echo $row['nama_obat']?></td>   
        <td><?php echo kilo($row['kilo'])?></td>   
        <td><?php echo rupiah($row['harga_beli'])?></td>   
        <td><?php echo rupiah($row['harga_jual'])?></td>   
        
    </tr>
    <?php    
    }
?>
        </table>
