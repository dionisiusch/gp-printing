<?php
include('../config/linken.php');

$id = $_POST['id'];
$queryGetPosisi = "SELECT * from posisi WHERE id='$id' LIMIT 1";
$resultGetPosisi = mysqli_query($link,$queryGetPosisi) or die(mysqli_error($link));
while ($row = $resultGetPosisi->fetch_assoc()) {
    $posisi = $row['posisi'];
    
}
$result = '';
$resultArr  = array();

	$result.= '
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		
		<button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
		<h4><b>Edit Posisi</b></h4>
		</div>
		 <div class="modal-body">
      
      <div class="table-responsive ">
      <form id="formChangeStatus" action="controller/posisi/posisi_actionEdit.php" method="POST">
      <table class="table table-bordered" >
           <input type="hidden" name="idPosisi" id="idPosisi" value="'.$id.'">
        
		<tr>
         <td align="right"><b>Posisi : </b></td>
		 

           <td><input id="Posisi" type="text" name="posisi"  class="form-control" required value="'.$posisi.'"></td>
         </tr>
	  
	</table>

<table class="table table-bordered hovertable" id="crud_table2"></table>
     <tr>
      <td><input type="submit" id="saveDetailChangeStatus" style="margin-left:250" class="btn btn-warning" value="Simpan"></td>
	 </tr>
	 </form>
	<br><br><br><br><br><br>
	</div>
</script>
	  ';
	$resultArr['text'] = $result;


echo json_encode($resultArr); 



?>


