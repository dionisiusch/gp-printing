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
		<h4><b>Detail Pengerjaan</b></h4>
		</div>
		 <div class="modal-body">
      
<div class="table-responsive ">
<form id="formChangeStatus" action="controller/pengerjaan/pengerjaan_insertPengerjaan.php" method="POST">
<table class="table table-bordered" >
        
		<tr>
         <td align="right"><b>Jenis Pengerjaan : </b></td>

           <td><select name="jenisPengerjaan" id="jenisPengerjaan" class="form-control" onChange="showHide()">
				<option value="0">Pengerjaan Sendiri (7x24jam)</option>
				<option value="1">Pengerjaan Makloon (3x24jam)</option>
                <option value="2">Pengerjaan Sendiri & Makloon</option>
		   </select>
           <input type="hidden" name="idSample" id="idSample" value="'.$id.'">
		   </td>
         </tr>
		<tr name="qtySendiri_show" id="qtySendiri_show">
         <td align="right"><b>Qty Sendiri: </b></td>
           <td><input name="qtySendiri" type="number" id="qtySendiri" placeholder="Qty"></td>
         </tr>
	   <tr name="tglSendiri_show" id="tglSendiri_show">
         <td align="right"><b>Tgl Selesai Sendiri : </b></td>
           <td><input name="tglSelesaiSendiri" type="date" id="tglSelesaiSendiri" value=""></td>
         </tr>

        <tr name="qtyMakloon_show" id="qtyMakloon_show">
         <td align="right"><b>Qty Makloon: </b></td>
           <td><input name="qtyMakloon" type="number" id="qtyMakloon" placeholder="Qty"></td>
         </tr>
	   <tr name="tglMakloon_show" id="tglMakloon_show">
         <td align="right"><b>Tgl Selesai Makloon : </b></td>
           <td><input name="tglSelesaiMakloon" type="date" id="tglSelesaiMakloon" value=""></td>
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

function GetTglSelesaiSendiri(){
	 var date = new Date();
     date.setDate(date.getDate() + 7);
     date.setMonth(date.getMonth() + 1); 
     var month = "" + date.getMonth() ;
     var day = "" + date.getDate();
     var year = date.getFullYear();

    if(month.length < 2){
		month = "0" + month;
	}
    if(day.length < 2){
		day = "0" + day;
	}
    var newDate = year+"-"+month+"-"+day;
	 $("#tglSelesaiSendiri").val(newDate);
}
function GetTglSelesaiMakloon(){
	 var date = new Date();
     date.setDate(date.getDate() + 3);
     date.setMonth(date.getMonth() + 1); 
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
	 $("#tglSelesaiMakloon").val(newDate);
}
function showRow(rowId) {
    document.getElementById(rowId).style.display = "";
}
function hideRow(rowId) {
    document.getElementById(rowId).style.display = "none";
};

function showHide(){
 var type = $("#jenisPengerjaan").val();
  if(type==0){
    $("#qtySendiri_show").show();
    $("#tglSendiri_show").show();
    $("#qtyMakloon_show").hide();
    $("#tglMakloon_show").hide();
  }else if(type==1){
    $("#qtySendiri_show").hide();
    $("#tglSendiri_show").hide();
    $("#qtyMakloon_show").show();
    $("#tglMakloon_show").show();
  }else{
    $("#qtySendiri_show").show();
    $("#tglSendiri_show").show();
    $("#qtyMakloon_show").show();
    $("#tglMakloon_show").show();
  }

}

$( "#qtySendiri" ).keyup(function() {
  GetTglSelesaiSendiri();
 });
$( "#qtyMakloon" ).keyup(function() {
  GetTglSelesaiMakloon();
});
	 
$( document ).ready(function() {
    $("#qtySendiri_show").show();
    $("#tglSendiri_show").show();
    $("#qtyMakloon_show").hide();
    $("#tglMakloon_show").hide();

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


