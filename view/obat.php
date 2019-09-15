<?php
include('header.php');
include('../controller/config/asset.php');
?>
<base href="http://localhost/gp-printing/" />
<div class="modal-header">
    <h4 class="modal-title">Obat</h4>
    <button onclick="" class="btn btn-primary" >Kerjakan</button>
</div>
<div class="modal-body">
  <?php
    $currentDateTime = date('Y-m-d');
?>  

   <br />
   <br />

   <br>
<!-- Trigger the modal with a button -->

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; Tambah Obat</button>
<a class="btn btn-default btn-lg" href='controller/obat/obat_print.php'><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp; Print</a>
   <br>   <br>
<?php
	include '../controller/obat/obat_show.php';
?>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<form action="controller/obat/obat_add.php" method="POST" enctype="multipart/form-data">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button class="btn-danger" style='float:right' data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah obat</h4>
      </div>
      <div class="modal-body">
      
<div class="table-responsive ">

     <table class="table table-bordered">
        <tr>
         <td align="right"><b>Nama Obat : </b></td>
		 

           <td><input id='namaObat' type="text" name="namaObat"  class="form-control" required placeholder='Nama Obat'></td>
         </tr>
	   <tr>
         <td align="right"><b>qty(Kilo) : </b></td>

           <td><input type="text" id="kilo" name="kilo"  class="form-control"  required placeholder='Kg'></td>
         </tr>
	   <tr>
         <td align="right"><b>Harga Beli : </b></td>

           <td><input type="text" id="hargaBeli" name="hargaBeli"  class="form-control"  required placeholder='Harga Beli'></td>
         </tr>
         	   <tr>
         <td align="right"><b>Harga Jual : </b></td>

           <td><input type="text" id="hargaJual" name="hargaJual"  class="form-control"  required placeholder='Harga Jual'/></td>
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


<script>
$(document).ready(function(){
 var hargaBeli = document.getElementById('hargaBeli');
 var hargaJual = document.getElementById('hargaJual');
 var kilo = document.getElementById('kilo');    
	hargaBeli.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		hargaBeli.value = formatRupiah(this.value, 'Rp. ');
  
    hargaBeli.value = formatRupiah(this.value, 'Rp. ');  
	});

    hargaBeli.addEventListener('blur', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
 
    hargaBeli.value = formatRupiah(this.value, 'Rp. ');  
    });

    hargaJual.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	hargaJual.value = formatRupiah(this.value, 'Rp. ');
  
    hargaJual.value = formatRupiah(this.value, 'Rp. ');  
	});

    hargaJual.addEventListener('blur', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  
    hargaJual.value = formatRupiah(this.value, 'Rp. ');  
    });
    
  
//    kilo.addEventListener('keyup', function(e){
//		// tambahkan 'Rp.' pada saat form di ketik
//		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
//		kilo.value = formatKg(this.value, 'Kg. ');
//    var numb = rupiah.value.match(/\d/g);
//    numb = numb.join("");
//    kilo.value = numb;
//    kilo.value = formatKg(this.value, 'Kg. ');  
//	});
//
//    kilo.addEventListener('blur', function(e){
//        // tambahkan 'Rp.' pada saat form di ketik
//        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
//    var numb = kilo.value.match(/\d/g);
//    numb = numb.join("");
//    kilo.value = numb;
//    kilo.value = formatKg(this.value, 'Rp. ');  
//    });


	/* Fungsi formatRupiah */
	 function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rp    		    = split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rp += separator + ribuan.join('.');
		}

		rp = split[1] != undefined ? rp+ ',' + split[1] : rp;
		return prefix == undefined ? rp : (rp ? 'Rp. ' + rp : '');
	}
    
    /* Fungsi formatKg */
//	 function formatKg(angka, prefix){
//		var number_string = angka.replace(/[^,\d]/g, '').toString(),
//		split   		= number_string.split(','),
//		sisa     		= split[0].length % 3,
//		rp    		    = split[0].substr(0, sisa),
//		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
//
//		// tambahkan titik jika yang di input sudah menjadi angka ribuan
//		if(ribuan){
//			separator = sisa ? '.' : '';
//			rp += separator + ribuan.join('.');
//		}
//
//		
//		return prefix == undefined ? rp : (rp ?  rp + ' Kg. ' : '');
//	}


        
var count = 1;
$(function() {
  $('#pelanggan').autocomplete({
    source: 'controller/fetch/fetch_pelanggan.php',
	appendTo : '#autocomplete'
	
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
