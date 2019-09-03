<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$idRevisi = 0;
$queryGetRevisi = $link->query("SELECT revisi.id,revisi.status,revisi.qty_awal,revisi.qty_akhir,pelanggan.nama,revisi.tgl_mulai,revisi.tgl_selesai,revisi.tipe from revisi join sample on revisi.id_sample = sample.id join pelanggan on sample.id_pelanggan = pelanggan.id where revisi.id = '$id'");
while ($row = $queryGetRevisi->fetch_assoc()) {
  $idRevisi = $row["id"];
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
			$result.='<option selected="selected" value="0">Idle</option>
			<option value="1">On-Going</option>
            <option value="2">Done</option>
			';
         }else if($row['status']==1){
			$result.='<option value="0">Idle</option>
			<option selected="selected" value="1">On-Going</option>
            <option value="2">Done</option>
			';     
		 }else if($row['status']==2){
			$result.='<option value="0">Idle</option>
			<option value="1">On-Going</option>
            <option selected="selected" value="2">Done</option>
			';
		 }
		$result.='
        </select>
		</td>
		<td><button onclick="ChangeStatusRevisi()" class="btn btn-warning">Ubah</button>
		</td>
		 </tr>
		   <tr>
         <td align="right"><b>Qty : </b></td>

           <td>'.$row['qty_awal'].'</td>
         </tr>

         <tr>
         <td align="right"><b>Jenis Revisi : </b></td>

           <td>';
           
           if($row['tipe']==0){
            $result.='Revisi Sendiri (7x24jam)
            ';
           }else if($row['status']==1){
            $result.='Revisi Makloon (3x24jam)
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
<input type='hidden' id='idRevisi' value='<?php echo $idRevisi;?>'>


<script>

function ChangeStatusRevisi(){
	var id = $("#idRevisi").val();
	var status = $("#status").val();
	var data = "id=" + id + "&status="+ status;
	
	 $.ajax({
            type: 'POST',
            url: 'controller/revisi/revisi_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;
				if(validator==1){
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				}
            }
        });
                $.ajax({
                type: 'POST',
                url: 'controller/revisi/revisi_changeStatusDone.php',
                data: data,
                success: function(data) {
                    var jsonResult = JSON.parse(data)
				    var text = jsonResult.text;
				    var validator = jsonResult.validator;
				    if(validator==2){
					   $('#myModal4').html(text);
					   $("#myModal4").modal("show");
				    }
                }
            });    
		

}
</script>


