<?php
	if ($list != 0) 
	{
		# code...
		for ($i=0; $i < count($list); $i++) { 
			# code...
?>
			<tr>
				<td><?=$i+1;?></td>
				<td><?=$list[$i]->nama_eselon1;?></td>
				<td><?=$list[$i]->nama_eselon2;?></td>
				<td><?=$list[$i]->nama_eselon3;?></td>
				<td><?=$list[$i]->nama_eselon4;?></td>
				<td><?=$list[$i]->nama_kat_posisi;?></td>
				<td><?=$list[$i]->nama_posisi;?></td>
				<td><?=$list[$i]->counter_pegawai;?></td>				
				<td>
					<?php
						if($list[$i]->counter_skp == 0)
						{
					?>
							<label class="btn btn-danger">SKP tidak tersedia</label>
					<?php
						}
						else {
							# code...
					?>
							<label class="btn btn-success">SKP tersedia</label>
					<?php													
						}
					?>
				</td>				
				<td>
<?php
				if ($param == 'master_skp') {
					# code...
?>
					<button class="btn btn-primary btn-xs" onclick="show_skp('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> SKP</button>&nbsp;&nbsp;
<?php					
				}
				else
				{
?>
					<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
					<button class="btn btn-primary btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>
<?php
				}
?>
				</td>
			</tr>			
<?php
		}
	}
?>