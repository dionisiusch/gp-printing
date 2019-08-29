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

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tambah Sample</button>

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
         <td align="right"><b>Pelanggan : </b></td>
		 

           <td><input id='pelanggan' type="text" name="pelanggan"  class="form-control" required placeholder='Pelanggan' autocomplete="on" ></td>
         </tr>
		<tr>
			<td></td>
			<td  id='autocomplete'></td>
			</tr>
	   <tr>
         <td align="right"><b>Tanggal : </b></td>

           <td><input type="date" name="tglSample"  class="form-control"  autocomplete="off" value="<?php echo $currentDateTime?>"/></td>
         </tr>
       </table>

    <table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <th width="40%">Lokasi</th>
      <th width="60%">Desain</th>
     </tr>

     <tr >
      <td>
        <select name="lokasi[1]" class="form-control">
          <option value="KS">Keseluruhan</option>
          <option value="BD">Badan Depan</option>
          <option value="BB">Badan Belakang</option>
          <option value="LKI">Lengan Kiri</option>
          <option value="LKA">Lengan Kanan</option>
          <option value="HM">Halfmoon</option>
        </select>
      </td>
      <td><input type="file" name="sample[1]" class="form-control"/></td>
     

     </tr>

    </table>
    <div align="right">
         <button type="button" name="add" id="add" class="btn btn-success btn-xs">Tambah</button>
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
$(function() {
  $('#pelanggan').autocomplete({
    source: 'controller/fetch/fetch_pelanggan.php',
	appendTo : '#autocomplete'
	
  });
});



 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += '<td><select name="lokasi['+count+']" class="form-control"><option value="KS">Keseluruhan</option><option value="BD">Badan Depan</option><option value="BB">Badan Belakang</option><option value="LKI">Lengan Kiri</option><option value="LKA">Lengan Kanan</option><option value="HM">Halfmoon</option></select></td><td><input type="file" name="sample['+count+']"  class="form-control"  autocomplete="off"/></td>';
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Hapus</button></td>";
   html_code += "</tr>";
   $('#crud_table').append(html_code);
   $("#crud_table").find("td").on("focus", function(){
         $(this).closest("tr").addClass("active");
       }).on("blur", function() {
         $(this).closest("tr").removeClass("active");
       });


 });

 $("#crud_table").find("td").on("focus", function(){
       $(this).closest("tr").addClass("active");
     }).on("blur", function() {
       $(this).closest("tr").removeClass("active");
     });

 $(document).on('click', '.remove', function(){
 var delete_row = $(this).data("row");
 $('#' + delete_row).remove();
 count--;
  });
});

</script>
