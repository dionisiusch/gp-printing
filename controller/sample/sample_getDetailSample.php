<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$querySample = $link->query("SELECT sample.nomor_po,sample.id,sample.status,sample.artikel,sample.tgl from sample where sample.id = '$id'");
while ($row = $querySample->fetch_assoc()) {
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
         <td align="right"><b>Nomor PO : </b></td>
		 

           <td>'.$row['nomor_po'].'</td>
         </tr>
		
	   <tr>
         <td align="right"><b>Tanggal : </b></td>

           <td>'.formatTgl($row['tgl']).'</td>
         </tr>
		  <tr>
         <td align="right"><b>Status : </b></td>
			
         <td>';
		 
		 if($row['status']==0){
      $result.='Idle
      </td>

			';
		 }else if($row['status']==1){
			$result.='On-Going</td>
			';
     }
      else if($row['status']==2){
			$result.='Done</td>
			';
		 }else{
      $result.='Production</td>';
     }
		$result.='
       
		
		 </tr>
       </table>';
$queryBiaya = $link->query("SELECT biaya FROM sample WHERE id='$id'");
while ($rowBiaya = $queryBiaya->fetch_assoc()) {

$result.='
<table class="table table-bordered hovertable">
    <tr>
      <th width="40%">Perkiraan Biaya per Sample</th>
      <th width="60%"><input type="number" name"perkiraanBiaya" id="perkiraanBiaya" value="'.$rowBiaya['biaya'].'" readonly></th>
      </tr>
     </table>';
}
$result.='
</table>
<table class="table table-bordered hovertable" id="crud_table">
<tr>
<th width="40%">Posisi</th>
<th width="60%">Desain</th>
</tr>';


$query = $link->query("SELECT posisi,desain FROM detail_sample WHERE id_sample='$id'");
while ($row = $query->fetch_assoc()) {
	$result.= '
     <tr >
      <td>
        '.$row['posisi'].'
      </td>
      <td><a target="_blank" href="assets/uploads/'.$row['desain'].'"><img style="width:50px" src="assets/uploads/'.$row['desain'].'"></a></td>
     </tr>
';
}
       $result.='
       </table>
       <table class="table table-bordered hovertable" id="crud_table">
     <tr>
      <th width="40%">Obat</th>
      <th width="60%">Qty (gram)</th>
     </tr>';
}



$queryObat = $link->query("SELECT obat.nama_obat,sample_obat.qty FROM sample_obat join obat on sample_obat.id_obat = obat.id WHERE id_sample='$id'");
while ($row = $queryObat->fetch_assoc()) {
	$result.= '
     <tr >
      <td>
        '.$row['nama_obat'].'
      </td>
      <td>'.$row['qty'].'</td>
     </tr>
';
}


//return json data

    $result.= '
     
    </table>
  
      </div>
      
    </div>

  </div>
  </div>
';

  
 echo $result;

function formatTgl($tgl){
  $tglArray = explode("-",$tgl);
  return $tglArray[2]."-".$tglArray[1]."-".$tglArray[0]; 
}

?>


