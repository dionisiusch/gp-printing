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
<form id="formChangeStatus" action="controller/pengerjaan/pengerjaan_insertPengerjaan.php" method="POST">	 
<table class="table table-bordered">
        
		<tr>
         <td align="right"><b>Jenis Pengerjaan : </b></td>
		 

           <td><select name="jenisPengerjaan" id="jenisPengerjaan" class="form-control">
				<option value="0">Pengerjaan Sendiri (7x24jam)</option>
				<option value="1">Pengerjaan Makloon (3x24jam)</option>
		   </select>
		   </td>
         </tr>
		<tr>
         <td align="right"><b>Qty : </b></td>
		 
			<input type="hidden" name="idSample" value="'.$id.'">
           <td><input name="qty" type="number" id="qty" placeholder="Qty"></td>
         </tr>
	   <tr>
         <td align="right"><b>Tgl Selesai : </b></td>

           <td><input name="tglSelesai" type="text" id="tglSelesai" value=""></td>
         </tr>
		  
	</table>
<table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <td><input type="submit" id="saveDetailChangeStatus" style="margin-left:250" class="btn btn-warning" value="Simpan"></td>
	 </tr>
	 </form>
	<br><br><br><br><br><br>
	</div>
	 
<script>

function GetTglSelesai(){
	 var tipe = $("#jenisPengerjaan").val();
	 var date = new Date();
	 if(tipe==0){
		 date.setDate(date.getDate() + 7);
	 }else{
		 date.setDate(date.getDate() + 3);
	 }
        var month = "" + date.getMonth();
        var day = "" + date.getDate();
        var year = date.getFullYear();

    if(month.length < 2){
		month = "0" + month;
	}
    if(day.length < 2){
		day = "0" + day;
	}
    var newDate = year+"-"+month+"-"+day;
	 $("#tglSelesai").val(newDate);
}

$( "#jenisPengerjaan" ).change(function() {
  GetTglSelesai();
});
	 
$( document ).ready(function() {
    GetTglSelesai();
	
	});
</script>
	  ';
	$resultArr['text'] = $result;
	$resultArr['validator'] = $status;
}else {
	$statusStr = 'Idle';
	$resultArr['text'] = $statusStr;
	$resultArr['validator'] = $status;
	$query = $link->query("UPDATE sample set status='$status' where id='$id'");
	
}

echo json_encode($resultArr); 



?>


