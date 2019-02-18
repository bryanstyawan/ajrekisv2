<?php
	for ($i=0; $i < count($atasan); $i++) { 
		# code...
?>
		<option value="<?php echo $atasan[$i]->id;?>"><?php echo $atasan[$i]->nama_posisi;?></option>
<?php
	}
?>					