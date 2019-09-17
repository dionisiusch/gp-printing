<?php
include('header.php');
include('../controller/config/asset.php');
?>
<base href="http://localhost/gp-printing/" />
<div class="modal-header">
    <h4 class="modal-title">Pengerjaan</h4>
</div>
<div class="modal-body">
  <?php
    $currentDateTime = date('Y-m-d');
  
?>  

   <br />
   <br />

   <br>
<a class="btn btn-default btn-lg" href='view/pengerjaan_pickDate.php'><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp; Print</a>
    <br><br>
<?php
	include '../controller/pengerjaan/pengerjaan_show.php';
?>
