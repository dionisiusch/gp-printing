<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetPengerjaan = "SELECT pengerjaan.id,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai_sendiri,pelanggan.nama,pengerjaan.status FROM pengerjaan join sample on pengerjaan.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id ORDER BY pengerjaan.id ASC";
	$resultGetPengerjaan = mysqli_query($link,$queryGetPengerjaan) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1'>Id</th>
                        <th class='col-md-1'>Pelanggan</th>
                        <th class='col-md-1'>Tgl Pengerjaan</th>
						<th class='col-md-1'>Tgl Selesai</th>
                        <th class='col-md-1'>Status</th>
						</tr>";

	while($row = mysqli_fetch_assoc($resultGetPengerjaan)){
	?>
							
	<script>
		function AjaxGetDetailPengerjaan(id){

        $.ajax({
            type: 'POST',
            url: 'controller/pengerjaan/pengerjaan_getDetailPengerjaan.php',
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
                            <tr onclick='AjaxGetDetailPengerjaan(<?php echo $row["id"];?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['nama']?></td>
                                <td><?php echo $row['tgl_mulai']?></td>
                                <td><?php echo $row['tgl_selesai_sendiri']?></td>
								<td><?php if($row['status']==0){
									echo "<span style='color:blue'>On-Going</span>";
									}else if($row['status']==1){
										echo "<span style='color:green'>Done</span>";
									}
										
								;?></td>
								
                            </tr>
                            
	
	
	
<?php
	}
	echo "</table>"
	
	?>
	<div id="myModal2" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal3" class="modal fade" role="dialog">
	
	</div>