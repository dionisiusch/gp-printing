<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$idPengerjaan = 0;
$querySample = $link->query("SELECT * from pengerjaan join sample on pengerjaan.id_sample = sample.id where pengerjaan.id_sample = '$id'");
while ($row = $querySample->fetch_assoc()) {
  // $idPengerjaan = $row["id"];
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
         <td align="right"><b>Artikel : </b></td>
           <td>'.$row['artikel'].'</td>
         </tr>
     <tr>
     <tr>
     <td align="right"><b>Nomor PO : </b></td>
       <td>'.$row['nomor_po'].'</td>
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
     <th width="40%">Posisi</th>
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
}
     $result.=' </table> <table class="table table-bordered hovertable" id="crud_table">
    <tr>
     <th width="40%">Posisi</th>
     <th width="60%">Desain</th>
    </tr>';
}

$query = $link->query("SELECT posisi,desain FROM detail_sample WHERE id_sample='$id'");
while ($row = $query->fetch_assoc()) {
	$result.= '
     <tr >
      <td>
        '.$row['posisi'].'
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


