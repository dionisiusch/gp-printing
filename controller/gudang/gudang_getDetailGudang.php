<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$queryGudang = $link->query("SELECT gudang.id,sample.artikel,gudang.id_pengerjaan,gudang.qty_total,gudang.qty_sementara,gudang.tgl_pengambilan,gudang.status,gudang.keterangan from gudang join pengerjaan on gudang.id_pengerjaan=pengerjaan.id join sample on pengerjaan.id_sample = sample.id where gudang.id=$id");
while ($row = $queryGudang->fetch_assoc()) {
    if($row['tgl_pengambilan']=='0000-00-00'){
        $row['tgl_pengambilan']=null;
    }else{
         $row['tgl_pengambilan'] = date("d F Y",strtotime( $row['tgl_pengambilan']));
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
         <td align="right"><b>Id : </b></td>
		 

           <td>'.$row['id'].'</td>
         </tr>
		<tr>
         <td align="right"><b>Id Pengerjaan : </b></td>
		 

           <td>'.$row['id_pengerjaan'].'</td>
         </tr>
		<tr>
         <td align="right"><b>Nama Pelanggan : </b></td>
		 

           <td>'.$row['artikel'].'</td>
         </tr>
	   <tr>
         <td align="right"><b>Qty Total : </b></td>

           <td>'.$row['qty_total'].'</td>
         </tr>
    	
	   <tr>
         <td align="right"><b>Qty di Gudang : </b></td>

           <td>'.$row['qty_sementara'].'</td>
         </tr>
        	
	   <tr>
         <td align="right"><b>Tanggal Pengambilan: </b></td>

           <td>'.$row['tgl_pengambilan'].'</td>
         </tr> 
		  <tr>
         <td align="right"><b>Status : </b></td>
			
         <td>';
		 
		 if($row['status']==0){
      $result.='<span style="color:blue">On-Storage
      </td>

			';
		 }else if($row['status']==1){
			$result.='<span style="color:green">Taken</td>
			';
		 }
		$result.='
       
		
		 </tr>
         <tr>
         <td align="right"><b>Keterangan: </b></td>

           <td>'.$row['keterangan'].'</td>
         </tr> 
       </table>
       
    </table>
  
      </div>
      
    </div>

  </div>
  </div>';
}



 echo $result;
?>
<input type='hidden' id='id' value='<?php echo $id;?>'>
<script>

</script>


