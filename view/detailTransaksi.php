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

<?php
	include '../controller/detailTransaksi/detailTransaksi_show.php';
?>