<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetTransaksi = "SELECT pengerjaan.id_sample,pengerjaan.id,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai_sendiri,pelanggan.nama,pengerjaan.status FROM revisi join pengerjaan on revisi.id_pengerjaan = pengerjaan.id join sample on pengerjaan.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id ORDER BY pengerjaan.id ASC";
	$resultGetTransaksi = mysqli_query($link,$queryGetTransaksi) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1'>Id</th>
                        <th class='col-md-1'>Pelanggan</th>
                        <th class='col-md-1'>Tgl Pengerjaan</th>
						<th class='col-md-1'>Tgl Selesai</th>
                        <th class='col-md-1'>Status</th>
						</tr>";

	while($row = mysqli_fetch_assoc($resultGetTransaksi)){
	?>
							
	<script>
		function AjaxGetDetailPengerjaan(id){

        $.ajax({
            type: 'POST',
            url: 'controller/detailTransaksi/detailTransaksi_getDetail.php',
            data: "id=" + id,
            success: function(data) {
                 $('#myModal2').html(data);
            }
        });
		
		 $("#myModal2").modal("show");
		
		}
		
	function test(){
		 $("#myModal2").modal("hide");
	};
	
	</script>
                            <tr onclick='AjaxGetDetailTransaksi(<?php echo $row["id"];?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['nama']?></td>
                                <td><?php echo $row['tgl_mulai']?></td>
                                <td><?php echo $row['tgl_selesai_sendiri']?></td>
								
                            </tr>
                            
	
	
	
<?php
	}
	echo "</table>"
	
	?>
	<div id="myModal2" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal3" class="modal fade" role="dialog">
	
	</div>