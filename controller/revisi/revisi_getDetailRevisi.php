<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$idRevisi = 0;
$queryGetRevisi = $link->query("SELECT revisi.id,revisi.status,revisi.qty_awal,revisi.qty_akhir,sample.artikel,revisi.tgl_mulai,revisi.tgl_deadline,revisi.tgl_selesai,revisi.tipe from revisi join sample on revisi.id_sample = sample.id where revisi.id = '$id'");
while ($row = $queryGetRevisi->fetch_assoc()) {
  $idRevisi = $row["id"];
    if($row['tgl_mulai']=='0000-00-00' ){
        $row['tgl_mulai']=null;
    }else{
        $row['tgl_mulai']=date("d-m-Y",strtotime( $row['tgl_mulai']));
    }
    if($row['tgl_deadline']=='0000-00-00' ){
        $row['tgl_deadline']=null;
    }else{
        $row['tgl_deadline']=date("d-m-Y",strtotime( $row['tgl_deadline']));
    }    
    if($row['tgl_selesai']=='0000-00-00'){
        $row['tgl_selesai']=null;
    }else{
        $row['tgl_selesai']=date("d-m-Y",strtotime( $row['tgl_selesai']));
    }    
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
         <td align="right"><b>Tanggal Mulai : </b></td>

           <td>'.$row['tgl_mulai'].'</td>
         </tr>
		 <tr>
        <tr>
         <td align="right"><b>Tanggal Deadline : </b></td>

           <td>'.$row['tgl_deadline'].'</td>
         </tr>
		 <tr> 
         <td align="right"><b>Tanggal Selesai : </b></td>

           <td>'.$row['tgl_selesai'].'</td>
         </tr>
		  <tr>
         <td align="right"><b>Status : </b></td>
			
         <td>';
		 
		 if($row['status']==0){
			$result.='<span style="color:red">Idle</span>
			';
         }else if($row['status']==1){
			$result.='<span style="color:blue">On-Going</span>
			';     
		 }else if($row['status']==2){
			$result.='<span style="color:green">Done</span>
			';
		 }else if($row['status']==3){
			$result.='<span style="color:red">Not Suitable</span>
			';
		 }
		$result.='

		</td>
        
		 </tr>';
		 
		
		$result.='
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
<input type='hidden' id='idRevisi' value='<?php echo $idRevisi;?>'>


<script>

function ChangeStatusRevisiKerjakan(){
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
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
				
            }
        });
    
}
function ChangeStatusRevisiDone(){
	var id = $("#idRevisi").val();
	var status = $("#status").val();
	var data = "id=" + id + "&status="+ status;
	
	 $.ajax({
            type: 'POST',
            url: 'controller/revisi/revisi_changeStatusDone.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data)
				var text = jsonResult.text;
				var validator = jsonResult.validator;
					 $('#myModal3').html(text);
					 $("#myModal3").modal("show");
            }
        });		

}
</script>


