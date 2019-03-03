<?php $row = $select_eselon_2->result();?>
<div class="form-group">
	<div class="input-group">
        <span class="input-group-addon"><i class="fa fa-star"></i></span>
        <select name="select_eselon_2" id="select_eselon_2" class="form-control filter_data_eselon">
        	<option value="">Pilih Eselon 2</option>
        	<?php
        		if ($select_eselon_2->result() != "") {
        			# code...

        			for ($i=0; $i < count($select_eselon_2->result()); $i++) { 
        				# code...
        	?>
						<option value="<?php echo $row[$i]->id_es2;?>"><?php echo $row[$i]->nama_eselon2;?></option>
         	<?php
         			}
        		}
        	?>
		</select>
	</div>
	<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es3" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
		25%
	</progress>		            		            		            	
</div>
<script>
$(document).ready(function(){
	$("#select_eselon_2").change(function(){
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = '';
		var select_eselon_4      = '';
        $('#select_eselon_3').find('option').remove();    
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------')); 	         
        $('#select_eselon_4').find('option').remove();    
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------')); 	 		
		$.ajax({
			url :"<?php echo site_url()?>master/data_eselon3/dropdown_es3",
			type:"post",
			data:"select_eselon_2="+select_eselon_2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				$("#isi_select_eselon_3").html(msg);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);				
			}
		})
	})
})
	</script>