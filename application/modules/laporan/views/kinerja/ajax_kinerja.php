<?php
	for ($i=0; $i < count($list); $i++) {
		# code...
		// $id             = $list[$i]->id;
		$data_link_a    = "";
		$data_link_text = "";
?>
	<tr>
		<td><?=$list[$i]->nip;?></td>								
		<td><?=$list[$i]->nama_pegawai;?></td>
		<td><?=$list[$i]->nama_posisi;?></td>
		<td><?=$list[$i]->posisi_akademik_name;?></td>								
		<td><?=$list[$i]->posisi_plt_name;?></td>
		<td>
			<?php
				if ($list[$i]->avail_atasan == 1) {
					# code...
			?>
					<b>[Definitif]</b> <?=$list[$i]->nama_atasan;?>&nbsp;(<i><?=$list[$i]->jabatan_atasan;?></i>)
			<?php
				}
				else
				{
					echo "<b>[Definitif]</b> N/A";
				}
			?>					
			<hr>
			<?php
				if ($list[$i]->avail_atasan_akademik == 1) {
					# code...
			?>
					<b>[Akademik]</b> <?=$list[$i]->nama_atasan_akademik;?>&nbsp;(<i><?=$list[$i]->jabatan_atasan_akademik;?></i>)
			<?php
				}
				else
				{
					echo "<b>[Akademik]</b> N/A";
				}
			?>
			<hr>
			<?php
				if ($list[$i]->avail_atasan_plt == 1) {
					# code...
			?>
					<b>[PLT]</b> <?=$list[$i]->nama_atasan_plt;?>&nbsp;(<i><?=$list[$i]->jabatan_atasan_plt;?></i>)
			<?php
				}
				else
				{
					echo "<b>[PLT]</b> N/A";
				}
			?>			
		</td>		
		<td></td>								
		<td><?=$list[$i]->tr_revisi;?></td>
		<td><?=$list[$i]->tr_tolak;?></td>
		<td><?=$list[$i]->tr_approve;?></td>
		<td><?=$list[$i]->menit_efektif;?></td>
		<td><?=$list[$i]->prosentase_menit_efektif;?></td>
	</tr>
<?php
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>