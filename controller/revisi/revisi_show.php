<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetRevisi = "SELECT revisi.id,revisi.tgl_mulai,revisi.tgl_deadline,revisi.tgl_selesai,sample.artikel,revisi.status FROM revisi join sample on revisi.id_sample = sample.id  ORDER BY revisi.id ASC";
	$resultGetRevisi = mysqli_query($link,$queryGetRevisi) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1' style='width:2%'>Id</th>
                        <th class='col-md-1'>Pelanggan</th>
                        <th class='col-md-1'>Tgl Perbaikan</th>
                        <th class='col-md-1'>Tgl Deadline</th>
						<th class='col-md-1'>Tgl Selesai</th>
                        <th class='col-md-1'>Status</th>
                        <th class='col-md-1'>Action</th>
						</tr>";

	while($row = mysqli_fetch_assoc($resultGetRevisi)){
    if($row['tgl_mulai']=='0000-00-00' ){
        $row['tgl_mulai']=null;
    }else{
        $row['tgl_mulai']=date("d-m-Y",strtotime( $row['tgl_mulai']));
    }
    if($row['tgl_deadline']=='0000-00-00' ){
        $row['tgl_deadline']=null;
    }else{
        $row['tgl_deadline']=date("d-m-Y",strtotime( $row['tgl_deadline']));
    }    
    if($row['tgl_selesai']=='0000-00-00'){
        $row['tgl_selesai']=null;
    }else{
        $row['tgl_selesai']=date("d-m-Y",strtotime( $row['tgl_selesai']));
    }    
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
        
    function ChangeStatusRevisiKerjakan(id,status){
	var data = "id=" + id + "&status="+ status;
	
	 $.ajax({
            type: 'POST',
            url: 'controller/revisi/revisi_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;				
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				
            }
        });
    
}
function ChangeStatusRevisiDone(id,status){
	var data = "id=" + id + "&status="+ status;	
	 $.ajax({
            type: 'POST',
            url: 'controller/revisi/revisi_changeStatusDone.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
            }
        });		

}
    
	
	</script>
                            <tr onclick='AjaxGetDetailRevisi(<?php echo $row["id"];?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['artikel']?></td>
                                <td><?php echo $row['tgl_mulai']?></td>
                                <td><?php echo $row['tgl_deadline']?></td>
                                <td><?php echo $row['tgl_selesai']?></td>
								<td><?php if($row['status']==0){
									echo "<span style='color:red'>Idle</span>";
									}else if($row['status']==1){
										echo "<span style='color:blue'>On-Going</span>";
									}else if($row['status']==2){
										echo "<span style='color:green'>Done</span>";
									}else if($row['status']==3){
										echo "<span style='color:red'>Not Suitable</span>";
									}
										
								;?></td><td>
                                <?php 
                                if($row['status']==0){ ?>
                                <button onclick="ChangeStatusRevisiKerjakan(<?php echo $row["id"];?>,<?php echo $row["status"];?>)" class="btn btn-primary">Kerjakan</button>    
                                <?php }else if($row['status']==1){ ?>
                                <button onclick="ChangeStatusRevisiDone(<?php echo $row["id"];?>,<?php echo $row["status"];?>)" class="btn btn-warning">Terima</button>
                                <?php }?>
                                <a class='btn btn-danger' href='controller/revisi/revisi_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
                            </tr>
	
	
	
<?php
	}
	echo "</table>"
	
	?>

	<div id="myModal2" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal3" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal4" class="modal fade" role="dialog">
	
	</div>