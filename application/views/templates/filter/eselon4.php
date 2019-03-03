<?php $row = $select_eselon_4->result();?>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-star"></i></span>
        <select name="select_eselon_4" id="select_eselon_4" class="form-control filter_data_eselon">
        	<option value="">Pilih Eselon 4</option>
        	<?php
        		if ($select_eselon_4->result() != "") {
        			# code...

        			for ($i=0; $i < count($select_eselon_4->result()); $i++) { 
        				# code...
        	?>
						<option value="<?php echo $row[$i]->id_es4;?>"><?php echo $row[$i]->nama_eselon4;?></option>
         	<?php
         			}
        		}
        	?>
		</select>
	</div>
</div>