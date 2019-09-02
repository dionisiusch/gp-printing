<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetRevisi = "SELECT revisi.id,revisi.tgl_mulai,revisi.tgl_selesai,pelanggan.nama,revisi.status FROM revisi join sample on revisi.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id ORDER BY revisi.id ASC";
	$resultGetRevisi = mysqli_query($link,$queryGetRevisi) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1'>Id</th>
                        <th class='col-md-1'>Pelanggan</th>
                        <th class='col-md-1'>Tgl Revisi</th>
						<th class='col-md-1'>Tgl Selesai</th>
                        <th class='col-md-1'>Status</th>
						</tr>";

	while($row = mysqli_fetch_assoc($resultGetRevisi)){
	?>
							
	<script>
		function AjaxGetDetailRevisi(id){

        $.ajax({
            type: 'POST',
            url: 'controller/revisi/revisi_getDetailRevisi.php',
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
                            <tr onclick='AjaxGetDetailRevisi(<?php echo $row["id"];?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['nama']?></td>
                                <td><?php echo $row['tgl_mulai']?></td>
                                <td><?php echo $row['tgl_selesai']?></td>
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