<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetObat = "SELECT * from Obat";
	$resultGetObat = mysqli_query($link,$queryGetObat) or die(mysqli_error($link));
	 echo "<table class='table table-hover' style='width:100%'><tr>
                        <th class='col-md-1' style='width:2%'>Id</th>
                        <th class='col-md-1' style='width:50%'>Nama Obat</th>
                        <th class='col-md-1' style='width:5%'>Action</th>
                        </tr>";

	while($row = mysqli_fetch_assoc($resultGetObat)){
//test    
	?>
							
	<script>
		function AjaxGetDetailObat(id){

        $.ajax({
            type: 'POST',
            url: 'controller/Obat/Obat_getDetailObat.php',
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
        
    function ChangeStatus(id){
	var status = 1;
	var data = "id=" + id + "&status="+ status;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/Obat/Obat_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data);
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
                            <tr onclick='AjaxGetDetailObat(<?php echo $row["id"]?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['nama_obat']?></td>                  		
								<td>
                                <a class='btn btn-danger' href='controller/Obat/Obat_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
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