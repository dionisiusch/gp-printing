<?php
include('../config/linken.php');

$id = $_POST['id'];
$status = $_POST['status'];
$result = '';
$resultArr  = array();
//$query = $link->query("SELECT qty_awal FROM detail_sample WHERE id_sample='$id'");
//while ($row = $query->fetch_assoc()) {
//    $qtyAwal=$row['qty_awal'];
//}


if($status==1){
	$statusStr = 'On-Going';
	$result.= '
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		
		<button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
		<h4><b>Detail Pengerjaan Revisi</b></h4>
		</div>
		 <div class="modal-body">
      
      <div class="table-responsive ">
      <form id="formChangeStatus" action="controller/revisi/revisi_insertRevisi.php" method="POST">
      <table class="table table-bordered" >
           <input type="hidden" name="idSample" id="idSample" value="'.$id.'">
        
		<tr>
         <td align="right"><b>Qty: </b></td>
           <td><input name="qty" type="number" id="qty" placeholder="Qty"></td>
         </tr>
	   <tr>
         <td align="right"><b>Tgl Selesai: </b></td>
           <td><input type="text" name="tglSelesai"  id="tglSelesai" value=""></td>
         </tr>
         
	</table>

<table class="table table-bordered hovertable" id="crud_table2"></table>
     <tr>
      <td><input type="submit" id="saveDetailChangeStatus" style="margin-left:250" class="btn btn-warning" value="Simpan"></td>
	 </tr>
	 </form>
	<br><br><br><br><br><br>
	</div>
	 
<script>

function GetTglSelesai(){
	 var date = new Date();
     date.setDate(date.getDate() + 2);
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


$( "#qty" ).keyup(function() {
  GetTglSelesai();
 });
	 
$( document ).ready(function() {
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


