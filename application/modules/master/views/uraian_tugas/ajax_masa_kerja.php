<?php
if ($masa_kerja != 0) {
	# code...
	for ($i=count($masa_kerja); $i == 0 ; $i--) { 
		# code...
?>
	<tr>
		<td><?=$masa_kerja[$i]->StartDate;?></td>
		<td><?=$masa_kerja[$i]->EndDate;?></td>
		<td><?=$masa_kerja[$i]->nama_posisi;?></td>
		<td>
<?php
				if ($masa_kerja[$i]->EndDate == '9999-01-01') {
					# code...
?>
					<a class="btn btn-danger btn-xs" href="#" onclick="del_masa_aktif('<?php echo $masa_kerja[$i]->id;?>')">
						<i class="fa fa-trash"></i>
					</a>
<?php
				}
?>
		</td>
	</tr>
<?php
	}
}
?>