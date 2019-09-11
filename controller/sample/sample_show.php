<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetSample = "SELECT sample.id,sample.artikel,sample.status,sample.tgl,sample.nomor_po FROM sample ORDER BY sample.id ASC";
	$resultGetSample = mysqli_query($link,$queryGetSample) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1'>Id</th>
                        <th class='col-md-1'>Artikel</th>
                        <th class='col-md-1'>Tanggal</th>
						<th class='col-md-1'>Status</th>
                        <th class='col-md-1'>Action</th>
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
        
    function ChangeStatus(id,status,nomorPO){
	
	var data = "id=" + id + "&status="+ status+ "&nomorPO="+ nomorPO;
	
	 $.ajax({
            type: 'POST',
            url: 'controller/sample/sample_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data);
				var text = jsonResult.text;
				var validator = jsonResult.validator;
				if(validator==3){
                    
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				}
				else{
					window.location.replace(window.location.href+'?reload');
				}
            }
        });		
}
    

	 
	
	</script>
                            <tr onclick='AjaxGetDetailSample(<?php echo $row["id"]?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['artikel']?></td>
                                <td><?php echo formatTgl($row['tgl']);?></td>
								<td><?php if($row['status']==1){
									echo "<span style='color:blue'>On-Going</span>";
									}else if($row['status']==2){
										echo "<span style='color:green'>Done</span>";
									}else if($row['status']==3){
										echo "<span style='color:orange'>Production</span>";
									}
									else{
										echo "<span style='color:red'>Idle</span>";
									}
										
								;?></td><td>
                                <?php 
                                if($row['status']==0){ ?>
                                <button onclick="ChangeStatus(<?php echo $row["id"]?>,1,'<?php echo $row["nomor_po"];?>')" class="btn btn-warning">Kerjakan</button>   
								<?php } 
								else if($row['status']==1){?>
								<button onclick="ChangeStatus(<?php echo $row["id"]?>,2,'<?php echo $row["nomor_po"];?>')" class="btn btn-success">Done</button>  <?php
								}
								else if($row['status']==2){?>
									<button onclick="ChangeStatus(<?php echo $row["id"]?>,3,'<?php echo $row["nomor_po"];?>')" class="btn btn-primary">Production</button>  <?php
									}
									?>
                                <a class='btn btn-danger' href='controller/sample/sample_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
                            </tr>
                            
	
	
	
<?php
	}
	echo "</table>";
	function formatTgl($tgl){
		$tglArray = explode("-",$tgl);
		return $tglArray[2]."-".$tglArray[1]."-".$tglArray[0]; 
	  }
	

	?>

	<div id="myModal2" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal3" class="modal fade" role="dialog">
	
	</div>