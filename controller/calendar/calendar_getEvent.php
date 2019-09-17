<?php
include('../config/linken.php');

$date = $_POST["date"];
$resultArr['text'] = '
<style>

.fixed_header tbody{
  display:block;
  width: 100%;
  overflow: auto;
  height: 125px;
}

.fixed_header thead tr {
   display: block;
   text-align:center;
}
.fixed_header thead td {
    text-align:center;
 }

.fixed_header td {
  text-align: center;
}
</style>
<button class="btn-danger" style="float:right" onclick="closeEvent()" aria-label="close">&times;</button>'."<center><h4>Events</center></h4>";

//get pengerjaan sendiri
$queryEventPengerjaanSendiri = "SELECT pengerjaan.tipe,pengerjaan.nomor_po,sample.artikel,pengerjaan.tgl_selesai_sendiri from pengerjaan join sample on pengerjaan.id_sample=sample.id where (pengerjaan.tgl_selesai_sendiri = '$date' and pengerjaan.status=0)";
$resultEventPengerjaanSendiri = mysqli_query($link,$queryEventPengerjaanSendiri);

//get pengerjaan makloon
$queryEventPengerjaanMakloon = "SELECT pengerjaan.tipe,pengerjaan.nomor_po,sample.artikel,pengerjaan.tgl_selesai_makloon from pengerjaan join sample on pengerjaan.id_sample=sample.id where (pengerjaan.tgl_selesai_makloon = '$date' and pengerjaan.status=0)";
$resultEventPengerjaanMakloon = mysqli_query($link,$queryEventPengerjaanMakloon);

//get revisi Sendiri
$queryEventRevisi = "SELECT revisi.nomor_po,revisi.tipe,sample.artikel,revisi.tgl_deadline from revisi join sample on revisi.id_sample = sample.id where revisi.tgl_deadline = '$date' and revisi.status=1";
$resultEventRevisi = mysqli_query($link,$queryEventRevisi);

//cek ada event apa tidak
$numberPengerjaan = mysqli_num_rows($resultEventPengerjaanSendiri)+ mysqli_num_rows($resultEventPengerjaanMakloon);

$numberRevisi = mysqli_num_rows($resultEventRevisi);


if($numberPengerjaan>0){
    $resultArr['text'].="
    <div style='width:80%;margin:auto;background-color:white'>
    <table style='font-size:8pt' class='table table-bordered fixed_header '>
    <thead>
    <tr style='background-color:#fac393'>
    <td><b>Deadline Pengerjaan<b></td>
    </tr>    
    <tr style='background-color:#fff2d4'>
            <td align='center'>
                <b>
                    Nomor PO
                </b>
            </td>
            <td align='center'>
            <b>
                Artikel
            </b>
        </td>
        <td align='center'>
        <b>
            Tipe Pengerjaan
        </b>
    </td>
        <td align='center'>
        <b>
            Deadline
        </b>
    </td>
    </tr>
    </thead>
    <tbody>
    ";
while ($row = $resultEventPengerjaanSendiri->fetch_assoc()) {
    $resultArr['text'].='
    <tr>
        <td>
            '.$row["nomor_po"].'
        </td>
        <td>
            '.$row["artikel"].'
        </td>
        <td>
            ';
        
        if($row["tipe"]==2){
            $resultArr['text'].= StringTipe($row["tipe"]).'(Sendiri)';
        }else{
            $resultArr['text'].=StringTipe($row["tipe"]);
        }
            
        $resultArr['text'].='  
        </td>
        <td>
            '.formatTgl($row["tgl_selesai_sendiri"]).'
        </td>
    </tr>';
    
   
    }

    while ($row = $resultEventPengerjaanMakloon->fetch_assoc()) {
        $resultArr['text'].='
        <tr>
            <td>
                '.$row["nomor_po"].'
            </td>
            <td>
                '.$row["artikel"].'
            </td>
            <td>
                ';
                if($row["tipe"]==2){
                    $resultArr['text'].= StringTipe($row["tipe"]).'(Makloon)';
                }else{
                    $resultArr['text'].= StringTipe($row["tipe"]);
                }
            
            $resultArr['text'].= '
            </td>
            <td>
                '.formatTgl($row["tgl_selesai_makloon"]).'
            </td>
        </tr>';
        
       
        }

    $resultArr['text'].="</tbody> </table>
    </div>";
   
}


if($numberRevisi>0){
    $resultArr['text'].="
    <div style='width:80%;margin:auto;background-color:white'>
    <table style='font-size:8pt' class='table table-bordered fixed_header '>
    <thead>
    <tr style='background-color:#fac393'>
    <td><b>Deadline Perbaikan<b></td>
    </tr>    
    <tr style='background-color:#fff2d4'>
            <td align='center'>
                <b>
                    Nomor PO
                </b>
            </td>
            <td align='center'>
            <b>
                Artikel
            </b>
        </td>
        <td align='center'>
        <b>
            Tipe Pengerjaan
        </b>
    </td>
        <td align='center'>
        <b>
            Deadline
        </b>
    </td>
    </tr>
    </thead>
    <tbody>
    ";
while ($row = $resultEventRevisi->fetch_assoc()) {
    $resultArr['text'].='
    <tr>
        <td>
            '.$row["nomor_po"].'
        </td>
        <td>
            '.$row["artikel"].'
        </td>
        <td>
            '.StringTipe($row["tipe"]).'
        </td>
        <td>
            '.formatTgl($row["tgl_deadline"]).'
        </td>
    </tr>';
    
   
    }

    $resultArr['text'].="</tbody> </table>
    </div>";
   
}

if($numberPengerjaan+$numberRevisi==0){
    $resultArr['text'].="<br><br><br><br><br><center><h5>Tidak ada Event!</h5></center>";
}

echo json_encode($resultArr); 

function StringTipe($tipe){
    if($tipe==0){
        return "Pengerjaan Sendiri";
    }
    else if($tipe==1){
        return "Pengerjaan Makloon";
    }
    else if($tipe==2){
        return "Pengerjaan Sendiri & Makloon";
    }
}

function formatTgl($tgl){
	if($tgl!=0||$tgl!=null){
	$tglArray = explode("-",$tgl);
	return $tglArray[2]."-".$tglArray[1]."-".$tglArray[0]; 
	}
	return null;
}
?>