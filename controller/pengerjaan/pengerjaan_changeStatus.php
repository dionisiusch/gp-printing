<?php
include('../config/linken.php');


$id = $_POST['id'];
$status = $_POST['status'];
$jenisPengerjaan = $_POST["jenisPengerjaan"];
$result = '';
$resultArr  = array();


if($status==1){
	$statusStr = 'Done';
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
		<form id="formChangeStatus" action="controller/pengerjaan/pengerjaan_insertDetailPengerjaan.php" method="POST">	 
		<table class="table table-bordered">
        
		<tr>
         <td align="right"><b>Qty Akhir: </b></td>
           <td>
		   <input name="id" type="hidden" value="'.$id.'">
		   <input name="jenisPengerjaan" type="hidden" value="'.$jenisPengerjaan.'">
		   ';
		
		   if($jenisPengerjaan==0){
			$result.= ' <input name="qtyAkhirSendiri" type="number" id="qtyAkhirSendiri" placeholder="Qty Akhir Sendiri">';
		   }
		   else if($jenisPengerjaan==1){
			$result.= '<input name="qtyAkhirMakloon" type="number" id="qtyAkhirMakloon" placeholder="Qty Akhir Makloon">';

		   }else{
		   $result.= '
		   <input name="qtyAkhirSendiri" type="number" id="qtyAkhirSendiri" placeholder="Qty Akhir Sendiri">
		   </td></tr><tr><td></td><td>
		   <input name="qtyAkhirMakloon" type="number" id="qtyAkhirMakloon" placeholder="Qty Akhir Makloon">
		 ';
		}
		$result.='  
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
}
else{

};
echo json_encode($resultArr); 




?>


