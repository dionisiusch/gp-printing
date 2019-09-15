<?php
include('../config/linken.php');

$id = $_POST['id'];
$queryGetObat = "SELECT * from obat WHERE id='$id' LIMIT 1";
$resultGetObat = mysqli_query($link,$queryGetObat) or die(mysqli_error($link));
while ($row = $resultGetObat->fetch_assoc()) {
    $namaObat = $row['nama_obat'];
    $kilo = $row['kilo'];
    $hargaBeli = $row['harga_beli'];
    $hargaJual = $row['harga_jual'];   
}
function Kilo($angka){
	
	$hasil_Kg = number_format($angka,2,',','.') ."Kg ";
	return $hasil_Kg;
 
}
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,'','.');
	return $hasil_rupiah;
 
}
$result = '';
$resultArr  = array();
//$query = $link->query("SELECT qty_awal FROM detail_sample WHERE id_sample='$id'");
//while ($row = $query->fetch_assoc()) {
//    $qtyAwal=$row['qty_awal'];
//}



	$result.= '
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		
		<button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
		<h4><b>Edit Obat</b></h4>
		</div>
		 <div class="modal-body">
      
      <div class="table-responsive ">
      <form id="formChangeStatus" action="controller/obat/obat_actionEdit.php" method="POST">
      <table class="table table-bordered" >
           <input type="hidden" name="idObat" id="idObat" value="'.$id.'">
        
		<tr>
         <td align="right"><b>Nama Obat : </b></td>
		 

           <td><input id="namaObat" type="text" name="namaObat"  class="form-control" required value="'.$namaObat.'"></td>
         </tr>
	   <tr>
         <td align="right"><b>qty(Kilo) : </b></td>

           <td><input type="text" id="kilo" name="kilo"  class="form-control"  required value="'.kilo($kilo).'"></td>
         </tr>
	   <tr>
         <td align="right"><b>Harga Beli : </b></td>

           <td><input type="text" id="hargaBeli" name="hargaBeli"  class="form-control"  required value="'.rupiah($hargaBeli).'"></td>
         </tr>
         	   <tr>
         <td align="right"><b>Harga Jual : </b></td>

           <td><input type="text" id="hargaJual" name="hargaJual"  class="form-control"  required value="'.rupiah($hargaJual).'"/></td>
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
$(document).ready(function(){
 var hargaBeli = document.getElementById("hargaBeli");
 var hargaJual = document.getElementById("hargaJual");
 var kilo = document.getElementById("kilo");    
	hargaBeli.addEventListener("keyup", function(e){
		// tambahkan "Rp." pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		hargaBeli.value = formatRupiah(this.value, "Rp. ");

    hargaBeli.value = numb;
    hargaBeli.value = formatRupiah(this.value, "Rp. ");  
	});

    hargaBeli.addEventListener("blur", function(e){
        // tambahkan "Rp." pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka


    hargaBeli.value = formatRupiah(this.value, "Rp. ");  
    });

    hargaJual.addEventListener("keyup", function(e){
		// tambahkan "Rp." pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	hargaJual.value = formatRupiah(this.value, "Rp. ");

    hargaJual.value = formatRupiah(this.value, "Rp. ");  
	});

    hargaJual.addEventListener("blur", function(e){
        // tambahkan "Rp." pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    var numb = hargaJual.value.match(/\d/g);
    numb = numb.join("");

    hargaJual.value = formatRupiah(this.value, "Rp. ");  
    });
    



	/* Fungsi formatRupiah */
	 function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split   		= number_string.split(","),
		sisa     		= split[0].length % 3,
		rp    		    = split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? "." : "";
			rp += separator + ribuan.join(".");
		}

		rp = split[1] != undefined ? rp+ "," + split[1] : rp;
		return prefix == undefined ? rp : (rp ? "Rp. " + rp : "");
	}
    



        
var count = 1;
$(function() {
  $("#pelanggan").autocomplete({
    source: "controller/fetch/fetch_pelanggan.php",
	appendTo : "#autocomplete"
	
  }); 
    $("#kilo").on("click keyup", function(){
    var value = $(this).val();
    var output = value.substring(0, value.length - 3) + " Kg";
    var cursorPosition = output.length - 3;
    $(this).val(output);
    $(this)[0].selectionStart = $(this)[0].selectionEnd = cursorPosition;
});
});


});

</script>
	  ';
	$resultArr['text'] = $result;


echo json_encode($resultArr); 



?>


