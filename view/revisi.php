<?php
include('header.php');
include('../controller/config/asset.php');
?>
<base href="http://localhost/gp-printing/" />
<div class="modal-header">
    <h4 class="modal-title">Revisi</h4>
</div>
<div class="modal-body">
  <?php
    $currentDateTime = date('Y-m-d');
    $twodayDate = date('Y-m-d', strtotime($currentDateTime. ' + 2 days'))
  
?>  

   <br />
   <br />

   <br>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Revisi</button>
   <br>
    <br>
<?php
	include '../controller/revisi/revisi_show.php';
?>

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button class="btn-danger" style='float:right' data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Revisi</h4>
      </div>
      <div class="modal-body">
      
<div class="table-responsive ">
    <table class="table table-bordered hovertable">
    <select name="basedOn" id="selectOn" class="form-control">
          <option value="1">Pengerjaan</option>
          <option value="2">Revisi</option>
    </select>
    </table>    
    
<div id="pengerjaan">
<form action="controller/revisi/revisi_addPengerjaan.php" method="POST" enctype="multipart/form-data">
     <table class="table table-bordered">
        <tr>
         <td align="right" style="width:40%"><b>Pengerjaan: </b></td>
		 

           <td><select style="width:100%" name="InputPengerjaan" id="InputPengerjaan" class="form-control">
          <option selected hidden value="">--Pengerjaan--</option>
 
          </select></td>

	   <tr>
         <td align="right"><b>Qty : </b></td>

           <td><input type="number" name="qtyPengerjaan"  id="qtyPengerjaan" class="form-control"  autocomplete="off" /></td>
         </tr>
      <tr>
         <td align="right"><b>Tanggal Mulai: </b></td>

           <td><input type="date" name="tglrevisiPengerjaan"   id="tglrevisiPengerjaan" class="form-control"  autocomplete="off" value="<?php echo $currentDateTime?>"/></td>
         </tr>
        <tr>
         <td align="right"><b>Tanggal Selesai (Dateline): </b></td>

           <td><input type="date" name="tglDeadline"   id="tglDeadline" class="form-control"  autocomplete="off" value="<?php echo $twodayDate?>"/></td>
         </tr>        
       </table>



        <div align="center">
         <input type="submit" name="submit" id="submit" class="btn btn-info" value="Proses">
        </div>
        <br />
        <div id="inserted_item_data"></div>
    </form>
</div>
    
<div id="revisi"> 
  
<form action="controller/revisi/revisi_addRevisi.php" method="POST" enctype="multipart/form-data">
     <table class="table table-bordered">
        <tr>
         <td align="right" style="width:40%"><b>Revisi: </b></td>
		 

           <td><select style="width:100%" name="InputRevisi" id="InputRevisi" class="form-control">
          <option selected hidden value="">--Perbaikan--</option>

          </select></td>
         </tr>
	   <tr>
          <tr>
         <td align="right"><b>Qty : </b></td>

           <td><input type="number" name="qtyRevisi"  id="qtyRevisi" class="form-control"  autocomplete="off" /></td>
         </tr>
      <tr>
         <td align="right"><b>Tanggal Mulai: </b></td>

           <td><input type="date" name="tglrevisiRevisi"   id="tglrevisiRevisi" class="form-control"  autocomplete="off" value="<?php echo $currentDateTime?>"/></td>
         </tr>
        <tr>
         <td align="right"><b>Tanggal Selesai (Dateline): </b></td>

           <td><input type="date" name="tglDeadlineRevisi"   id="tglDeadlineRevisi" class="form-control"  autocomplete="off" value="<?php echo $twodayDate?>"/></td>
         </tr>
       </table>



        <div align="center">
         <input type="submit" name="submit" id="submit" class="btn btn-info" value="Proses">
        </div>
        <br />
        <div id="inserted_item_data"></div>
    </form>
</div>
    
          </div>
      </div>
      
    </div>

  </div>
</div>



<script>
$(document).ready(function(){

$('#revisi').hide();    
GetAjaxPengerjaan();
GetAjaxRevisi()
function GetAjaxPengerjaan(){
  $.ajax({
            type: 'GET',
            url: 'controller/pengerjaan/pengerjaan_getAllPengerjaan.php',
            success: function(data) {
              var pengerjaanString = JSON.parse(data); 
              $("#InputPengerjaan").select2({
                data : pengerjaanString
              });
            }
        });		

};
function GetAjaxRevisi(){
  $.ajax({
            type: 'GET',
            url: 'controller/revisi/revisi_getAllRevisi.php',
            success: function(data) {
              var revisiString = JSON.parse(data); 
              $("#InputRevisi").select2({
                data : revisiString
              });
            }
        });		

};    
$('#InputPengerjaan').change(function(){
var pengerjaan = $("#InputPengerjaan").val();
if ($.trim(pengerjaan) !='--pengerjaan--') {
    $.post('controller/action/autofillFormPengerjaan.php', {name: pengerjaan}, function(data) {
        $("#qtyPengerjaan").val(data['qty_sendiri']);
    });
}
});    
   



 $('#selectOn').change(function(){
  if($('#selectOn option:selected').val()==1){
     $('#pengerjaan').show();
     $('#revisi').hide();  
     }else{
     $('#pengerjaan').hide();
     $('#revisi').show(); 
     }
 });
    
function ChangeStatusRevisiKerjakan(){
	var id = $("#idRevisi").val();
	var status = $("#status").val();
	var data = "id=" + id + "&status="+ status;
	
	 $.ajax({
            type: 'POST',
            url: 'controller/revisi/revisi_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;				
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				
            }
        });
    
}    

});

</script>
