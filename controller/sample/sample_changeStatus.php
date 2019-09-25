<?php
include('../config/linken.php');

$id = $_POST['id'];
$status = $_POST['status'];
$nomorPO = $_POST['nomorPO'];
$result = '';
$resultArr  = array();

if($status==1){
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
<form id="formInsertTglNaikBahan" action="controller/sample/sample_insertTglNaikBahan.php" method="POST">
<table class="table table-bordered" >
        
		<tr>
         <td align="right"><b>Tgl Naik Bahan : </b></td>
           <td>
           <input name="tglNaikBahan" type="date" id="tglNaikBahan" value="">
           <input type="hidden" name="idSample" id="idSample" value="'.$id.'">
		   </td>
         </tr>   
  </table>
  <tr>
  <td><input type="submit" style="margin-left:250" class="btn btn-warning" value="Simpan"></td>
</tr>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
  ';
  $resultArr['text'] = "On-Going";
	$resultArr['validator'] = $status;
}

if($status==2){
	$query = $link->query("UPDATE sample set status=2,tgl_selesai = now() where id='$id'");
  $resultArr['text'] = "Done";
	$resultArr['validator'] = $status;
}

if($status==3){
	$statusStr = 'Production';
	$result.= '
	<div class="modal-dialog" style="width:800">

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
           <input type="hidden" name="nomorPO" id="nomorPO" value="'.$nomorPO.'">
		   </td>
         </tr>
		<tr name="qtySendiri_show" id="qtySendiri_show">
         <td align="right"><b>Qty Sendiri: </b></td>
           <td><input name="qtySendiri" type="number" id="qtySendiri" placeholder="Qty"></td>
         </tr>
	   <tr name="tglSendiri_show" id="tglSendiri_show">
         <td align="right"><b>Tgl Selesai Sendiri : </b></td>
           <td><input name="tglSelesaiSendiri" type="text" class="datepickerSendiri" id="tglSelesaiSendiri" value=""></td>
         </tr>

        <tr name="qtyMakloon_show" id="qtyMakloon_show">
         <td align="right"><b>Qty Makloon: </b></td>
           <td><input name="qtyMakloon" type="number" id="qtyMakloon" placeholder="Qty"></td>
         </tr>
	   <tr name="tglMakloon_show" id="tglMakloon_show">
         <td align="right"><b>Tgl Selesai Makloon : </b></td>
           <td><input name="tglSelesaiMakloon" type="text" class="datepickerMakloon" id="tglSelesaiMakloon" value=""></td>
         </tr>
         <tr>
         <td align="right"><b>Tgl Naik Bahan : </b></td>
           <td><input name="tglNaikBahan" type="text" id="tglNaikBahan"  class="datepickerNaikBahan" value=""></td>
         </tr>
         
  </table>
  <table class="table table-bordered" >
  <tr id="biayaMakloon">
  <td align="right"><b>Biaya Produksi Makloon : </b></td>

    <td><input type="text" name="biayaMakloon" id="biayaMakloonField"  class="form-control">
</td>

<tr>  
		<tr id="jumlahOrang">
         <td align="right"><b>Jumlah Orang : </b></td>

           <td><input type="number" name="jumlahOrang"  class="form-control">
       </td>
       
		<tr id="meja">
    <td align="right"><b>Meja : </b></td>

      <td><input type="number" name="meja"  class="form-control">
  </td>
         </tr>
         
		<tr id="jamKerja" >
    <td align="right"><b>Jam Kerja : </b></td>

      <td><input type="number" name="jamKerja" class="form-control">
  </td>
  </tr>
	
  </table>

  <table class="table table-bordered" id="tableObat">
        
  <tr>
       <td align="center" style="width:50%"><b>Obat </b></td>
       <td align="center"><b>Qty (gram) </b></td>
   </tr>
   ';

  //get detail obat
  $queryObat = $link->query("SELECT obat.nama_obat,sample_obat.qty,sample_obat.id_obat FROM sample_obat join obat on sample_obat.id_obat = obat.id WHERE id_sample='$id'");
  $num_row = mysqli_num_rows( $queryObat );
  $result .= '<input type="hidden" id="num_row" value="'.$num_row.'">';
  $i = 1;
  while ($row = $queryObat->fetch_assoc()) {
    $result .= '<input type="hidden" id="qtyAkhirObatHidden'.$i.'" value="'.$row['qty'].'">
    <input type="hidden" name="idObat['.$i.']" value="'.$row['id_obat'].'">';
    $result.= '
     <tr >
      <td align="center">
        '.$row['nama_obat'].'
      </td>
      <td align="center"><input type="number" name="qtyAkhirObat['.$i.']" id="qtyAkhirObat'.$i.'" value='.$row['qty'].' class="form-control"></td>
     </tr>
';
$i++;
}

$result.='

</table>

     <tr>
      <td><input type="submit" id="saveDetailChangeStatus" style="margin-left:250" class="btn btn-warning" value="Simpan"></td>
	 </tr>
	 </form>
	<br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
	 
<script>
$(function(){
  $(".datepickerSendiri").datepicker({
      dateFormat: "dd-mm-yy",
      autoclose: true,
      todayHighlight: true,
  });
 });

 $(function(){
  $(".datepickerMakloon").datepicker({
      dateFormat: "dd-mm-yy",
      autoclose: true,
      todayHighlight: true,
  });
 });

 $(function(){
  $(".datepickerNaikBahan").datepicker({
      dateFormat: "dd-mm-yy",
      autoclose: true,
      todayHighlight: true,
  });
 });

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
    var newDate = day+"-"+month+"-"+year;
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
    var newDate = day+"-"+month+"-"+year;
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
    $("#jumlahOrang").show();
    $("#meja").show();
    $("#jamKerja").show();
    $("#tableObat").show();
    $("#biayaMakloon").hide();
  }else if(type==1){
    $("#qtySendiri_show").hide();
    $("#tglSendiri_show").hide();
    $("#qtyMakloon_show").show();
    $("#tglMakloon_show").show();
    $("#jumlahOrang").hide();
    $("#meja").hide();
    $("#jamKerja").hide();
    $("#tableObat").hide();
    $("#biayaMakloon").show();
  }else{
    $("#qtySendiri_show").show();
    $("#tglSendiri_show").show();
    $("#qtyMakloon_show").show();
    $("#tglMakloon_show").show();
    $("#jumlahOrang").show();
    $("#meja").show();
    $("#jamKerja").show();
    $("#tableObat").show();
    $("#biayaMakloon").show();
  }

}

$(document).on("keyup", "#biayaMakloonField", function(){
  var biaya =  $("#biayaMakloonField").val();
  $("#biayaMakloonField").val(formatRupiah(biaya));
  });

function formatRupiah(angka){
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
  split   		= number_string.split(","),
  sisa     		= split[0].length % 3,
  rupiah     		= split[0].substr(0, sisa),
  ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if(ribuan){
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return "Rp. " + rupiah;
}


$( document ).ready(function() {
    $("#qtySendiri_show").show();
    $("#tglSendiri_show").show();
    $("#qtyMakloon_show").hide();
    $("#tglMakloon_show").hide();
    $("#biayaMakloon").hide();
    GetTglSelesaiSendiri();
    GetTglSelesaiMakloon();
    
    $("#qtySendiri_show").keyup(function(){
        var qty = parseInt($("#qtySendiri").val());
        var num_row = parseInt($("#num_row").val());
        var i = 1;
       
        for (i = 1; i <= num_row; i++) {
          var stringHidden = "#qtyAkhirObatHidden"+i;
          var string = "#qtyAkhirObat"+i;
          var qtyObat = parseInt($(stringHidden).val());
          var result = qty * qtyObat;
          $(string).val(result);
        }
        
    });

});
</script>
	  ';
	
}
$resultArr['text'] = $result;
$resultArr['validator'] = $status;

echo json_encode($resultArr); 



?>


