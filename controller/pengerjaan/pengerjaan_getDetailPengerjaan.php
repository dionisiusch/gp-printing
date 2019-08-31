<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$idPengerjaan = 0;
$querySample = $link->query("SELECT pengerjaan.id,pengerjaan.status,pengerjaan.qty_awal,pengerjaan.qty_akhir,pelanggan.nama,pengerjaan.tgl_mulai,pengerjaan.tgl_selesai,pengerjaan.tipe from pengerjaan join sample on pengerjaan.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id where pengerjaan.id_sample = '$id'");
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

           <td>'.$row['tgl_selesai'].'</td>
         </tr>
		  <tr>
         <td align="right"><b>Status : </b></td>
			
         <td><select id="status" class="form-control">';
		 
		 if($row['status']==0){
			$result.='<option selected="selected" value="0">On-Going</option>
			<option value="1">Done</option>
			';
		 }else if($row['status']==1){
			$result.='<option value="0">On-Going</option>
			<option selected="selected" value="1">Done</option>
			';
		 }
		$result.='
        </select>
		</td>
		<td><button onclick="ChangeStatusPengerjaan()" class="btn btn-warning">Ubah</button>
		</td>
		 </tr>
		   <tr>
         <td align="right"><b>Qty : </b></td>

           <td>'.$row['qty_awal'].'</td>
         </tr>

         <tr>
         <td align="right"><b>Jenis Pengerjaan : </b></td>

           <td>';
           
           if($row['tipe']==0){
            $result.='Pengerjaan Sendiri (7x24jam)
            ';
           }else if($row['status']==1){
            $result.='Pengerjaan Makloon (3x24jam)
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



$query = $link->query("SELECT lokasi,desain FROM detail_sample WHERE id_sample='$id'");
while ($row = $query->fetch_assoc()) {
	$result.= '
     <tr >
      <td>
        '.$row['lokasi'].'
      </td>
      <td><a target="_blank" href="assets/uploads/'.$row['desain'].'"><img style="width:50px" src="assets/uploads/'.$row['desain'].'"></a></td>
     </tr>
';
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
	var status = $("#status").val();
	var data = "id=" + id + "&status="+ status;
	

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


