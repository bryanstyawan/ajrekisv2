<option value="">None</option>
<?php foreach($es4->result() as $baris4){?>
	<option value="<?php echo $baris4->id_es4;?>"><?php echo $baris4->nama_eselon4;?></option>
<?php }?>