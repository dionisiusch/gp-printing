<?php
include('../config/linken.php');

//get search term
$id = $_POST['id'];
$data = array();
$result = '';
$querySample = $link->query("SELECT * from obat Where id=$id");
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
         <td align="right"><b>Nama Obat : </b></td>
		 

           <td>'.$row['nama_obat'].'</td>
         </tr>
		<tr>
         <td align="right"><b>Qty(Kg) : </b></td>
		 

           <td>'.number_format($row['kilo'] ,2).' Kg</td>
         </tr>
		
	   <tr>
         <td align="right"><b>Harga Beli : </b></td>

           <td>Rp. '.number_format($row['harga_beli'],2,",",".").'</td>
         </tr>
        <tr>
         <td align="right"><b>Harga Jual : </b></td>

           <td>Rp. '.number_format($row['harga_jual'],2,",",".").'</td>
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
function ChangeStatus(){
	var id = $("#id").val();
	var status = 1;
	var data = "id=" + id + "&status="+ status;
	

	 $.ajax({
            type: 'POST',
            url: 'controller/sample/sample_changeStatus.php',
            data: data,
            success: function(data) {
                var jsonResult = JSON.parse(data);
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


