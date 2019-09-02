<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetSample = "SELECT sample.id,pelanggan.nama,sample.status,sample.tgl FROM sample join pelanggan on sample.id_pelanggan = pelanggan.id where status != 2 ORDER BY sample.id ASC";
	$resultGetSample = mysqli_query($link,$queryGetSample) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1'>Id</th>
                        <th class='col-md-1'>Pelanggan</th>
                        <th class='col-md-1'>Tanggal</th>
						<th class='col-md-1'>Status</th>
                        </tr>";

	while($row = mysqli_fetch_assoc($resultGetSample)){
//test    
	?>
							
	<script>
		function AjaxGetDetailSample(id){

        $.ajax({
            type: 'POST',
            url: 'controller/sample/sample_getDetailSample.php',
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
                            <tr onclick='AjaxGetDetailSample(<?php echo $row["id"]?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['nama']?></td>
                                <td><?php echo $row['tgl']?></td>
								<td><?php if($row['status']==1){
									echo "<span style='color:blue'>On-Going</span>";
									}else if($row['status']==2){
										echo "<span style='color:green'>Done</span>";
									}else{
										echo "<span style='color:red'>Idle</span>";
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