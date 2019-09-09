<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetGudang = "SELECT gudang.id,pelanggan.nama,gudang.id_pengerjaan,gudang.tgl_pengambilan,gudang.status from gudang join pengerjaan on gudang.id_pengerjaan=pengerjaan.id join sample on pengerjaan.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id ORDER BY gudang.id ASC";
	$resultGetGudang = mysqli_query($link,$queryGetGudang) or die(mysqli_error($link));
	 echo "<table class='table table-hover'><tr>
                        <th class='col-md-1'>Id</th>
                        <th class='col-md-1'>Id Pengerjaan</th>
                        <th class='col-md-1'>Nama Pelanggan</th>
                        <th class='col-md-1'>Tanggal Pengambilan</th>
                        <th class='col-md-1'>Status</th>
                        <th class='col-md-1'>Action</th>
                        </tr>";

	while($row = mysqli_fetch_assoc($resultGetGudang)){
//test  
    if($row['tgl_pengambilan']=='0000-00-00'){
        $row['tgl_pengambilan']=null;
    }else{
         $row['tgl_pengambilan'] = date("d F Y",strtotime( $row['tgl_pengambilan']));
    }  
	?>
							
	<script>
		function AjaxGetDetailGudang(id){

        $.ajax({
            type: 'POST',
            url: 'controller/gudang/gudang_getDetailGudang.php',
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
        
    function ChangeStatusGudang(id){
	var status = 0;
	var data = "id=" + id + "&status="+ status;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/gudang/gudang_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data);
				var text = jsonResult.text;
				var validator = jsonResult.validator;
				if(validator==0){
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
                            <tr onclick='AjaxGetDetailGudang(<?php echo $row["id"]?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['id_pengerjaan']?></td>
                                <td><?php echo $row['nama']?></td>
                                <td><?php echo $row['tgl_pengambilan']?></td>
                                <td><?php if($row['status']==0){
									echo "<span style='color:blue'>On-Storage</span>";
									}else if($row['status']==1){
										echo "<span style='color:green'>Was Taken</span>";
									}
										
								;?></td>
								<td>
                                <?php 
                                if($row['status']==0){ ?>
                                <button onclick="ChangeStatusGudang(<?php echo $row["id"];?>)" class="btn btn-success">Ambil</button>   
                                <?php }; ?>
                                <a class='btn btn-danger' href='controller/gudang/gudang_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
                            </tr>
                            
	
	
	
<?php
	}
	echo "</table>"
	
	?>
<script>
</script>

	<div id="myModal2" class="modal fade" role="dialog">
	
	</div>
	<div id="myModal3" class="modal fade" role="dialog">
	
	</div>