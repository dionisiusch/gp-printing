<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$idPengerjaan = 0;
$querySample = $link->query("SELECT pengerjaan.id,pengerjaan.status,pengerjaan.qty_awal,pengerjaan.qty_akhir_sendiri,pengerjaan.qty_akhir_makloon,pelanggan.nama,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai_sendiri,pengerjaan.tipe,pengerjaan.keterangan from pengerjaan join sample on pengerjaan.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id where pengerjaan.id_sample = '$id'");
while ($row = $querySample->fetch_assoc()) {
  $idPengerjaan = $row["id"];
  $result.= '
	
	<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button class="btn-danger" style="float:right" data-dismiss="modal" aria-label="close">&times;</button>
      </div>
      <div class="modal-body">
      
<div class="table-responsive ">
     <table class="table table-bordered">
        
		<tr>
         <td align="right"><b>Pelanggan : </b></td>
           <td>'.$row['nama'].'</td>
         </tr>
	   <tr>
         <td align="right"><b>Tanggal Mulai : </b></td>

           <td>'.$row['tgl_mulai'].'</td>
         </tr>
		 <tr>
         <td align="right"><b>Tanggal Selesai : </b></td>

           <td>'.$row['tgl_selesai_sendiri'].'</td>
         </tr>
		  <tr>
         <td align="right"><b>Status : </b></td>
			
         <td>';

		 
		 if($row['status']==0){
			$result.='On-Going
      </td>
      </tr>
      <tr>
        <td align="right"><b>Qty : </b></td>

          <td>'.$row['qty_awal'].'</td>
        </tr>

        <tr>
        <td align="right"><b>Jenis Pengerjaan : </b></td>
         <input type="hidden" id="jenisPengerjaan" value="'.$row['tipe'].'">
          <td>';
          
          if($row['tipe']==0){
           $result.='Pengerjaan Sendiri (7x24jam)
           ';
          }else if($row['tipe']==1){
           $result.='Pengerjaan Makloon (3x24jam)
           ';
          }
          else if($row['tipe']==2){
           $result.='Pengerjaan Makloon <br>& Pengerjaan Sendiri
           ';
          };
          
         $result.= '</td>
        </tr>
    
      </table> <table class="table table-bordered hovertable" id="crud_table">
    <tr>
     <th width="40%">Lokasi</th>
     <th width="60%">Desain</th>
    </tr>';
     }
     else if($row['status']==1){
			$result.='
       Done
        </td>
        </tr>
        <tr>
        <td align="right"><b>Jenis Pengerjaan : </b></td>
         <input type="hidden" id="jenisPengerjaan" value="'.$row['tipe'].'">
          <td>';
          
          if($row['tipe']==0){
           $result.='Pengerjaan Sendiri (7x24jam)
           ';
          }else if($row['tipe']==1){
           $result.='Pengerjaan Makloon (3x24jam)
           ';
          }
          else if($row['tipe']==2){
           $result.='Pengerjaan Makloon <br>& Pengerjaan Sendiri
           ';
          };
          
         $result.= '</td>
        </tr>
        <tr>
        <td align="right"><b>Qty Awal : </b></td>
          <td>'.$row['qty_awal'].'</td>
        </tr>';
         if($row['tipe']==0){
           $result.=' <tr>
        <td align="right"><b>Qty Akhir Sendiri : </b></td>
          <td>'.$row['qty_akhir_sendiri'].'</td>
        </tr>
           ';
          }else if($row['tipe']==1){
           $result.='        <tr>
        <td align="right"><b>Qty Akhir Makloon : </b></td>
          <td>'.$row['qty_akhir_makloon'].'</td>
        </tr>
           ';
          }
          else if($row['tipe']==2){
           $result.='        <tr>
        <td align="right"><b>Qty Akhir Sendiri : </b></td>
          <td>'.$row['qty_akhir_sendiri'].'</td>
        </tr>

        <tr>
        <td align="right"><b>Qty Akhir Makloon : </b></td>
          <td>'.$row['qty_akhir_makloon'].'</td>
        </tr>
           ';
          };
        


        $result.='<tr>
        <td align="right"><b>Keterangan : </b></td>
          <td>'.$row['keterangan'].'</td>
        </tr>
        
        ';
         $count = 1;
    $queryShowRevisi = $link->query("SELECT tgl_mulai,tgl_selesai,qty_akhir,qty_awal FROM revisi WHERE id_sample='$id'");
while ($rowRevisi = $queryShowRevisi->fetch_assoc()) {
	$result.= '
    <div class="table-responsive ">
     <table class="table table-bordered" >
     <h3>Revisi '.$count.'</h3>
      <tr>
         <td align="right" width="40%"><b>Tanggal Mulai : </b></td>
           <td>'.$rowRevisi['tgl_mulai'].'</td>
      </tr>
      <tr>
         <td align="right" width="40%"><b>Tanggal Selesai : </b></td>
           <td>'.$rowRevisi['tgl_selesai'].'</td>
      </tr>
      <tr>
         <td align="right" width="40%"><b>Qty Awal : </b></td>
           <td>'.$rowRevisi['qty_awal'].'</td>
      </tr>
      <tr>
         <td align="right" width="40%"><b>Qty Akhir : </b></td>
           <td>'.$rowRevisi['qty_akhir'].'</td>
      </tr>
      <tr>
        <td align="right" width="40%"><b>Keterangan : </b></td>
          <td>'.$row['keterangan'].'</td>
        </tr>
      </table></div>';
    $count++;
}
     $result.=' </table> <table class="table table-bordered hovertable" id="crud_table">
    <tr>
     <th width="40%">Lokasi</th>
     <th width="60%">Desain</th>
    </tr>';
         
         
		 }else if($row['status']==2){
		$result.='Revisi
              </td>
        </tr>   
		';
                  $count = 1;
    $queryShowRevisi = $link->query("SELECT tgl_mulai,tgl_selesai,qty_akhir,qty_awal FROM revisi WHERE id_sample='$id'");
while ($rowRevisi = $queryShowRevisi->fetch_assoc()) {
	$result.= '
    <div class="table-responsive ">
     <table class="table table-bordered" >
     <h3>Revisi '.$count.'</h3>
      <tr>
         <td align="right" width="40%"><b>Tanggal Mulai : </b></td>
           <td>'.$rowRevisi['tgl_mulai'].'</td>
      </tr>
      <tr>
         <td align="right" width="40%"><b>Tanggal Selesai : </b></td>
           <td>'.$rowRevisi['tgl_selesai'].'</td>
      </tr>
      <tr>
         <td align="right" width="40%"><b>Qty Awal : </b></td>
           <td>'.$rowRevisi['qty_awal'].'</td>
      </tr>
      <tr>
         <td align="right" width="40%"><b>Qty Akhir : </b></td>
           <td>'.$rowRevisi['qty_akhir'].'</td>
      </tr>
      <tr>
        <td align="right" width="40%"><b>Keterangan : </b></td>
          <td>'.$row['keterangan'].'</td>
        </tr>
      </table></div>';
    $count++;
}
     $result.=' </table> <table class="table table-bordered hovertable" id="crud_table">
    <tr>
     <th width="40%">Lokasi</th>
     <th width="60%">Desain</th>
    </tr>';
     }
}



$query = $link->query("SELECT lokasi,desain FROM detail_sample WHERE id_sample='$id'");
while ($row = $query->fetch_assoc()) {
	$result.= '
     <tr >
      <td>
        '.$row['lokasi'].'
      </td>
      <td><a target="_blank" href="assets/uploads/'.$row['desain'].'"><img style="width:50px" src="assets/uploads/'.$row['desain'].'"></a></td>
     </tr>';
}
//return json data
$result.='
    </table>
  
      </div>
      
    </div>

  </div>
  </div>
';

  
 echo $result;
?>
<input type='hidden' id='idPengerjaan' value='<?php echo $idPengerjaan;?>'>

<script>

function ChangeStatusPengerjaan(){
	var id = $("#idPengerjaan").val();
	var status = 1;
  var jenisPengerjaan = $("#jenisPengerjaan").val();
	var data = "id=" + id + "&status="+ status+ "&jenisPengerjaan="+ jenisPengerjaan;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/pengerjaan/pengerjaan_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;
				if(validator==1){
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				}else{
					alert(text);
					window.location.replace(window.location.href+'?reload');
				}
            }
        });		
}
</script>


