<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$idPengerjaan = 0;
$tipe = 0;
$qtySendiri = 0;
$querySample = $link->query("SELECT pengerjaan.id,sample.artikel,pengerjaan.nomor_po,pengerjaan.qty_awal,pengerjaan.tipe,pengerjaan.tgl_mulai,pengerjaan.qty_sendiri,pengerjaan.tgl_selesai_sendiri,pengerjaan.qty_makloon,pengerjaan.tgl_selesai_makloon,pengerjaan.status,pengerjaan.keterangan,pengerjaan.qty_akhir_makloon,pengerjaan.qty_akhir_sendiri,pengerjaan.jumlah_orang,pengerjaan.jam_kerja,pengerjaan.biaya_makloon,pengerjaan.meja,pengerjaan.tgl_naik_barang from pengerjaan join sample on pengerjaan.id_sample = sample.id where pengerjaan.id_sample = '$id'");
while ($row = $querySample->fetch_assoc()) {
  $idPengerjaan = $row["id"];
  $qtySendiri =  $row['qty_sendiri'];
  $tipe = $row['tipe'];
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
      <td align="right"><b>Status : </b></td>
            
      <td>';

      if($row['status']==0){
        			$result.='On-Going
              </td>
              </tr>
              ';
      } else if($row['status']==1){
        			$result.='
               Done
              </td></tr>';
      }

      $result.='
               <tr><td align="right"><b>Tanggal Mulai : </b></td>
      
                 <td>'.formatTgl($row['tgl_mulai']).'</td>
               </tr>
               <tr><td align="right"><b>Tanggal Naik Bahan : </b></td>
      
               <td>'.formatTgl($row['tgl_naik_barang']).'</td>
              </tr>
               ';

       if($row["tipe"]==2){
        $result.='
        </table>
        <table class="table table-bordered hovertable" id="crud_table">
        <tr>
        <td>
        </td>
        <td align="center"><b>Pengerjaan Sendiri</b></td>
        <td align="center"><b>Pengerjaan Makloon</b></td></tr>
        <tr>
        <td align="right"><b>Tgl Selesai : </b></td>
        <td align="center">'.$row['tgl_selesai_sendiri'].'</td>
        <td align="center">'.$row['tgl_selesai_makloon'].'</td>
        </tr>
        <tr>
        <td align="right"><b>Qty : </b></td>
        <td align="center">'.$row['qty_sendiri'].'</td>
        <td align="center">'.$row['qty_makloon'].'</td>
        </tr>
        </table>';
       }
        $result.='
        </table>
        <table class="table table-bordered hovertable" id="crud_table">
        <tr>
        <td align="center"><b>Qty Total</b></td>
        <td align="center"><b>Qty Sisa</b></td></tr>
        <tr>
        <td align="center">'.$row['qty_awal'].'</td>';

        if($row['tipe']==0){
          $result.='
        <td align="center">'.($row['qty_awal']-$row['qty_akhir_sendiri']).'</td></tr>
        </table>
       
        <table class="table table-bordered hovertable" id="crud_table">
        <tr>
        <td width="35%" align="right"><b>Jumlah Orang :</b></td>
        <td>'.$row["jumlah_orang"].'</td></tr>
        <tr>
        <tr>
        <td align="right"><b>Meja :</b></td>
        <td>'.$row["meja"].'</td></tr>
        <tr><tr>
        <td align="right"><b>Jam Kerja :</b></td>
        <td>'.$row["jam_kerja"].'</td></tr>
        <tr></table>'
        ;
        }else if($row['tipe']==1){
            $result.='
          <td align="center">'.($row['qty_awal']-$row['qty_akhir_makloon']).'</td></tr>
          </table>
          <table class="table table-bordered hovertable" id="crud_table">
          <tr>
          <td width="50%" align="right"><b>Biaya Produksi Makloon :</b></td>
          <td>'.rupiah($row["biaya_makloon"]).'</td></tr>
         </table>';
          }else if($row['tipe']==2){
            $result.='
          <td align="center">'.($row['qty_awal']-($row['qty_akhir_sendiri']+$row['qty_akhir_makloon'])).'</td></tr>
          </table>
          <table class="table table-bordered hovertable" id="crud_table">
          <tr>
          <td width="35%" align="right"><b>Jumlah Orang :</b></td>
          <td>'.$row["jumlah_orang"].'</td></tr>
          <tr>
          <tr>
          <td align="right"><b>Meja :</b></td>
          <td>'.$row["meja"].'</td></tr>
          <tr><tr>
          <td align="right"><b>Jam Kerja :</b></td>
          <td>'.$row["jam_kerja"].'</td></tr>
          <tr></table>
          <table class="table table-bordered hovertable" id="crud_table">
          <tr>
          <td width="50%" align="right"><b>Biaya Produksi Makloon :</b></td>
          <td>'.rupiah($row["biaya_makloon"]).'</td></tr>
         </table>
          ';
          }

     $result.=' </table> <table class="table table-bordered hovertable" id="crud_table">
    <tr>
     <td  align="center" width="40%"><b>Posisi</b></td>
     <td  align="center" width="60%"><b>Desain</b></td>
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
//get obat

$query = $link->query("SELECT obat.nama_obat,sample_obat.qty FROM sample_obat join obat on sample_obat.id_obat = obat.id WHERE id_sample='$id'");
if($tipe==0||$tipe==2){
  $result.='
  </table>
  <table class="table table-bordered hovertable" id="crud_table">
  <tr>
  <td align="center" width="40%"><b>Obat</b></td>
  <td align="center" width="60%"><b>Qty</b></td>
 </tr>';
while ($row = $query->fetch_assoc()) {
  $result.='<tr>
  <td align="center">'.$row["nama_obat"].'&nbsp;('.$row["qty"].'gram)</td>
  <td align="center">'.($row["qty"]*$qtySendiri).'</td>
 </tr>';
 
  }
}

$result.='
</div>

</div>

</div>
</div>
';

  
 echo $result;
 	
function formatTgl($tgl){
	if($tgl!=0||$tgl!=null){
	$tglArray = explode("-",$tgl);
	return $tglArray[2]."-".$tglArray[1]."-".$tglArray[0]; 
	}
	return null;
}
function rupiah($angka){
	
	$hasil_rupiah = "Rp. " . number_format($angka,0,'','.');
	return $hasil_rupiah;
 
    }
?>
<input type='hidden' id='idPengerjaan' value='<?php echo $idPengerjaan;?>'>

<script>
}
</script>


