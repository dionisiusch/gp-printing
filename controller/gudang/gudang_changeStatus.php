<?php
include('../config/linken.php');


$id = $_POST['id'];
$status = $_POST['status'];
$currentDateTime = date('d-m-Y');
$result = '';
$resultArr  = array();


if($status==0){
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
		<form id="formChangeStatus" action="controller/gudang/gudang_UpdateStatusGudang.php" method="POST">	 
		<table class="table table-bordered">
        <input name="id" type="hidden" value="'.$id.'">
		<tr>
         <td align="right"><b>Tanggal Ambil: </b></td>
           <td>
            <input name="tgl" type="text" id="tgl" value="'.$currentDateTime.'" readonly>
		   </td>
         </tr>
		<tr>
         <td align="right"><b>Keterangan : </b></td> 
		<td><textarea rows = "5" cols = "30" name="keterangan" id="keterangan" placeholder="Keterangan"/></td>
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


