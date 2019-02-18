<?php
	for ($i=0; $i < count($list); $i++) { 
		# code...
?>
	<tr>
		<td><?=$list[$i]->nip;?></td>
		<td><?=$list[$i]->nama_pegawai;?></td>
		<td><?=$list[$i]->nama_posisi;?></td>
		<td><?=$list[$i]->posisi_class;?></td>
		<td>
			<?php echo anchor('master/editPegawai/'.$list[$i]->id,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>');?>&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>										
		</td>					
	</tr>
<?php
	}
?>