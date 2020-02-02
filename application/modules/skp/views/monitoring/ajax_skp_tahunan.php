<?php
	if ($list != 0) {
		# code...
		for ($i=0; $i < count($list); $i++) {
			# code...
	?>
		<tr>
			<td><?=$list[$i]->nip;?></td>								
			<td><?=$list[$i]->nama_pegawai;?></td>
			<td><?=$list[$i]->nama_posisi;?></td>			
			<td><?=number_format($list[$i]->nilai_sasaran_kinerja_pegawai,2);?></td>
			<td><?=number_format($list[$i]->nilai_prilaku_kerja,2);?></td>
			<td><?=number_format($list[$i]->total_skp,2);?></td>			
			<td><?=$tahun;?></td>
		</tr>
	<?php
		}		
	}
?>
<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->