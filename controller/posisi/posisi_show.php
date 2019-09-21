<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetPosisi = "SELECT * from posisi";
	$resultGetPosisi = mysqli_query($link,$queryGetPosisi) or die(mysqli_error($link));
	 echo "<table class='table table-hover' style='width:100%'><tr>
                        <th class='col-md-1' style='width:2%'>Id</th>
                        <th class='col-md-1' style='width:50%'>Posisi</th>
                        <th class='col-md-1' style='width:10%'>Action</th>
                        </tr>";

	while($row = mysqli_fetch_assoc($resultGetPosisi)){
//test    
	?>
							
	<script>
		
	function test(){
		 $("#myModal2").modal("hide");
	};
        
    function editPosisi(id){
	
    var data = "id=" + id;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/posisi/posisi_editPosisi.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data);
				var text = jsonResult.text;
				var validator = jsonResult.validator;
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				
            }
        });		
}
    

	 
	
	</script>
                            <tr>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['posisi']?></td>                  		
								<td>
                                <button onclick="editPosisi(<?php echo $row["id"];?>)" class="btn btn-warning">Edit</button>    
                                <a class='btn btn-danger' href='controller/posisi/posisi_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
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