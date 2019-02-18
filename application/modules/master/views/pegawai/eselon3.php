<option value="">None</option>
<?php foreach($es3->result() as $baris3){?>
	<option value="<?php echo $baris3->id_es3;?>"><?php echo $baris3->nama_eselon3;?></option>
<?php }?>