<?php
include('../config/linken.php');


$id = $_POST['id'];
$status = $_POST['status'];
$currentDateTime = date('d-m-Y');
$queryGetDataGudang = "SELECT gudang.qty_sementara,gudang.qty_kurang,sample.biaya from gudang join pengerjaan on gudang.id_pengerjaan=pengerjaan.id join sample on pengerjaan.id_sample=sample.id WHERE gudang.id='$id'";
$resultGetDataGudang = mysqli_query($link,$queryGetDataGudang) or die(mysqli_error($link));
while ($row = $resultGetDataGudang->fetch_assoc()) {
    $qtyKurang = $row["qty_kurang"];
    $biaya = $row["biaya"];
    
}

$result = '';
$resultArr  = array();


if($status==0){
	$statusStr = 'Done';
	$result.= '
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		
		<button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
		<h4><b>Detail Ambil Gudang</b></h4>
		</div>
		 <div class="modal-body">
      
		<div class="table-responsive ">
		<form id="formChangeStatus" action="controller/gudang/gudang_UpdateStatusGudang.php" method="POST">	 
		<table class="table table-bordered">
        <input name="id" type="hidden" value="'.$id.'">
        <tr>
         <td align="right"><b>Qty Ambil: </b></td>
           <td>
            <input name="qtyAmbil" type="text" id="qtyAmbil" value="'.$qtyKurang.'">
		   </td>
         </tr>
		<tr>
         <td align="right"><b>Tanggal Ambil: </b></td>
           <td>
            <input name="tgl" type="text" id="tgl" value="'.$currentDateTime.'" readonly>
		   </td>
         </tr>
        <tr>
         <td align="right"><b>Harga Jual: </b></td>
           <td>
             <input type="hidden" name="hargaJual" id="hargaJual" value=" '.$biaya.'">
            <input name="hargaTotalJual" type="text" id="hargaTotalJual"  value="Rp. '.number_format(($biaya*$qtyKurang),2,",",".").'" >
		   </td>
         </tr> 
		<tr>
         <td align="right"><b>Keterangan : </b></td> 
		<td><textarea rows = "5" cols = "30" name="keterangan" id="keterangan" placeholder="Keterangan"/></td>
        </tr>
	</table>
<table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <td><input type="submit" id="savePengerjaanChangeStatus" style="margin-left:250" class="btn btn-success" value="Ambil"></td>
	 </tr>
	 </form>
	<br><br><br><br><br><br><br><br>
	</div>
    	<script>
	 $("#qtyAmbil").keyup(function(){
        var qty = parseInt($("#qtyAmbil").val());
        var hargaJual = parseInt($("#hargaJual").val());
        $("#hargaTotalJual").val("Rp. "+numberWithCommas(getNum(qty*hargaJual).toFixed(2).toString().replace(".", ",")));
        
     });
    function getNum(val) {
        if (isNaN(val)) {
            return 0;
        }
    return val;
    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

	</script>
	  ';
	$resultArr['text'] = $result;
	$resultArr['validator'] = $status;
}
else{

};
echo json_encode($resultArr); 




?>


