<option value="">None</option>
<?php foreach($es2->result() as $baris2){?>
	<option value="<?php echo $baris2->id_es2;?>"><?php echo $baris2->nama_eselon2;?></option>
<?php }?>