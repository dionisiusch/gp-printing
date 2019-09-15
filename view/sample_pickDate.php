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
<form id="formPrintSample" action="controller/sample/sample_print.php" method="POST">
<table>
    <tr>
    <td><h1>Pilih Tanggal</h1></td>
    </tr>
    <tr>
    <td>FROM:</td><td> <input name="tglAwal" type="date" id="tglAwal" value=""> </td>   
    </tr>
    <tr>
    <td> TO :</td><td><input name="tglAkhir" type="date" id="tglAkhir" value=""></td>
    </tr>
    <tr>
      <td><input type="submit"  class="btn btn-default btn-lg" value="Print"></td>
    </tr>
</table>
</form>
