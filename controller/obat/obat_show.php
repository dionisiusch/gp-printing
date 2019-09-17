<?php
	include('../controller/config/linken.php');
	include('../controller/config/asset.php');
	
	$queryGetObat = "SELECT * from Obat";
	$resultGetObat = mysqli_query($link,$queryGetObat) or die(mysqli_error($link));
	 echo "<table class='table table-hover' style='width:100%'><tr>
                        <th class='col-md-1' style='width:2%'>Id</th>
                        <th class='col-md-1' style='width:50%'>Nama Obat</th>
                        <th class='col-md-1' style='width:10%'>Action</th>
                        </tr>";

	while($row = mysqli_fetch_assoc($resultGetObat)){
//test    
	?>
							
	<script>
		function AjaxGetDetailObat(id){

        $.ajax({
            type: 'POST',
            url: 'controller/obat/obat_getDetailObat.php',
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
        
    function editObat(id){
	
    var data = "id=" + id;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/obat/obat_editObat.php',
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
                            <tr onclick='AjaxGetDetailObat(<?php echo $row["id"]?>)'>
								<td><?php echo $row['id']?></td>
                                <td><?php echo $row['nama_obat']?></td>                  		
								<td>
                                <button onclick="editObat(<?php echo $row["id"];?>)" class="btn btn-warning">Edit</button>    
                                <a class='btn btn-danger' href='controller/obat/obat_delete.php?id="<?php echo $row["id"];?>"'>Hapus</a></td>
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