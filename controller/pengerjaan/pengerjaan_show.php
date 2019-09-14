<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetPengerjaan = "SELECT pengerjaan.id_sample,pengerjaan.id,pengerjaan.nomor_po,pengerjaan.tipe,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai_sendiri,pengerjaan.tgl_selesai_makloon,pengerjaan.status,sample.artikel FROM pengerjaan join sample on pengerjaan.id_sample = sample.id ORDER BY pengerjaan.id ASC";
	$resultGetPengerjaan = mysqli_query($link,$queryGetPengerjaan) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
						<th class='col-md-1'>Id</th>
						<th class='col-md-1'>Nomor PO</th>
                        <th class='col-md-1'>Artikel</th>
                        <th class='col-md-1'>Tgl Pengerjaan</th>
						<th class='col-md-1'>Tgl Selesai Sendiri</th>
                        <th class='col-md-1'>Tgl Selesai Makloon</th>
                        <th class='col-md-1'>Status</th>
                        <th class='col-md-1'>Action</th>
						</tr>";

	while($row = mysqli_fetch_assoc($resultGetPengerjaan)){
    if($row['tgl_selesai_sendiri']=='0000-00-00'){
        $row['tgl_selesai_sendiri']=null;
    }
     if($row['tgl_selesai_makloon']=='0000-00-00'){
        $row['tgl_selesai_makloon']=null;
    }
   
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
	
    function ChangeStatusPengerjaan(id,jenisPengerjaan){
	var status = 1;
	var data = "id=" + id + "&status="+ status+ "&jenisPengerjaan="+ jenisPengerjaan;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/pengerjaan/pengerjaan_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;
				if(validator==1){
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				}else{
					alert(text);
					window.location.replace(window.location.href+'?reload');
				}
            }
        });		
}
    
        
	</script>
                            <tr onclick='AjaxGetDetailPengerjaan(<?php echo $row["id_sample"];?>)'>
								<td><?php echo $row['id']?></td>
								<td><?php echo $row['nomor_po']?></td>
                                <td><?php echo $row['artikel']?></td>
                                <td><?php echo formatTgl($row['tgl_mulai'])?></td>
                                <td><?php echo formatTgl($row['tgl_selesai_sendiri'])?></td>
                                <td><?php echo formatTgl($row['tgl_selesai_makloon'])?></td>
								<td><?php if($row['status']==0){
									echo "<span style='color:blue'>On-Going</span>";
									}else if($row['status']==1){
										echo "<span style='color:green'>Done</span>";
									}else if($row['status']==2){
										echo "<span style='color:red'>Revisi</span>";
									}
										
								;?></td><td>
                                <?php 
                                if($row['status']==0){ ?>
                                <button onclick="ChangeStatusPengerjaan(<?php echo $row["id"];?>,<?php echo $row["tipe"];?>)" class="btn btn-warning">Terima</button>   
                                <?php }; ?>
                                <a class='btn btn-danger' href='controller/pengerjaan/pengerjaan_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
                            </tr> 
	
	
	
<?php
	}
	echo "</table>";
	
function formatTgl($tgl){
	if($tgl!=0||$tgl!=null){
	$tglArray = explode("-",$tgl);
	return $tglArray[2]."-".$tglArray[1]."-".$tglArray[0]; 
	}
	return null;
}
	
	?>
<script>

</script>

	<div id="myModal2" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal3" class="modal fade" role="dialog">
	
	</div>