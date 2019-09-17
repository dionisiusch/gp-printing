<?php
include('header.php');
include('../controller/config/asset.php');
?>
<base href="http://localhost/gp-printing/" />
<div class="modal-header">
    <h4 class="modal-title">Sample</h4>
</div>
<div class="modal-body">
  <?php
    $currentDateTime = date('Y-m-d');
?>  

   <br />
   <br />

   <br>
    
<!-- Trigger the modal with a button -->

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Sample</button>
    <a class="btn btn-default btn-lg" href='view/sample_pickDate.php'><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp; Print</a>
    
<br><br>
<?php
	include '../controller/sample/sample_show.php';
?>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button class="btn-danger" style='float:right' data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Sample</h4>
      </div>
      <div class="modal-body">
      
<div class="table-responsive ">
<form action="controller/sample/sample_add.php" method="POST" enctype="multipart/form-data">
     <table class="table table-bordered">
     <tr>
         <td align="right"><b>Nomor PO : </b></td>
		 

           <td><input type="text" name="nomorPO"  class="form-control" required placeholder='Nomor PO' autocomplete="on" ></td>
         </tr>
        <tr>
         <td align="right"><b>Artikel : </b></td>
		 

           <td><input id='artikel' type="text" name="artikel"  class="form-control" required placeholder='Artikel' autocomplete="on" ></td>
         </tr>

	   <tr>
         <td align="right"><b>Tanggal : </b></td>

           <td><input type="date" name="tglSample"  class="form-control"  autocomplete="off" value="<?php echo $currentDateTime?>"/></td>
         </tr>
       </table>
<table class="table table-bordered hovertable">
    <tr>
    <td align="right"><b>Perkiraan Biaya Per Sample : </b></td>
      <td><input type="number"  class="form-control" name="perkiraanBiaya" id="perkiraanBiaya" placeholder="0"></td>
     </tr>
     </table>

     
 
    <table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <th width="40%">Posisi</th>
      <th width="60%">Desain</th>
     </tr>

     <tr >
      <td>
        <select style="width:200" name="posisi[1]" id="posisi[1]" class="form-control">
          <option selected hidden value="">--Posisi--</option>
          <option></option>
          </select>
      </td>
      <td><input type="file" name="sample[1]" class="form-control"/></td>
    

     </tr>

    </table>
    <div align="right">
         <button type="button" name="add" id="add" class="btn btn-success btn-xs">Tambah Desain</button>
        </div>
        <table class="table table-bordered hovertable" id="crud_table2">
     <tr>
      <th width="40%">Obat</th>
      <th width="60%">Qty Obat (gram)</th>
     </tr>

     <tr >
      <td>
        <select style="width:200" name="obat[1]" id="obat[1]" class="form-control">
          <option selected hidden value="">--Obat--</option>
          <option></option>
          </select>
      </td>
      <td><input type="number" name="qtyObat[1]" class="form-control" placeholder="Qty Obat"/></td>
    

     </tr>

    </table>
    <div align="right">
         <button type="button" name="addObat" id="addObat" class="btn btn-success btn-xs">Tambah Obat</button>
        </div>
        <div align="center">
         <input type="submit" name="submit" id="submit" class="btn btn-info" value="Proses">
        </div>
        <br />
        <div id="inserted_item_data"></div>
       </div>
  </div>
  
</form>
      </div>
      
    </div>

  </div>
</div>



<script>
$(document).ready(function(){

var count = 1;
var countObat = 1;
GetAjaxPosisi(count);
GetAjaxObat(countObat);

 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += '<td><select name="posisi['+count+']" id="posisi['+count+']" class="form-control"><option value="" selected hidden>--Posisi--</option></select></td><td><input type="file" name="sample['+count+']"  class="form-control"  autocomplete="off"/></td>';
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Hapus</button></td>";
   html_code += "</tr>";
   $('#crud_table').append(html_code);
   $("#crud_table").find("td").on("focus", function(){
         $(this).closest("tr").addClass("active");
       }).on("blur", function() {
         $(this).closest("tr").removeClass("active");
       });
    GetAjaxPosisi(count);


 });

 $('#addObat').click(function(){
  countObat = countObat + 1;
  var html_code = "<tr id='row"+countObat+"'>";
   html_code += '<td><select name="obat['+countObat+']" id="obat['+countObat+']" class="form-control"><option value="" selected hidden>--Obat--</option></select></td><td><input type="number" name="qtyObat['+countObat+']"  class="form-control"  placeholder="Qty Obat"/></td>';
   html_code += "<td><button type='button' name='remove2' data-row='row"+countObat+"' class='btn btn-danger btn-xs remove'>Hapus</button></td>";
   html_code += "</tr>";
   $('#crud_table2').append(html_code);
   $("#crud_table2").find("td").on("focus", function(){
         $(this).closest("tr").addClass("active");
       }).on("blur", function() {
         $(this).closest("tr").removeClass("active");
       });
    GetAjaxObat(countObat);

 });

 $("#crud_table").find("td").on("focus", function(){
       $(this).closest("tr").addClass("active");
     }).on("blur", function() {
       $(this).closest("tr").removeClass("active");
     });

     
 $("#crud_table2").find("td").on("focus", function(){
       $(this).closest("tr").addClass("active");
     }).on("blur", function() {
       $(this).closest("tr").removeClass("active");
     });

 $(document).on('click', '.remove', function(){
 var delete_row = $(this).data("row");
 $('#' + delete_row).remove();
 count--;
  });

  $(document).on('click', '.remove2', function(){
 var delete_row = $(this).data("row");
 $('#' + delete_row).remove();
 countObat--;
  });

//select2 for posisi
//get posisi from db with ajax then put on var to show in select
function GetAjaxPosisi(count){
  $.ajax({
            type: 'GET',
            url: 'controller/posisi/posisi_getAllPosisi.php',
            success: function(data) {
              var posisiString = JSON.parse(data); 
              $("#posisi\\["+count+"\\]").select2({
                data : posisiString
              });
            }
        });		

};


//select2 for obat
//get obat from db with ajax then put on var to show in select
function GetAjaxObat(countObat){
  $.ajax({
            type: 'GET',
            url: 'controller/obat/obat_getAllObat.php',
            success: function(data) {
              var obatString = JSON.parse(data); 
              $("#obat\\["+countObat+"\\]").select2({
                data : obatString
              });
            }
        });		
};


});

</script>
