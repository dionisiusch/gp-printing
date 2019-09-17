<style>
.calendar li{ list-style: none;font-size:7pt }
.calendar li:before{ content:"•"; font-size:10pt;color:red; }
</style>
<?php
    include('controller/config/asset.php');
    include('controller/config/linken.php');

    $bulanIni = date("m");
    $tahunIni = date("Y");

    if(isset($_POST["bulan"])){
        $bulan = $_POST["bulan"];
        $tahun = $_POST["tahun"];
        makeCalendar($bulan,$tahun);
    }else{
        makeCalendar($bulanIni,$tahunIni);
    }

    function makeCalendar($bulan,$tahun){
    
        $namaHari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $namaBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        
        //get first day of month
        $firstDayOfMonth = mktime(0,0,0,$bulan,1,$tahun);
        
        //jumlah hari dalam bulan
        $numberOfDay = date('t',$firstDayOfMonth);

        //hari pertama dalam bulan
        $component = getdate($firstDayOfMonth);
        $componentBulan = $component['month'];
        $indexNamaHari = $component['wday'];

        //hari ini
        $today = date("d");
        $tahunIni = date("Y");
        $bulanIni =intval(date("m"));
        
        //bikin html kalender
        $kalender = '';
        $kalender.='<div class="calendar">
        <table class="table table-bordered">
        <center><h2>'.$componentBulan.' '.$tahun.'</center></h2>
        <span style="float:right">
        <form method="POST" action="index.php">
        <select name="bulan">';
        
        for($l=0;$l<12;$l++){
            if($l+1==$bulan){
                $kalender.='<option selected="selected" value='.($l+1).'>'.$namaBulan[$l].'</option>';
            }else{
            $kalender.='<option value='.($l+1).'>'.$namaBulan[$l].'</option>';
            }
        }
        
        $kalender.='
        </select>
        <select name="tahun">';

        for($l=$tahunIni;$l<$tahunIni+5;$l++){
            if($l==$tahun){
                $kalender.='<option selected="selected" value='.$l.'>'.$l.'</option>';
            }else{
            $kalender.='<option value='.$l.'>'.$l.'</option>';
           }
        }

        $kalender.='
        </select>
        <input type="submit" value="Ok">
        </form>
        </span>
        <tr>
        ';
        foreach($namaHari as $headerHari){
            $kalender .= '<td align="center" style="background-color: #fcc181"><b>'.$headerHari.'</b></td>';
        }

        $kalender.='</tr><tr>';
        if($indexNamaHari>0){
        for($i=0;$i<$indexNamaHari;$i++){
            $kalender.="<td></td>";
             }
         }
         $tgl =1;
         $counter = $indexNamaHari;
         while($tgl<=$numberOfDay){
             for($j=$counter;$j<7;$j++){
                $paramTgl = $tahun."-".$bulan."-".$tgl;
                if($tgl<=$numberOfDay){ 
                    if($tgl<$today&&$tahun<=$tahunIni&&$bulan<=$bulanIni){    
                        $validator = DeadlineColor($paramTgl);
                        if($validator){
                            $kalender.="<td onclick='GetEvent(\"$paramTgl\")' style='vertical-align: top;
                            text-align: left;background-color:#ffadad'>".$tgl."<br>".GetNumberPengerjaan($paramTgl).GetNumberRevisi($paramTgl)."</td>";
                        }else{
                            $kalender.="<td  onclick='GetEvent(\"$paramTgl\")' style='vertical-align: top;
                            text-align: left;height:70;width:120'>".$tgl."<br>".GetNumberPengerjaan($paramTgl).GetNumberRevisi($paramTgl)."</td>";
                        }
                    }
                    else if($tgl==$today&&$tahun==$tahunIni&&$bulan==$bulanIni){
                        $kalender.="<td onclick='GetEvent(\"$paramTgl\")' style='vertical-align: top;
                        text-align: left;background-color:#ffe9b5'><b>".$tgl."</b><br>".GetNumberPengerjaan($paramTgl).GetNumberRevisi($paramTgl)."</td>";
                    }else{    
                        $kalender.="<td  onclick='GetEvent(\"$paramTgl\")' style='vertical-align: top;
                        text-align: left;height:70;width:120'>".$tgl."<br>".GetNumberPengerjaan($paramTgl).GetNumberRevisi($paramTgl)."</td>";
                    }
                    $tgl++;
                }else{
                    $kalender.="<td></td>";
                }
             }
             $kalender.="</tr></div>";
            $counter=0;
            
         }
     
        echo $kalender;
    }

    function GetNumberPengerjaan($date){
        include('controller/config/linken.php');
        $queryNumberPengerjaan = "SELECT * from pengerjaan where (tgl_selesai_sendiri = '$date' and status=0) or (tgl_selesai_makloon = '$date' and status=0)";
        $resultNumberPengerjaan = mysqli_query($link,$queryNumberPengerjaan);
        $number = mysqli_num_rows($resultNumberPengerjaan);
        if($number>0){
            return "<li style='text-align: left'>Pengerjaan : ".$number."</li>";
        }
    }

    function GetNumberRevisi($date){
        include('controller/config/linken.php');
        $queryNumberRevisi = "SELECT * from revisi where tgl_deadline = '$date' and status=1";
        $resultNumberRevisi = mysqli_query($link,$queryNumberRevisi);
        $number = mysqli_num_rows($resultNumberRevisi);
        if($number>0){
            return "<li style='text-align: left'>Perbaikan : ".$number."</li>";
        }
    }

    function DeadlineColor($date){
        include('controller/config/linken.php');
        $queryNumberRevisi = "SELECT * from revisi where tgl_deadline = '$date' and status=1";
        $resultNumberRevisi = mysqli_query($link,$queryNumberRevisi);
        $queryNumberPengerjaan = "SELECT * from pengerjaan where (tgl_selesai_sendiri = '$date' and status=0) or (tgl_selesai_makloon = '$date' and status=0)";
        $resultNumberPengerjaan = mysqli_query($link,$queryNumberPengerjaan);
        $number = mysqli_num_rows($resultNumberPengerjaan)+mysqli_num_rows($resultNumberRevisi);
        
        if($number>0){
            return true;
        }else{
            return false;
        }
    }
?>

<script>

function GetEvent(date){
    var data = "date="+ date;
    $.ajax({
            type: 'POST',
            url: 'controller/calendar/calendar_getEvent.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data);
				var text = jsonResult.text;
				var validator = jsonResult.validator;
					 $('#modalEvent').html(text);
					 $("#modalEvent").show();
            }
        });		
}

function closeEvent(){
    $("#modalEvent").hide();
}

</script>