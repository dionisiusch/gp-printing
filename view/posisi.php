<?php
include('header.php');
include('../controller/config/asset.php');
?>
<base href="http://localhost/gp-printing/" />
<div class="modal-header">
    <h4 class="modal-title">Posisi</h4>

</div>
<div class="modal-body">
  <?php
    $currentDateTime = date('Y-m-d');
?>  

   <br />
   <br />

   <br>
<!-- Trigger the modal with a button -->

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; Tambah Posisi</button>
<?php
	include '../controller/posisi/posisi_show.php';
?>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<form action="controller/posisi/posisi_add.php" method="POST" enctype="multipart/form-data">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button class="btn-danger" style='float:right' data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Posisi</h4>
      </div>
      <div class="modal-body">
      
<div class="table-responsive ">

     <table class="table table-bordered">
        <tr>
         <td align="right"><b>Posisi : </b></td>
		 

           <td><input id='posisi' type="text" name="posisi"  class="form-control" required placeholder='Posisi'></td>
         </tr>
       </table>

        <div align="center">
         <input type="submit" name="submit" id="submit" class="btn btn-info" value="Save">
        </div>
        <br />
        <div id="inserted_item_data"></div>
    

      </div>
      
    </div>

  </div>
      </form>
</div>
    </div>