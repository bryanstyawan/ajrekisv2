<?php $row = $select_eselon_3->result();?>
<div class="form-group">
	<div class="input-group">
        <span class="input-group-addon"><i class="fa fa-star"></i></span>
        <select name="select_eselon_3" id="select_eselon_3" class="form-control filter_data_eselon">
        	<option value="">Pilih Eselon 3</option>
        	<?php
        		if ($select_eselon_3->result() != "") {
        			# code...

        			for ($i=0; $i < count($select_eselon_3->result()); $i++) { 
        				# code...
        	?>
						<option value="<?php echo $row[$i]->id_es3;?>"><?php echo $row[$i]->nama_eselon3;?></option>
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
$("#select_eselon_3").change(function(){
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();
		var select_eselon_4      = '';
		var select_jenis_jabatan = $("#select_jenis_jabatan").val();
        $('#select_eselon_4').find('option').remove();    
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------')); 	 		
		$.ajax({
			url :"<?php echo site_url()?>master/data_eselon4/dropdown_es4",
			type:"post",
			data:"select_eselon_3="+select_eselon_3,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				$("#isi_select_eselon_4").html(msg);
				$("#loadprosess").modal('hide');
			}
		})
	})
	
})
</script>