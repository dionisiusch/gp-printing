<?php
include('../config/linken.php');


$id = $_POST['id'];
$status = $_POST['status'];
$result = '';
$resultArr  = array();


if($status==1){
	$statusStr = 'On-Going';
	$result.= '
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		
		<button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
		<h4><b>Detail Pengerjaan</b></h4>
		</div>
		 <div class="modal-body">
      
<div class="table-responsive ">
     <table class="table table-bordered">
        
		<tr>
         <td align="right"><b>Jenis Pengerjaan : </b></td>
		 

           <td><select id="jenisPengerjaan" class="form-control">
				<option value="0">Pengerjaan Sendiri (7x24jam)</option>
				<option value="1">Pengerjaan Makloon (3x24jam)</option>
		   </select>
		   </td>
         </tr>
		<tr>
         <td align="right"><b>Qty : </b></td>
		 

           <td><input type="number" id="qty" placeholder="Qty"></td>
         </tr>
	   <tr>
         <td align="right"><b>Deadline : </b></td>

           <td>'.'Auto berubah ngikut dropdown + tgl hari ini'.'</td>
         </tr>
		  
       </table> <table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <td><button id="saveDetailChangeStatus" style="margin-left:250" class="btn btn-warning">Simpan</button></td>
     </tr>
	<br><br><br><br><br><br>
	 </div>
	  ';
	$resultArr['text'] = $result;
	$resultArr['validator'] = $status;
}else if($status==2){
	$statusStr = 'Done';
	$resultArr['text'] = $statusStr;
	$resultArr['validator'] = $status;
	$query = $link->query("UPDATE sample set status='$status' where id='$id'");
	
}else {
	$statusStr = 'Idle';
	$resultArr['text'] = $statusStr;
	$resultArr['validator'] = $status;
	$query = $link->query("UPDATE sample set status='$status' where id='$id'");
	
}

echo json_encode($resultArr); 



?>



