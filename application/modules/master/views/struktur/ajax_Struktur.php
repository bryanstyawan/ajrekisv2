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
				<td><a class="btn bg-yellow" onclick="detail_pegawai('<?php echo $list[$i]->id;?>','detail')"><?=$list[$i]->counter_pegawai;?></a></td>
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
					<button class="btn btn-primary btn-xs" onclick="view_form('<?php echo $list[$i]->id;?>','editdata')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;					
					<?php
						if($list[$i]->counter_skp == 0)
						{
					?>
							<?php
								if ($list[$i]->counter_pegawai > 0) {
									# code...
							?>
									<button class="btn btn-danger btn-xs" onclick="view_form('<?php echo $list[$i]->id;?>','deletedata')"><i class="fa fa-trash"></i></button>
							<?php
								}
							?>
					<?php
						}
					?>
				</td>
			</tr>
<?php
		}
	}
?>