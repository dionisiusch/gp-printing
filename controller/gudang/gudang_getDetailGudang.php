<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$queryGudang = $link->query("SELECT gudang.id,sample.artikel,gudang.id_pengerjaan,gudang.qty_total,gudang.qty_sementara,gudang.qty_kurang,gudang.tgl_pengambilan,gudang.status,gudang.keterangan,pengerjaan.tipe from gudang join pengerjaan on gudang.id_pengerjaan=pengerjaan.id join sample on pengerjaan.id_sample = sample.id where gudang.id=$id");
while ($row = $queryGudang->fetch_assoc()) {
    if($row['tgl_pengambilan']=='0000-00-00'){
        $row['tgl_pengambilan']=null;
    }else{
         $row['tgl_pengambilan'] = date("d-m-Y",strtotime( $row['tgl_pengambilan']));
    }  

  if($row['tgl_pengambilan']=="01-01-1970"){
    $row['tgl_pengambilan']= '';
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
         <td align="right"><b>Qty di Kirim ke Gudang : </b></td>

           <td>'.$row['qty_sementara'].'</td>
         </tr>
        <tr>
         <td align="right"><b>Qty Tersisa di Gudang : </b></td>

           <td>'.$row['qty_kurang'].'</td>
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
       <table class="table table-bordered" id="tableHistory">
        <tr><td align="center" colspan="4" ><h4>HISTORY MASUK GUDANG</h4></td></tr>
       <tr><td><b>Tanggal Masuk</b>
       </td>
       ';
      if($row['tipe']==0||$row['tipe']==2){
        $result.= '
        <td><b>Qty Sendiri</b>
        </td>
        ';
      }    
      if($row['tipe']==1||$row['tipe']==2){
        $result.= '
        <td><b>Qty Makloon</b>
        </td>
        ';
      }

      $result.=' </tr>';
      //get detail dari pengerjaan_gudang
      $idPengerjaan = $row['id_pengerjaan'];
      $queryGudang = $link->query("SELECT * from pengerjaan_gudang where id_pengerjaan = '$idPengerjaan'");
      while ($rowgudang = $queryGudang->fetch_assoc()) {
        $result.= '
        <tr>
        <td align="center">
        '.$rowgudang['tgl'].'
        </td>
        ';
        if($row['tipe']==0||$row['tipe']==2){
          $result.='
          <td align="center">
          '.$rowgudang['qty_sendiri'].'
          </td>';
        }  
        if($row['tipe']==1||$row['tipe']==2){
          $result.= '
          <td align="center">
          '.$rowgudang['qty_makloon'].'
          </td>
          ';
        }

      }
        $result.='
          </tr>
        ';
      
    

        $result.='
                 <table class="table table-bordered" id="historyToogle">
         <tr><td align="center" colspan="4" ><h4>HISTORY PENGAMBILAN GUDANG</h4></td></tr>
     <tr>
     <td  align="center"><b>Tgl Pengambilan</b></td>
      <td  align="center"><b>Qty Ambil</b></td>
       <td  align="center"><b>Biaya per Ambil</b></td>
    </tr>';

$query = $link->query("SELECT * FROM gudang_detail WHERE id_gudang='$id'");
while ($row2 = $query->fetch_assoc()) {
	$result.= '
     <tr >
      <td align="center">
        '.date("d-m-Y", strtotime($row2['tgl_pengambilan'])).'
      </td>
      <td align="center">
        '.$row2['qty_pengambilan'].'
      </td>
      <td align="center">
        Rp. '.number_format($row2['total_harga'],2,",",".").'
      </td>
      
     </tr>';
}	  
       
			
        
     $result.= '</table>
        <button type="button" name="historyPengambilan" id="historyPengambilan" style="float:right" class="btn-success">History Pengambilan</button>
       </table>

       <tr>
         <td align="center"><button id="history" class="btn-primary">Tampilkan History</button></td>
         </tr> 
         <tr>
         <td align="center"><button id="hideHistory" class="btn-primary">Sembunyikan History</button></td>
         </tr> 
  
      </div>
      
    </div>

  </div>
  </div>
  <script>
   $("#historyToogle").hide();
$("#historyPengambilan").click(function(){
    $("#historyToogle").toggle();
 });
  $("#hideHistory").hide();
  $("#tableHistory").hide();
     $("#history").click(function(){
      $("#tableHistory").show();
      $("#history").hide();
      $("#hideHistory").show();
     });
     $("#hideHistory").click(function(){
      $("#tableHistory").hide();
      $("#history").show();
      $("#hideHistory").hide();
     });
  </script>
  ';
}



 echo $result;
?>
<input type='hidden' id='id' value='<?php echo $id;?>'>
<script>

</script>


