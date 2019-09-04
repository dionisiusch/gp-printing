<?php
include('../config/linken.php');


$id = $_POST['id'];
$status = $_POST['status'];
$result = '';
$resultArr  = array();


	$statusStr = 'Done';
	$result.= '
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		
		<button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
		<h4><b>Revisi Selesai</b></h4>
		</div>
		 <div class="modal-body">
      
<div class="table-responsive ">
<form id="formChangeStatus" action="controller/revisi/revisi_insertDetailRevisi.php" method="POST">	 
<table class="table table-bordered">
        
		<tr>
         <td align="right"><b>Qty Diselesaikan : </b></td>
           <td>
           <input name="id" type="hidden" value="'.$id.'">
           <input name="qtyAkhir" type="number" id="qtyAkhir" placeholder="Qty Diselesaikan">
		   </td>
         </tr>
		<tr>
         <td align="right"><b>Keterangan : </b></td> 
		<td><input name="keterangan" type="text" id="keterangan" placeholder="Keterangan"></td>
        </tr>
	</table>
<table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <td><input type="submit" id="savePengerjaanChangeStatus" style="margin-left:250" class="btn btn-warning" value="Simpan"></td>
	 </tr>
	 </form>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
	  ';
	$resultArr['text'] = $result;
	$resultArr['validator'] = $status;


echo json_encode($resultArr); 



?>


