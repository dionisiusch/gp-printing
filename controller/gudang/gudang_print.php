<?php
	include('../config/linken.php');
	include('../config/asset.php');
    $queryGetAllGudang = "SELECT gudang.id,gudang.nomor_po,sample.artikel,gudang.qty_total,gudang.qty_sementara,gudang.tgl_pengambilan,gudang.status,gudang.keterangan FROM gudang join pengerjaan on gudang.id_pengerjaan=pengerjaan.id join sample on pengerjaan.id_sample=sample.id  ORDER BY gudang.id ASC";
	$resultGetAllGudang = mysqli_query($link,$queryGetAllGudang) or die(mysqli_error($link));
   
	if(!$resultGetAllGudang){
			echo "<script>alert('Error Insert Gudang!');
				window.location.replace('../../view/Gudang.php');
			";
		}
    ?>
    <h1>DAFTAR DATA GUDANG</h1>
    <table border="1" width="100%">
    <tr>
        <th>ID</th><th>Nomor Po</th><th>Qty Total PO</th><th>Qty di Gudang</th><th>Tanggal Pengambilan</th><th>Status</th><th>Keterangan</th>
    </tr>    
    <?php
    while($row =$resultGetAllGudang->fetch_assoc()){
    ?>    
    <tr>
        <td align="center"><?php echo $row['id']?></td>
        <td align="center"><?php echo $row['nomor_po']?></td>   
        <td align="center"><?php echo $row['qty_total']?></td>   
        <td align="center"><?php echo $row['qty_sementara']?></td>
        <?php 
        if($row['tgl_pengambilan']=='0000-00-00'){
            $row['tgl_pengambilan']="-";
        }
        ?>
        <td align="center"><?php echo $row['tgl_pengambilan']?></td>
        <?php 
        if($row['status']==0){
            $row['status']='di Dalam Gudang';
        }else{
            $row['status']='Sudah Diambil';
        }
        ?>        
        <td><?php echo $row['status']?></td>
        <td><?php echo $row['keterangan']?></td>
    </tr>
    <?php    
    }
?>
        </table><script>window.print();</script>