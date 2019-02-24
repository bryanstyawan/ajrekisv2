<?php
	$counter = ($atasan == 0) ? 0 : count($atasan);
	for ($i=0; $i < $counter; $i++) { 
		# code...
?>
		<option value="<?php echo $atasan[$i]->id;?>"><?php echo $atasan[$i]->nama_posisi;?></option>
<?php
	}
?>					